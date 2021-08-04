<?php

namespace Tests\Feature;

use App\Contracts\VerifiableAdapter;
use App\Services\Adapters\AbstractApiAdapter;
use App\Services\Adapters\MailboxLayerAdapter;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class AdapterTest extends TestCase
{
    use RefreshDatabase;

    protected function forzarMailboxLayer($emailValido = true)
    {
        // 💡 Forzar el uso de MailboxLayer (ApiLayer), para simular funcionamiento de AppServiceProvider.php
        app()->bind(VerifiableAdapter::class, config('adapter.driver',MailboxLayerAdapter::class));

        // 😎 Mocking de solicitud Http
        Http::fake([
            'apilayer.net/*' => Http::response([
                'mx_found' => $emailValido,
            ], 200),
        ]);
    }

    protected function forzarAbstractApi($emailValido = true)
    {
        // 💡 Forzar el uso de AbstractApi, para simular funcionamiento de AppServiceProvider.php
        app()->bind(VerifiableAdapter::class, config('adapter.driver',AbstractApiAdapter::class));

        // 😎 Mocking de solicitud Http
        Http::fake([
            'emailvalidation.abstractapi.com/*' => Http::response([
                'is_smtp_valid' => ['value' => $emailValido]
            ], 200),
        ]);
    }

    /** @test */
    function puede_crear_un_usuario_usando_el_proveedor_mailboxlayer_con_adapter()
    {
        $this->forzarMailboxLayer(true);

        $data = ['name' => 'Nombre que funciona', 'email' => 'existente@dominio.cl', 'password' => 'password'];

        $request = $this->post(route('adapter'), $data);

        $response = $this->get(route('patrones.adapter'));

        $response->assertSee('Nombre que funciona');
    }

    /** @test */
    function puede_crear_un_usuario_usando_el_proveedor_abstractapi_con_adapter()
    {
        $this->forzarAbstractApi(true);

        $data = ['name' => 'Nombre que funciona', 'email' => 'existente@dominio.cl', 'password' => 'password'];

        $request = $this->post(route('adapter'), $data);

        $response = $this->get(route('patrones.adapter'));

        $response->assertSee('Nombre que funciona');
    }

    /** @test */
    function no_puede_crear_un_usuario_usando_el_proveedor_mailboxlayer_con_adapter()
    {
        $this->forzarMailboxLayer(false);

        $data = ['name' => 'Nombre que no debería aparecer', 'email' => 'repetido@aaaaaa.tk', 'password' => 'password'];

        $request = $this->post(route('adapter'), $data);

        $response = $this->get(route('patrones.adapter'));

        $response->assertDontSee('Nombre que no debería aparecer');
    }

    /** @test */
    function no_puede_crear_un_usuario_usando_el_proveedor_abstractapi_con_adapter()
    {
        $this->forzarAbstractApi(false);

        $data = ['name' => 'Nombre que no debería aparecer', 'email' => 'repetido@aaaaaa.tk', 'password' => 'password'];

        $request = $this->post(route('adapter'), $data);

        $response = $this->get(route('patrones.adapter'));

        $response->assertDontSee('Nombre que no debería aparecer');
    }
}
