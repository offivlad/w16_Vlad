<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'telegram_id',
        'name',
        'balance',
        'is_admin',
    ];

    protected $hidden = [
        // Убираем пароль и т.п. — если не используешь, можно оставить пустым
    ];

    protected $casts = [
        'is_admin' => 'boolean',
        'balance' => 'integer',
    ];
}
