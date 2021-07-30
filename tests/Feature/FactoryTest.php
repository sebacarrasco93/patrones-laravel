<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FactoryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function puede_descargar_un_reporte_de_usuarios_usando_dompdf()
    {
        $users = User::factory(5)->create();

        $response = $this->post(route('factory', 'dompdf'));

        $response->assertOk();

        $contentType = $response->headers->get('content-type');
        $contentDisposition = $response->headers->get('content-disposition');

        $this->assertEquals('application/pdf', $contentType);
        $this->assertEquals('attachment; filename="users_report.pdf"', $contentDisposition);
    }

    /** @test */
    function puede_descargar_un_reporte_de_usuarios_usando_snappy()
    {
        $users = User::factory(5)->create();

        $response = $this->post(route('factory', 'snappy'));

        $response->assertOk();

        $contentType = $response->headers->get('content-type');
        $contentDisposition = $response->headers->get('content-disposition');

        $this->assertEquals('application/pdf', $contentType);
        $this->assertEquals('attachment; filename="users_report.pdf"', $contentDisposition);
    }

    /** @test */
    function no_puede_descargar_un_reporte_de_usuarios_usando_un_parametro_invalido()
    {
        $user = User::factory(5)->create();

        $response = $this->post(route('factory', 'invalido'));

        $response->assertStatus(500);
    }
}
