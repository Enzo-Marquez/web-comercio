<?php

namespace App\Http\Controllers;

use App\Models\Turno;
use Illuminate\Http\Request;


class TurnosController extends Controller
{
    // index para mostrar todos los turnos
    // store para guardar un turno
    // update para actualizar un turno
    // destroy para eliminar un turno
    // show para mostrar un turno
    // edit para mostrar el formulario de edicion


    public function store(Request $request){

        $request->validate([
            'description' => 'required|min:3'
        ]);
        
        $turno = new Turno;
        $turno->description = $request->description;
        $turno->save();

        return redirect()->route('turnos')->with('success', 'Turno Agregado Correctamente');
    }
    public function index(){
        $turno = turno::paginate(4); 
        return view('turnos.index', ['turnos' => $turno]);
    }

    public function show($id){
        $turno = turno::find($id);
        return view('turnos.show', ['turno' => $turno]);
    }

    public function update(Request $request, $id){
        $turno = turno::find($id);
        $turno->description = $request->description;
        $turno->save();

        return redirect()->route('turnos')->with('success', 'Turno actualizado!');
    }

    public function destroy($id){
        $turno = turno::find($id);
        $turno->delete();

        return redirect()->route('turnos')->with('success', 'Turno ha sido eliminada!');
    }
}
