<?php

// app\Models\Carrera.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrera extends Model
{
    use HasFactory;

    public function unidadcur2()
    {
        return $this->hasMany(UnidadCurricular::class);
    }

    public function usuarios()
    {
        return $this->belongsToMany(User::class, 'user_carreras', 'carrera_id', 'user_id');
    }

    public function usercarrera()
    {
        return $this->hasMany(Carrera::class);
    }

 // Corregir la relación a 'hasMany' con el modelo 'Usercarrera'
 public function usercarreras()
 {
     return $this->hasMany(Usercarrera::class);
 }


}

