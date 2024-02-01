<?php

// app/Models/Usercarrera.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usercarrera extends Model
{
    protected $fillable = [
        'carrera_id',
        'user_id',
    ];

    public function carrera()
    {
        return $this->belongsTo(Carrera::class, 'carrera_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
