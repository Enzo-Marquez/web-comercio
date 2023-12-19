<?php

namespace App\Http\Controllers;

use App\Models\Anio;
use Illuminate\Http\Request;


class AniosController extends Controller
{
    // index para mostrar todos los turnos
    // store para guardar un turno
    // update para actualizar un turno
    // destroy para eliminar un turno
    // show para mostrar un turno
    // edit para mostrar el formulario de edicion


    public function store(Request $request){

        $request->validate([
            'description' => 'required|min:1'
        ]);
        
        $anio = new Anio;
        $anio->description = $request->description;
        $anio->save();

        return redirect()->route('anios')->with('success', 'Año Agregado Correctamente');
    }
    public function index(){
        $anios = Anio::paginate(6); 
        // el metodo paginate es para mostrar hasta 10 datos por lista
        return view('anios.index', ['anios' => $anios]);
    }

    public function show($id){
        $anio = anio::find($id);
        return view('anios.show', ['anio' => $anio]);
    }

    public function update(Request $request, $id){
        $anio = anio::find($id);
        $anio->description = $request->description;
        $anio->save();

        return redirect()->route('anios')->with('success', 'Año actualizado!');
    }

    public function destroy($id){
        $anio = anio::find($id);
        $anio->delete();

        return redirect()->route('anios')->with('success', 'Año ha sido Eliminado!');
    }
}
