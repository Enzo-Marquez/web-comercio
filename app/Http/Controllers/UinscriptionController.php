<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Uinscription;
use App\Models\Carrera;
use App\Models\Usercarrera;
use App\Models\Anio;
use App\Models\UnidadCurricular;
use App\Models\Turno;
use App\Models\User;
use App\Models\Mesaexamen;


class UinscriptionController extends Controller

{
    public function showUnidadesCurriculares(Request $request)
{
    $carrera_id = $request->input('carrera_id');

    $usercarreras = Usercarrera::with(['carrera', 'user'])
        ->where('user_id', Auth::id())
        ->where('carrera_id', $carrera_id)
        ->first();

    // Asegúrate de que $usercarreras no esté vacío antes de continuar
    if ($usercarreras) {
        // Obtén la lista de años disponibles
        // ...

        // Filtra las mesas de examen por año si se ha seleccionado uno
        $mesaexamens = Mesaexamen::with(['anio', 'unidadCurricular'])
            ->where('carreras_id', $carrera_id)
            ->paginate(15);

        // Verifica si el usuario está inscrito en cada mesa de examen y agrega la información a la colección
        foreach ($mesaexamens as $mesaexamen) {
            $uinscription = Uinscription::where('user_id', Auth::id())
                ->where('mesaexamen_id', $mesaexamen->id)
                ->first();


            $mesaexamen->isInscrito = $uinscription !== null; // BOTON VERDE DE INSCRIPTO
        }

        return view('uinscription.unid', compact('mesaexamens'));
    } else {
        // Manejo si $usercarreras está vacío (sin resultados)
        return view('uinscription.unid', ['mesaexamens' => []]);
    }
}





public function filterUnidadesCurriculares(Request $request)
{
    // Obtener el término de búsqueda desde la solicitud
    $searchTerm = $request->input('search');

    // Filtrar las mesas de examen según el término de búsqueda
    $mesaexamens = Mesaexamen::with(['anio', 'unidadCurricular'])
        ->whereHas('unidadCurricular', function ($query) use ($searchTerm) {
            $query->where('name', 'LIKE', "%$searchTerm%");
        })
        ->get();


    // Verificar si el usuario está inscrito en cada mesa de examen y agregar la información a la colección
    foreach ($mesaexamens as $mesaexamen) {
        $uinscription = Uinscription::where('user_id', Auth::id())
            ->where('mesaexamen_id', $mesaexamen->id)
            ->first();

        $mesaexamen->isInscrito = $uinscription !== null; // BOTON VERDE DE INSCRIPTO
    }

    // Puedes personalizar este retorno según tus necesidades
    return view('uinscription.unid', compact('mesaexamens', 'searchTerm'));
}






    public function lista()
{
    $usercarreras = Usercarrera::with(['carrera', 'user'])
        ->where('user_id', Auth::id())
        ->get();

    if ($usercarreras->isNotEmpty()) {
        $carreras = $usercarreras->pluck('carrera');
    } else {
        $carreras = collect(); // Crear una colección vacía si no hay carreras asociadas al usuario
    }

    return view('uinscription.lista', compact('carreras', 'usercarreras'));
}

    


public function showMesas(Request $request)
{
    $carrera_id = $request->input('carrera_id');

    $usercarreras = Usercarrera::with(['carrera', 'user'])
        ->where('user_id', Auth::id())
        ->where('carrera_id', $carrera_id)
        ->first();

    // Asegúrate de que $usercarreras no esté vacío antes de continuar
    if ($usercarreras) {
        $mesaexamens = Mesaexamen::with(['carrera', 'unidadCurricular', 'turno'])
            ->where('carreras_id', $carrera_id)
            ->get();

        return view('uinscription.index', compact('usercarreras', 'mesaexamens'));
    } else {
        // Manejo si $usercarreras está vacío (sin resultados)
        return view('uinscription.index', ['usercarreras' => null, 'mesaexamens' => []]);
    }
}


public function index($mesaexamen_id)
{
    $mesa_id = $mesaexamen_id;
    $usercarreras = Usercarrera::with(['carrera', 'user'])
        ->where('user_id', Auth::id())
        ->first();

    // Asegúrate de que $usercarreras no sea nulo antes de continuar
    if ($usercarreras) {
        $mesaexamens = Mesaexamen::with(['carrera', 'unidadCurricular', 'turno', 'anio'])
            ->select('carreras_id','anios_id','unidad_curriculars_id','turnos_id','presidente_id','vocal_id','vocal2_id','hora',
            'llamado',
            'llamado2',)
            ->where('id', $mesaexamen_id)
            ->first();

        // Obtén la instancia de Uinscription según sea necesario
        $uinscription = Uinscription::where('user_id', Auth::id())
            ->where('mesaexamen_id', $mesaexamen_id)
            ->first();

        // Pasa la información a la vista
        return view('uinscription.index', compact('usercarreras', 'mesaexamens', 'mesa_id', 'uinscription'));
    } else {
        // Manejo si $usercarreras está nulo (sin resultados)
        return view('uinscription.index', ['usercarreras' => null, 'mesaexamens' => null, 'mesa_id' => $mesa_id, 'uinscription' => null]);
    }
}










    
    

    public function create()
    {
        //
    }








    public function store(Request $request)
{
    $request->validate([
        'mesaexamen_id' => 'required|exists:mesaexamens,id',
        'user_id' => 'required|exists:users,id',
        // 'anios_id' => '|exists:anios,id',
        // 'unidad_curriculars_id' => '|exists:unidad_curriculars,id',
        // 'turnos_id' => '|exists:turnos,id',
    ]);

    $mesaexamen_id = $request->input('mesaexamen_id');

    // Verificar si ya existe la asignación para esta carrera y usuario
    $existingAssignment = Uinscription::where('user_id', $request->user_id)
        ->where('mesaexamen_id', $request->mesaexamen_id)
        ->first();

    if ($existingAssignment) {
        return redirect()->route('uinscription.index',['mesaexamen_id' => $mesaexamen_id])->with('error', 'Ya se inscribió a esta Mesa');
    }

     // Verifica si el usuario tiene el perfil completo
     $user = User::find($request->user_id);

     if (!$user->dni || !$user->apellido) {
         return redirect()->route('uinscription.index', ['mesaexamen_id' => $mesaexamen_id])->with('error', 'Completa tu perfil antes de inscribirte.');
     }
    // Crear una nueva instancia de Uinscription y asignar valores
    $uinscription = new Uinscription($request->all());
    $uinscription->save();


    // Redirigir al índice con el parámetro mesaexamen_id
    return redirect()->route('uinscription.index', ['mesaexamen_id' => $mesaexamen_id])
                     ->with('success', 'Formulario de Inscripción enviado con éxito.');
}





    // Puedes agregar más métodos según sea necesario

    public function show($id)
    {
        // Implementa la lógica para mostrar un formulario de inscripción específico si es necesario
        $uinscription = Uinscription::with('carrera', 'anio', 'unidadCurricular', 'turno', 'usuario')->find($id);

        return view('uinscription.show', compact('uinscription'));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {

    }

    public function destroy($id, $mesaexamen_id)
{
    $uinscription = Uinscription::where('id', $id)
        ->where('mesaexamen_id', $mesaexamen_id)
        ->first();

    if (!$uinscription) {
        return redirect()->route('uinscription.index')->with('error', 'Inscripción no encontrada');
    }

    $uinscription->delete();

    return redirect()->route('uinscription.index', ['mesaexamen_id' => $mesaexamen_id])->with('success', 'Inscripción Eliminada');
}


    

    




}