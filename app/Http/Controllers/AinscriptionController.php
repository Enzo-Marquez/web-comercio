<?php

namespace App\Http\Controllers;
use App\Models\Uinscription;
use App\Models\Carrera;
use App\Models\Mesaexamen;
use App\Models\Anio;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Rap2hpoutre\FastExcel\FastExcel;

class AinscriptionController extends Controller
{


    // UinscriptionController.php

    public function index()
    {
        // Obtén los datos de Uinscription con relaciones a Mesaexamen y Usuario (ajustado a 'usuario')
        $uinscriptions = Uinscription::with(['mesaexamen', 'usuario'])->get();

        // Pasa los datos a la vista Ainscription
        return view('ainscription.index', compact('uinscriptions'));
    }

    
    
    public function showForm()
{
    $carreras = Carrera::all();
    $anios = Anio::all();
    return view('ainscription.lista', compact('carreras','anios'));
}

public function exportarExcel(Request $request)
    {
        $uinscriptionsQuery = Uinscription::with(['mesaexamen.anio', 'mesaexamen.carrera']);

        // Aplicar filtros si existen en la solicitud
        if ($request->filled('carrera_id')) {
            $uinscriptionsQuery->whereHas('mesaexamen.carrera', function ($query) use ($request) {
                $query->where('id', $request->carrera_id);
            });
        }

        if ($request->filled('anio_id')) {
            $uinscriptionsQuery->whereHas('mesaexamen.anio', function ($query) use ($request) {
                $query->where('id', $request->anio_id);
            });
        }

        $uinscriptions = $uinscriptionsQuery->get();

        $data = $uinscriptions->map(function ($uinscription) {
            return [
                'Numero De Inscripcion' => $uinscription->id,
                'Alumno' => optional($uinscription->usuario)->name . ' ' . optional($uinscription->usuario)->apellido,
                'Dni Alumno' => optional($uinscription->usuario)->dni,
                'Correo Alumno' => optional($uinscription->usuario)->email,
                'Año' => optional(optional($uinscription->mesaexamen)->anio)->description,
                'Carrera - Asignatura' => optional(optional($uinscription->mesaexamen)->carrera)->description . ' - ' . optional(optional($uinscription->mesaexamen)->unidadCurricular)->name,
                'Turno' => optional(optional($uinscription->mesaexamen)->turno)->description,
                'Llamado' => optional($uinscription->mesaexamen)->llamado ? \Carbon\Carbon::parse($uinscription->mesaexamen->llamado)->format('d/m/Y') : null,
                'Llamado2' => optional($uinscription->mesaexamen)->llamado2 ? \Carbon\Carbon::parse($uinscription->mesaexamen->llamado2)->format('d/m/Y') : null,
                'Docentes' => optional(optional($uinscription->mesaexamen)->presidente)->nom_doc . ' | ' . optional(optional($uinscription->mesaexamen)->vocal)->nom_doc . ' | ' . optional(optional($uinscription->mesaexamen)->vocal2)->nom_doc,
                'Fecha y Hora de Inscripcion' => $uinscription->created_at->format('d/m/Y -- H:i:s'),
            ];
        });

        $fileName = 'Inscripciones.xlsx';

        return (new FastExcel($data))->download($fileName);
    }




public function filtrarCarreras(Request $request)
{
    Paginator::useBootstrap();
    
    $uinscriptions = Uinscription::with(['mesaexamen.anio', 'mesaexamen.carrera']);
    
    // Aplicar filtros si existen en la solicitud
    if ($request->filled('carrera_id')) {
        $uinscriptions->whereHas('mesaexamen.carrera', function ($query) use ($request) {
            $query->where('id', $request->carrera_id);
        });
    }

    if ($request->filled('anio_id')) {
        $uinscriptions->whereHas('mesaexamen', function ($query) use ($request) {
            $query->where('anios_id', $request->anio_id);
        });
    }

    $uinscriptions = $uinscriptions->get();
    $anios = Anio::all();
    $carreras = Carrera::all();
    
    return view('ainscription.index', compact('uinscriptions', 'carreras', 'anios'));
}












    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
