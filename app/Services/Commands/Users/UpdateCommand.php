<?php

namespace App\Services\Commands\Users;

use App\Models\User;
use App\Notifications\UpdateProfileNotification;

class UpdateCommand implements CommandInterface
{
    private $user;
    private $parameters;

    public function __construct(User $user, array $parameters)
    {
        $this->user = $user;
        $this->parameters = $parameters;
    }

    public function execute() : User
    {
        $this->user->update(
            collect($this->parameters)->filter()->all()
        );

        $this->user->notify(new UpdateProfileNotification($this->user));

        return $this->user;
    }

    public static function new(User $user, array $parameters)
    {
        return new static($user, $parameters);
    }
}
