<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
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
use App\Models\Uinscription;
use App\Models\Usercarrera;

class ModeradorController extends Controller
{
   



    public function filter3(Request $request)
{

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
    return view('moderator.lista2', compact('mesasexamenes', 'anios', 'carreras'));
}




    


    











    public function index()
    {
        
    }

    public function create()
    {
     
    }

 

     public function getUnidadesCurriculares2(Request $request)
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
}








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

    return view('moderador.lista2', compact('mesasexamenes', 'anios', 'carreras'));
}

    
    
    
    
    
    
    public function edit($id)
{

}
    

public function update(Request $request, $id)
{
   
}





    public function destroy($id)
{

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
