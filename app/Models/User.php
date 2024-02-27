<?php

// app\Models\User.php
namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'user_type',
        'name',
        'email',
        'apellido',
        'dni',
        'telefono',
        'password',
    ];

    // Otras funciones y métodos...

    public function isAdmin(): Attribute
    {
        return new Attribute(
            get: fn () => $this->user_type === \App\Enums\UserType::Admin,
        );
    }

    public function carreras()
    {
        return $this->belongsToMany(Carrera::class, 'user_carreras', 'user_id', 'carrera_id');
    }

    public function usercarreras()
    {
        return $this->belongsToMany(Usercarrera::class, 'usercarreras', 'user_id', 'carrera_id');
    }

    public function uinscriptions() {
        return $this->hasMany(Uinscription::class, 'user_id');
    }
}
