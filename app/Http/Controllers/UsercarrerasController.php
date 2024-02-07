<?php

namespace App\Http\Controllers;

use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;
use App\Models\Usercarrera;
use App\Models\Carrera;
use App\Models\User;


class UsercarrerasController extends Controller
{
    public function index()
{
    Paginator::useBootstrap();

    $userId = auth()->user()->id;

    $usercarreras = Usercarrera::with(['user', 'carrera'])
    ->where('user_id', $userId)
    ->paginate(6);
    $users = User::all();
    $carreras = Carrera::all();

    return view('usercarreras.index', compact('usercarreras', 'users', 'carreras'));
}


    





public function create()
{
    // $users = User::all();
    $carreras = Carrera::all();


    return view('usercarreras.create', compact('carreras'));
}






   

    public function store(Request $request)
{
    $request->validate([
        'user_id' => 'required|exists:users,id',
        'carrera_id' => 'required|exists:carreras,id',
    ]);


        // Verificar si ya existe la asignación para esta carrera y usuario
        $existingAssignment = Usercarrera::where('user_id', $request->user_id)
        ->where('carrera_id', $request->carrera_id)
        ->first();

    if ($existingAssignment) {
        return redirect()->route('usercarreras.index')->with('error', 'Ya existe una asignación para esta carrera y usuario.');
    }

    $usercarreras = new Usercarrera();
    $usercarreras->user_id = $request->user_id;
    $usercarreras->carrera_id = $request->carrera_id;
    $usercarreras->save();

    return redirect()->route('usercarreras.index')->with('success', 'Nueva Carrera Agregada');
}






















public function show()
{
    $usercarreras = Usercarrera::with('user', 'carrera')->paginate(10);
    
    // Cambia 'usercarrera' a 'usercarreras' en la siguiente línea
    return view('usercarreras.index', compact('usercarreras'));
}








    public function edit($id)
    {
        $usercarreras = Usercarrera::findOrFail($id);
        $users = User::all();
        $carreras = Carrera::all();
    
        return view('usercarreras.edit', compact('usercarreras', 'users', 'carreras'));
    }

    





   public function update(Request $request, $id)
{
    $request->validate([
        'user_id' => 'required|exists:users,id',
        'carrera_id' => 'required|exists:carreras,id',
    ]);

    $usercarreras = Usercarrera::find($id);
    $usercarreras->user_id = $request->user_id;
    $usercarreras->carrera_id = $request->carrera_id;
    $usercarreras->save();
    
    return redirect()->route('usercarreras.index')->with('success', 'Carrera Actualizada');
}



   public function destroy($id)
{
    $usercarreras = Usercarrera::find($id);
    $usercarreras->delete();

    return redirect()->route('usercarreras.index')->with('success', 'Carrera Eliminada');
}

}
