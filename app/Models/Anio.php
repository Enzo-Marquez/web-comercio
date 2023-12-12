<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class anio extends Model
{
    use HasFactory;

    public function unidadcur()
    {
        return $this->hasMany(UnidadCurricular::class);
    }
}
