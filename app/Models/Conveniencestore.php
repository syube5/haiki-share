<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\ConveniencestoreResetPassword;

class Conveniencestore extends Authenticatable
{
    use Notifiable;

    protected $guard = 'conveniencestore';

    protected $fillable = [
        'conveniencestore_name', 'branch', 'zip', 'address', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ConveniencestoreResetPassword($token));
    }
}
