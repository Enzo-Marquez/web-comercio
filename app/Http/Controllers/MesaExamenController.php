<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mesaexamen;
use App\Models\Carrera;
use App\Models\Anio;
use App\Models\UnidadCurricular;
use App\Models\Turno;
use App\Models\User;
use App\Models\Docente;
use Illuminate\Pagination\Paginator;
use Rap2hpoutre\FastExcel\FastExcel;

class MesaexamenController extends Controller
{
   



    public function filter2(Request $request)
{
    Paginator::useBootstrap();

    $query = Mesaexamen::with('carrera', 'anio', 'unidadCurricular', 'turno', 'presidente', 'vocal', 'vocal2');

    if ($request->filled('anios_id')) {
        $query->whereHas('anio', function ($q) use ($request) {
            $q->where('id', $request->anios_id);
        });
    }

    if ($request->filled('carrera_id')) {
        $query->whereHas('carrera', function ($q) use ($request) {
            $q->where('id', $request->carrera_id);
        });
    }

    $mesasexamenes = $query->get();
    $anios = Anio::all();
    $carreras = Carrera::all();

    // Asegúrate de pasar $mesasexamenes a la vista
    return view('mesaexamens.lista', compact('mesasexamenes', 'anios', 'carreras'));
}

    


    
    











    public function index()
    {
        Paginator::useBootstrap();

        $mesasexamenes = Mesaexamen::with('carrera', 'anio', 'unidadCurricular', 'turno', 'usuario')->get();
        $carreras = Carrera::all();
        $anios = Anio::all();
        $unidadcurricular = UnidadCurricular::all();
        $turnos = Turno::all();
        $users = User::all();
        $docentes = Docente::all();

        return view('mesaexamens.index', compact('mesasexamenes', 'carreras', 'anios', 'unidadcurricular', 'turnos', 'users', 'docentes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $carreras = Carrera::all();
        $anios = Anio::all();
        $unidadCurriculars = UnidadCurricular::all();
        $turnos = Turno::all();
        $usuarios = User::all();

        return view('mesaexamenes.create', compact('carreras', 'anios', 'unidadCurriculars', 'turnos', 'usuarios'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


     // En el controlador

     public function getUnidadesCurriculares(Request $request)
     {
         $carreraId = $request->input('carreras_id');
         $anioId = $request->input('anios_id');
 
         $unidadesCurriculares = UnidadCurricular::where('carreras_id', $carreraId)
             ->where('anios_id', $anioId)
             ->get();
 
         return response()->json($unidadesCurriculares);
     }
 



    public function store(Request $request)
{
    $request->validate([
        'carreras_id' => 'required|exists:carreras,id',
        'anios_id' => 'required|exists:anios,id',
        'unidad_curriculars_id' => 'required|exists:unidad_curriculars,id',
        'turnos_id' => 'required|exists:turnos,id',
        'user_id' => 'required|exists:users,id',
        'hora' => 'required',
        'llamado' => 'required',
        'llamado2' => 'required',
        'presidente_id' => 'required',
        'vocal_id' => 'required',
        'vocal2_id' => 'required',
        
    ]);

    // Verifica si ya existe una mesa con la misma combinación de carrera, año y unidad curricular
    $mesaExistente = Mesaexamen::where([
        'carreras_id' => $request->carreras_id,
        'anios_id' => $request->anios_id,
        'unidad_curriculars_id' => $request->unidad_curriculars_id,
    ])->first();

    if ($mesaExistente) {
        // Muestra un mensaje de error y redirige de vuelta al formulario
        return redirect()->route('mesaexamens.index')->with('error', 'Ya existe una mesa con la misma combinación de carrera, año y unidad curricular.');
    }

    // Verifica si los docentes seleccionados como presidente, vocal y vocal2 son diferentes
    if ($request->presidente_id == $request->vocal_id || $request->presidente_id == $request->vocal2_id || $request->vocal_id == $request->vocal2_id) {
        // Muestra un mensaje de error y redirige de vuelta al formulario
        return redirect()->route('mesaexamens.index')->with('error', 'Los docentes seleccionados como presidente, vocal y vocal2 deben ser diferentes.');
    }


    // Si no hay una mesa existente, crea la nueva mesa
    $mesasexamenes = new Mesaexamen($request->all());
    $mesasexamenes->save();

    return redirect()->route('mesaexamens.index')->with('success', 'Nueva Mesa de Examen Agregada');
}


    // Resto de los métodos (show, edit, update, destroy) sigue la estructura similar al controlador de Unidad Curricular.









    public function show(Request $request)
{
    Paginator::useBootstrap();

    $query = Mesaexamen::with('carrera', 'anio', 'unidadCurricular', 'turno', 'presidente', 'vocal', 'vocal2');

    // Aplica filtros si se proporcionan en la solicitud
    if ($request->filled('filtro_anio')) {
        $query->whereHas('anio', function ($q) use ($request) {
            $q->where('id', $request->filtro_anio);
        });
    }

    if ($request->filled('filtro_carrera')) {
        $query->whereHas('carrera', function ($q) use ($request) {
            $q->where('id', $request->filtro_carrera);
        });
    }

    $mesasexamenes = $query->get();
    $anios = Anio::all(); // Asegúrate de obtener los años necesarios aquí
    $carreras = Carrera::all(); // Asegúrate de obtener las carreras necesarias aquí

    return view('mesaexamens.lista', compact('mesasexamenes', 'anios', 'carreras'));
}

    
    
    
    
    
    


    /**
     * Show the form for editing the specified resource.
     * @param int
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
{
    // Obtener la MesaExamen por su ID
    $mesaexamen = Mesaexamen::with('carrera', 'anio', 'unidadCurricular', 'turno', 'presidente', 'vocal', 'vocal2')->find($id);

    // Obtener datos adicionales necesarios para el formulario de edición (si es necesario)
    $carreras = Carrera::all();
    $anios = Anio::all();
    $unidadCurriculars = UnidadCurricular::all();
    $turnos = Turno::all();
    $usuarios = User::all();
    $docentes = Docente::all();

    // Verificar si se encontró la MesaExamen
    if (!$mesaexamen) {
        // Manejar la situación en la que no se encontró la MesaExamen (puedes redirigir a una página de error o hacer lo que sea necesario)
        return redirect()->route('mesaexamens.index')->with('error', 'Mesa de Examen no encontrada.');
    }

    // Pasar los datos a la vista del formulario de edición
    return view('mesaexamens.edit', compact('mesaexamen', 'carreras', 'anios', 'unidadCurriculars', 'turnos', 'usuarios', 'docentes'));
}



    

    /**
     * Update the specified resource in storage.
     * @param int
     * @return \Illuminate\Http\Response
     */
  /**
 * Update the specified resource in storage.
 *
 * @param int
 * @return \Illuminate\Http\Response
 */
/**
 * Update the specified resource in storage.
 *
 * @param int
 * @return \Illuminate\Http\Response
 */
public function update(Request $request, $id)
{
    $request->validate([
        'anios_id' => 'required',
        'carreras_id' => 'required',
        'unidad_curriculars_id' => 'required',
        'turnos_id' => 'required',
        'hora' => 'required',
        'llamado' => 'required',
        'llamado2' => 'required',
        'presidente_id' => 'required',
        'vocal_id' => 'required',
        'vocal2_id' => 'required',
        // Agrega aquí las validaciones para las demás columnas necesarias
    ]);

    // Obtén la instancia de Mesaexamen por su ID
    $mesaexamen = Mesaexamen::find($id);

    // Verifica si se encontró la Mesaexamen
    if (!$mesaexamen) {
        // Manejar la situación en la que no se encontró la Mesaexamen (puedes redirigir a una página de error o hacer lo que sea necesario)
        return redirect()->route('mesaexamens.lista')->with('error', 'Mesa de Examen no encontrada.');
    }

    // Verifica si los docentes seleccionados como presidente, vocal y vocal2 son diferentes
    if ($request->presidente_id == $request->vocal_id || $request->presidente_id == $request->vocal2_id || $request->vocal_id == $request->vocal2_id) {
        // Muestra un mensaje de error y redirige de vuelta a la página de edición de la mesa con el ID correspondiente
        return redirect()->route('mesaexamens.edit', $id)->with('error', 'Los docentes seleccionados como Presidente, Vocal y Vocal 2 deben ser diferentes.');
    }

    // Actualiza los valores en la instancia de Mesaexamen
    $mesaexamen->anios_id = $request->anios_id;
    $mesaexamen->carreras_id = $request->carreras_id;
    $mesaexamen->unidad_curriculars_id = $request->unidad_curriculars_id;
    $mesaexamen->turnos_id = $request->turnos_id;
    $mesaexamen->hora = $request->hora;
    $mesaexamen->llamado = $request->llamado;
    $mesaexamen->llamado2 = $request->llamado2;
    $mesaexamen->presidente_id = $request->presidente_id;
    $mesaexamen->vocal_id = $request->vocal_id;
    $mesaexamen->vocal2_id = $request->vocal2_id;
    // Actualiza los demás campos según sea necesario

    // Guarda los cambios
    $mesaexamen->save();

    // Redirige a la lista después de actualizar
    return redirect()->route('mesaexamens.lista')->with('success', 'Mesa de Examen Actualizada');
}






    /**
     * Remove the specified resource from storage.
     * @param int
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
{
    $mesaexamen = Mesaexamen::find($id);

    if ($mesaexamen) {
        $mesaexamen->delete();
        return redirect()->route('mesaexamens.lista')->with('success', 'Mesa de Examen Eliminada');
    }

    return redirect()->route('mesaexamens.index')->with('error', 'Mesa de Examen no encontrada.');
}





public function exportarExcel(Request $request)
    {
        Paginator::useBootstrap();

        $query = Mesaexamen::with('carrera', 'anio', 'unidadCurricular', 'turno', 'presidente', 'vocal', 'vocal2');


        $mesasexamenes = $query->get();

        $data = $mesasexamenes->map(function ($mesaexamen) {
            return [
                'Carrera' => $mesaexamen->carrera->description, // Ajusta según la relación en tu modelo
                'Anio' => $mesaexamen->anio->description, // Ajusta según la relación en tu modelo
                'Unidad Curricular' => $mesaexamen->unidadCurricular->name, // Ajusta según la relación en tu modelo
                'Turno' => $mesaexamen->turno->description, // Ajusta según la relación en tu modelo
                'Hora' => $mesaexamen->hora,
                'Llamado' => $mesaexamen->llamado,
                'Llamado2' => $mesaexamen->llamado2,
                'Presidente' => $mesaexamen->presidente->nom_doc, // Ajusta según la relación en tu modelo
                'Vocal' => $mesaexamen->vocal->nom_doc, // Ajusta según la relación en tu modelo
                'Vocal 2' => $mesaexamen->vocal2->nom_doc, // Ajusta según la relación en tu modelo
                // Agrega aquí las demás columnas necesarias
            ];
        });

        return (new FastExcel($data))->download('Mesas_De_Examenes.xlsx');
    }

}
