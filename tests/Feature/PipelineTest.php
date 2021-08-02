<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PipelineTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function sabe_cuando_le_toca_ser_golden_usando_pipeline()
    {
        $user = User::factory()->create();

         $response = $this->post(route('pipeline', [
             $user,
             'balance' => 101
         ]));

        $response = $this->get(route('patrones.pipeline'));

        $response->assertSee('Golden');
    }

    /** @test */
    function sabe_cuando_le_toca_ser_platinum_usando_pipeline()
    {
        $user = User::factory()->create();

         $response = $this->post(route('pipeline', [
             $user,
             'balance' => 201
         ]));

        $response = $this->get(route('patrones.pipeline'));

        $response->assertSee('Platinum');
    }

    /** @test */
    function sabe_cuando_le_toca_ser_black_usando_pipeline()
    {
        $user = User::factory()->create();

         $response = $this->post(route('pipeline', [
             $user,
             'balance' => 501
         ]));

        $response = $this->get(route('patrones.pipeline'));

        $response->assertSee('Black');
    }

    /** @test */
    function sabe_cuando_no_le_toca_nada_usando_pipeline()
    {
        $user = User::factory()->create();

         $response = $this->post(route('pipeline', [
             $user,
             'balance' => 0
         ]));

        $response = $this->get(route('patrones.pipeline'));

        $response->assertSee('None');
    }
}
