<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FactoryMethodTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function puede_descargar_un_reporte_de_usuarios_usando_dompdf_con_factory_method()
    {
        $users = User::factory(5)->create();

        $response = $this->post(route('factoryMethod', 'dompdf'));

        $response->assertOk();

        $contentType = $response->headers->get('content-type');
        $contentDisposition = $response->headers->get('content-disposition');

        $this->assertEquals('application/pdf', $contentType);
        $this->assertEquals('attachment; filename="users_report_factory_method.pdf"', $contentDisposition);
    }

    /** @test */
    function puede_descargar_un_reporte_de_usuarios_usando_snappy_con_factory_method()
    {
        $users = User::factory(5)->create();

        $response = $this->post(route('factoryMethod', 'snappy'));

        $response->assertOk();

        $contentType = $response->headers->get('content-type');
        $contentDisposition = $response->headers->get('content-disposition');

        $this->assertEquals('application/pdf', $contentType);
        $this->assertEquals('attachment; filename="users_report_factory_method.pdf"', $contentDisposition);
    }

    /** @test */
    function no_puede_descargar_un_reporte_de_usuarios_usando_un_parametro_invalido_con_factory_method()
    {
        $user = User::factory(5)->create();

        $response = $this->post(route('factoryMethod', 'invalido'));

        $response->assertStatus(500);
    }
}
