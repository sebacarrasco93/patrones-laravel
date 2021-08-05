<?php

namespace App\Models\Status;

use App\Contracts\StateInterface;
use App\Mail\UserWasLocked;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class UnlockStatus implements StateInterface
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function handle() : void
    {
        $this->lock();
    }

    public function lock() : void
    {
        $this->nextStatus(LockStatus::class)->save();
        Mail::to($this->user)->send(new UserWasLocked);
    }

    private function nextStatus($status) : User
    {
        return tap($this->user, function($user) use ($status) {
            $user->status = $status;
        });
    }

    public function __toString() : String
    {
        return 'unlocked';
    }
}
