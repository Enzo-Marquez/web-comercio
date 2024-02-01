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

class MesaexamenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Paginator::useBootstrap();

        $mesasexamenes = Mesaexamen::with('carrera', 'anio', 'unidadCurricular', 'turno', 'usuario')->paginate(6);
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
            // Agrega aquí las validaciones para las demás columnas necesarias
        ]);

        $mesasexamenes = new Mesaexamen($request->all());
        $mesasexamenes->save();

        return redirect()->route('mesaexamens.index')->with('success', 'Nueva Mesa de Examen Agregada');
    }

    // Resto de los métodos (show, edit, update, destroy) sigue la estructura similar al controlador de Unidad Curricular.









    public function show()
    {
        // Lógica para obtener datos para la vista lista.blade.php, si es necesario
        $mesasexamenes = Mesaexamen::with('carrera', 'anio', 'unidadCurricular', 'turno', 'presidente', 'vocal', 'vocal2')->paginate(10);

        return view('mesaexamens.lista', compact('mesasexamenes'));
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
        return redirect()->route('mesaexamens.index')->with('error', 'Mesa de Examen no encontrada.');
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

}
