<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ModeratorController extends Controller
{
    public function dashboard()
    {
        return view('moderator.dashboard');
    }

    // Agrega aquí otros métodos específicos para moderadores según tus necesidades
}
