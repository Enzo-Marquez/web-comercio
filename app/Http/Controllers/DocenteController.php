<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Docente;

class DocenteController extends Controller
{
    public function store(Request $request){

        $request->validate([
            'nom_doc' => 'required'
        ]);
        
        $docente = new Docente;
        $docente->nom_doc = $request->nom_doc;
        $docente->save();

        return redirect()->route('docentes')->with('success', 'Docente Agregado Correctamente');
    }
    public function index(){
        $docente = Docente::paginate(4); 
        return view('docentes.index', ['docentes' => $docente]);
    }

    public function show($id){
        $docente = Docente::find($id);
        return view('docentes.show', ['docente' => $docente]);
    }

    public function update(Request $request, $id){
        $docente = Docente::find($id);
        $docente->nom_doc = $request->nom_doc;
        $docente->save();

        return redirect()->route('docentes')->with('success', 'Docente actualizado!');
    }

    public function destroy($id){
        $docente = Docente::find($id);
        $docente->delete();

        return redirect()->route('docentes')->with('success', 'Docente ha sido eliminado!');
    }

    public function edit($id){
        $docente = Docente::find($id);
        return view('docentes.edit', ['docente' => $docente]);
    }
    
}
