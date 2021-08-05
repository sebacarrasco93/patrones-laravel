<?php

namespace App\Models;

use App\Tasks\Cards\AssignBlackCard;
use App\Tasks\Cards\AssignGoldenCard;
use App\Tasks\Cards\AssignPlatinumCard;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Pipeline\Pipeline;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'balance',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function elegibleForCreditCard()
    {
        return app(Pipeline::class)
            ->send($this)
            ->through([
                AssignGoldenCard::class,
                AssignPlatinumCard::class,
                AssignBlackCard::class,
            ])
            ->then(function($request) {
                return $request->credit_card = 'None';
            });
    }

    protected static function booted()
    {
        static::created(function ($user) {
            $user->update(['status' => \App\Models\Status\UnlockStatus::class]);
        });
    }

    public function changeStatus() : void
    {
        $this->status->handle();
    }

    public function getStatusAttribute($status)
    {
        return new $status($this);
    }
}
