<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $fillable = [
        'login',
        'full_name',
        'phone',
        'email',
        'password',
        'is_admin',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    protected $hidden = [
        'password',
    ];
}
