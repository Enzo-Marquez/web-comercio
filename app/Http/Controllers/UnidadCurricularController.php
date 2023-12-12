<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\UnidadCurricular;
use App\Models\Anio;
use App\Models\Carrera;

class UnidadCurricularController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $unidadcurricular = UnidadCurricular::all();
        $anios = Anio::all();
        $carreras = Carrera::all();
        return view('unidadcurricular.index', ['unidadcurricular' => $unidadcurricular, 'anios' => $anios, 'carreras' => $carreras]);
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:unidad_curriculars|max:255',
            
        ]);



        
        $unidadcurricular = new UnidadCurricular();
        $unidadcurricular->name = $request->name;
        $unidadcurricular->anios_id = $request->anios_id; // Asigna el valor directo desde la solicitud
        $unidadcurricular->carreras_id = $request->carreras_id;
        $unidadcurricular->save();
        

        return redirect()->route('unidadcurricular.index')->with('success','Nueva Unidad Curricular Agregada');
    }

    /**
     * Display the specified resource.
     * @param int
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $unidadcurricular = UnidadCurricular::find($id);
        $anios = Anio::all();
        $carreras = carrera::all();

        return view('unidadcurricular.show', ['unidadcurricular' => $unidadcurricular, 'anios' => $anios, 'carreras' => $carreras]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int
     * @return \Illuminate\Http\Response
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     * @param int
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified resource from storage.
     * @param int
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $unidadcurricular = UnidadCurricular::find($id);
        $unidadcurricular->delete();
        
        return redirect()->route('unidadcurricular.index')->with('success', 'Unidad Curricular Eliminada');
    }
}
