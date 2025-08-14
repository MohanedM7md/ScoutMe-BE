<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Cashier\Billable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, Billable;

    protected $fillable = [
        'email',
        'password',
        'phone_number',
        'user_role',
        'is_verified',
        'last_login',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login' => 'datetime',
        'is_verified' => 'boolean',
    ];

    public const USER_TYPES = [
        'player' => 'player',
        'scout' => 'scout',
        'admin' => 'admin',
    ];

    public function scout()
    {
        return $this->hasOne(Scout::class);
    }

    // Add this method for Cashier to use email as customer identifier
    public function stripeEmail()
    {
        return $this->email;
    }
}
