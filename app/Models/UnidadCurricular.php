<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class UnidadCurricular extends Model
{
    // ...

    public function anio()
    {
        return $this->belongsTo(Anio::class, 'anios_id');
    }

    public function carrera()
    {
        return $this->belongsTo(Carrera::class, 'carreras_id');
    }
}
