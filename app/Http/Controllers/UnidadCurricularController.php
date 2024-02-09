<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\UnidadCurricular;
use App\Models\Anio;
use App\Models\Carrera;
use Illuminate\Pagination\Paginator;

class UnidadCurricularController extends Controller
{
    

    public function filter(Request $request)
{
        Paginator::useBootstrap();
    
        $query = UnidadCurricular::with('anio', 'carrera');
    
        // Aplicar filtros si existen en la solicitud
        if ($request->filled('anios_id')) {
            $query->where('anios_id', $request->anios_id);
        }
    
        if ($request->filled('carrera_id')) {
            $query->where('carreras_id', $request->carrera_id);
        }

    
        $unidadcurricular = $query->paginate(15);
        $anios = Anio::all();
        $carreras = Carrera::all();
    
        return view('unidadcurricular.lista', compact('unidadcurricular', 'anios', 'carreras'));
    }



    







    public function index()
{
    Paginator::useBootstrap();

    $unidadcurricular = UnidadCurricular::with('anio', 'carrera')->paginate(15);
    $anios = Anio::all();
    $carreras = Carrera::all();

    return view('unidadcurricular.index', compact('unidadcurricular', 'anios', 'carreras'));
}

    
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:unidad_curriculars|max:255',
            'anios_id' => 'required|exists:anios,id',
            'carreras_id' => 'required|exists:carreras,id',
            
        ]);



        
        $unidadcurricular = new UnidadCurricular();
        $unidadcurricular->name = $request->name;
        $unidadcurricular->anios_id = $request->anios_id; // Asigna el valor directo desde la solicitud
        $unidadcurricular->carreras_id = $request->carreras_id;
        $unidadcurricular->save();
        

        return redirect()->route('unidadcurricular.index')->with('success','Nueva Unidad Curricular Agregada');
    }

    
    public function show()
{
    $unidadcurricular = UnidadCurricular::with('anio', 'carrera')
        ->orderBy('name', 'asc')
        ->paginate(15);

    $anios = Anio::all();
    $carreras = Carrera::all();
    
    return view('unidadcurricular.lista', compact('unidadcurricular', 'anios', 'carreras'));
}

    
    


 

  
    public function edit($id)
{
    $unidadcurricular = UnidadCurricular::findOrFail($id);
    $anios = Anio::all();
    $carreras = Carrera::all();

    return view('unidadcurricular.edit', compact('unidadcurricular', 'anios', 'carreras'));
}


    
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'anios_id' => 'required', // Asegúrate de que el campo anios_id esté presente en la solicitud
            'carreras_id' => 'required', // Asegúrate de que el campo carreras_id esté presente en la solicitud
        ]);
        $unidadcurricular = UnidadCurricular::find($id);
        $unidadcurricular->name =$request->name;
        $unidadcurricular->anios_id = $request->anios_id;
        $unidadcurricular->carreras_id = $request->carreras_id;
        $unidadcurricular->save();
        
        return redirect()->route('unidadcurricular.index')->with('success', 'Unidad Curricular Actualizada');
    }

   
    public function destroy($id)
    {
        $unidadcurricular = UnidadCurricular::find($id);
        $unidadcurricular->delete();
        
        return redirect()->route('unidadcurricular.lista')->with('success', 'Unidad Curricular Eliminada');
    }
}
