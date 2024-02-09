<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ainscription extends Model
{
    use HasFactory;

    public function uinscriptions() {
        return $this->hasMany(Uinscription::class, 'user_id');
    }

    public function mesaexamen()
    {
        return $this->belongsTo(Mesaexamen::class, 'mesaexamen_id');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
