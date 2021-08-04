<?php

namespace Tests\Feature;

use App\Models\User;
use App\Notifications\UpdateProfileNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class CommandTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function puede_actualizar_un_usuario_y_enviar_notificacion_usando_command()
    {
        Notification::fake();

        $user = User::factory()->create();

        $data = ['name' => 'Nombre nuevo'];

        $response = $this->post(route('command', $user), $data);

        $response = $this->get(route('patrones.command'));

        $response->assertSee('Nombre nuevo');

        Notification::assertSentTo(
            $user,
            UpdateProfileNotification::class,
            function ($notification) use ($user) {
                return $notification->user->id == $user->id;
            }
        );
    }

    /** @test */
    function no_puede_actualizar_un_usuario_ni_enviar_notificacion_usando_command()
    {
        Notification::fake();

        $user = User::factory()->create();

        $data = ['error' => 'NO se puede actualizar'];

        $response = $this->post(route('command', $user), $data);

        $response = $this->get(route('patrones.command'));

        $response->assertDontSee('NO se puede actualizar');

        Notification::assertNotSentTo(
            $user,
            UpdateProfileNotification::class,
            function ($notification) use ($user) {
                return $notification->user->id == $user->id;
            }
        );
    }
}
