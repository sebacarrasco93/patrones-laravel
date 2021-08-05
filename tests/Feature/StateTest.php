<?php

namespace Tests\Feature;

use App\Mail\UserWasLocked;
use App\Mail\UserWasUnlocked;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class StateTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function puede_actualizar_su_estado_a_bloqueado()
    {
        Mail::fake();

        $user = User::factory()->unlocked()->create();

        $response = $this->post(route('state', $user));

        Mail::assertSent(UserWasLocked::class);

        $user->refresh();

        $this->assertEquals('locked', $user->status);
    }

    /** @test */
    function puede_actualizar_su_estado_a_desbloqueado()
    {
        Mail::fake();

        $user = User::factory()->locked()->create();

        $response = $this->post(route('state', $user));

        Mail::assertSent(UserWasUnlocked::class);

        $user->refresh();

        $this->assertEquals('unlocked', $user->status);
    }
}
