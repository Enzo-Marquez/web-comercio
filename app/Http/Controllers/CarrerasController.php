<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use Illuminate\Http\Request;


class CarrerasController extends Controller
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
        
        $carrera = new Carrera;
        $carrera->description = $request->description;
        $carrera->save();

        return redirect()->route('carreras')->with('success', 'Carrera Agregada Correctamente');
    }
    public function index(){
        $carreras = carrera::all();
        return view('carreras.index', ['carreras' => $carreras]);
    }

    public function show($id){
        $carrera = carrera::find($id);
        return view('carreras.show', ['carrera' => $carrera]);
    }

    public function update(Request $request, $id){
        $carrera = carrera::find($id);
        $carrera->description = $request->description;
        $carrera->save();

        return redirect()->route('carreras')->with('success', 'Carrera actualizada!');
    }

    public function destroy($id){
        $carrera = carrera::find($id);
        $carrera->delete();

        return redirect()->route('carreras')->with('success', 'Carrera ha sido Eliminada!');
    }
}
