<?php

namespace App\Http\Controllers;
use App\Models\Uinscription;
use App\Models\Carrera;
use App\Models\Mesaexamen;
use App\Models\Anio;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

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
