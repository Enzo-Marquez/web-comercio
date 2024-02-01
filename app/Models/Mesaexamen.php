<?php

// app/Models/MesaExamen.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mesaexamen extends Model
{
    protected $fillable = [
        'carreras_id',
        'anios_id',
        'unidad_curriculars_id',
        'turnos_id',
        'user_id',
        'hora',
        'llamado',
        'llamado2',
        'presidente_id',
        'vocal_id',
        'vocal2_id',
    ];

    

    public function carrera()
    {
        return $this->belongsTo(Carrera::class, 'carreras_id');
    }

    public function anio()
    {
        return $this->belongsTo(Anio::class, 'anios_id');
    }

    public function unidadCurricular()
    {
        return $this->belongsTo(UnidadCurricular::class, 'unidad_curriculars_id');
    }

    public function turno()
    {
        return $this->belongsTo(Turno::class, 'turnos_id');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function presidente()
    {
        return $this->belongsTo(Docente::class, 'presidente_id');
    }

    public function vocal()
    {
        return $this->belongsTo(Docente::class, 'vocal_id');
    }

    public function vocal2()
    {
        return $this->belongsTo(Docente::class, 'vocal2_id');
    }

    public function mesaexamen()
    {
        return $this->hasMany(Uinscription::class);
    }
    
    public function uinscriptions()
    {
        return $this->hasMany(Uinscription::class, 'mesaexamen_id');
    }
    
}


