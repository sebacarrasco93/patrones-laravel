<?php

namespace App\Models\Status;

use App\Contracts\StateInterface;
use App\Mail\UserWasUnlocked;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class LockStatus implements StateInterface
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function handle() : void
    {
        $this->unlock();
    }

    public function unlock() : void
    {
        $this->nextStatus(UnlockStatus::class)->save();
        Mail::to($this->user)->send(new UserWasUnlocked);
    }

    private function nextStatus($status) : User
    {
        return tap($this->user, function($user) use ($status) {
            $user->status = $status;
        });
    }

    public function __toString() : String
    {
        return 'locked';
    }
}
