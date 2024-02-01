<?php

// app/Models/Uinscription.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Uinscription extends Model
{
    protected $fillable = [
        'mesaexamen_id',
        'user_id',
        // Otros campos según tus necesidades
    ];

    public function mesaexamen()
    {
        return $this->belongsTo(Mesaexamen::class, 'mesaexamen_id');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
