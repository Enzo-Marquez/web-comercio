<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_doc',
    ];

    public function presidente()
    {
        return $this->hasMany(Mesaexamen::class);
    }

    public function vocal()
    {
        return $this->hasMany(Mesaexamen::class);
    }

    public function vocal2()
    {
        return $this->hasMany(Mesaexamen::class);
    }
}
