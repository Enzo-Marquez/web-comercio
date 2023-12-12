<?php

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


}
