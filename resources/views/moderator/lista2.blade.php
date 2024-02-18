@extends('app')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">

<div>
    
 
</div>
</div>
<div>
    <div class="row justify-content-center">
        <div>
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Lista de Mesas de Examenes</h5>



                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    {{-- <div class="mb-3">
        <form action="{{ route('unidadcurricular.filter') }}" method="GET">
            @csrf
                <label for="search">Buscar:</label>
                <input type="text" class="form-control" name="search" id="search">
                </div> --}}
        <form action="{{ route('moderator.filter3') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="anios_id" class="form-label">Año</label>
            <select name="anios_id" class="form-select">
                <option value="">Todas los años</option>
                @foreach ($anios as $anio)
                    <option value="{{ $anio->id }}" {{ request('anios_id') == $anio->id ? 'selected' : '' }}>{{ $anio->description }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="carrera_id" class="form-label">Carrera</label>
            <select name="carrera_id" class="form-select">
                <option value="">Todas las carreras</option>
                @foreach ($carreras as $carrera)
                    <option value="{{ $carrera->id }}" {{ request('carrera_id') == $carrera->id ? 'selected' : '' }}>{{ $carrera->description }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
        <label for="fecha_inicio" class="form-label">Fecha de inicio (Llamado 1)</label>
        <input type="date" name="fecha_inicio" class="form-control" value="{{ request('fecha_inicio') }}">
    </div>

    <div class="mb-3">
        <label for="fecha_fin" class="form-label">Fecha de fin (Llamado 1)</label>
        <input type="date" name="fecha_fin" class="form-control" value="{{ request('fecha_fin') }}">
    </div>

    <div class="mb-3">
        <label for="fecha_inicio_llamado2" class="form-label">Fecha de inicio (llamado 2)</label>
        <input type="date" name="fecha_inicio_llamado2" class="form-control" value="{{ request('fecha_inicio_llamado2') }}">
    </div>

    <div class="mb-3">
        <label for="fecha_fin_llamado2" class="form-label">Fecha de fin (llamado 2)</label>
        <input type="date" name="fecha_fin_llamado2" class="form-control" value="{{ request('fecha_fin_llamado2') }}">
    </div>

        <button type="submit" class="btn btn-primary">Filtrar</button>
      </form>
</div>


                    <div class="table-container"> <!-- Contenedor con desplazamiento horizontal -->
                        <table id="asd" class="table table-sm table-bordered">
                            <thead>
                                <tr>
                                    <th class="long-header">Carrera</th>
                                    <th>Año</th>
                                    <th>Unidad Curricular</th>
                                    <th>Turno</th>
                                    <th>Hora</th>
                                    <th>Llamado 1</th>
                                    <th>Llamado 2</th>
                                    <th>Presidente</th>
                                    <th>Vocal</th>
                                    <th>Vocal 2</th>
                                    <!-- Agrega más columnas según sea necesario -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($mesasexamenes as $mesaexamen)
                                    <tr>
                                        <td>{{ $mesaexamen->carrera->description }}</td>
                                        <td>{{ $mesaexamen->anio->description }}</td>
                                        <td>{{ $mesaexamen->unidadCurricular->name }}</td>
                                        <td>{{ $mesaexamen->turno->description }}</td>
                                        <td>{{ $mesaexamen->hora }}</td>
                                        <td>{{ \Carbon\Carbon::parse($mesaexamen->llamado)->format('d/m/Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($mesaexamen->llamado2)->format('d/m/Y') }}</td>
                                        <td>{{ $mesaexamen->presidente->nom_doc }}</td>
                                        <td>{{ $mesaexamen->vocal->nom_doc }}</td>
                                        <td>{{ $mesaexamen->vocal2->nom_doc }}</td>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


 <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script>
$('#asd').DataTable({
responsive: true,
autoWidth: false,
scrollX: true,

"language": {
            "lengthMenu": "Mostrar " + 
            `<select class="form-select form-select-sm">
            <option value='5'>5</option>
            <option value='10'>10</option>
            <option value='15'>15</option>
            </select>` + 
            " Registros por pagina",
    "zeroRecords": "Nada Encontrado - Disculpa",
    "info": "Mostrando la Pagina _PAGE_ De _PAGES_",
    "infoEmpty": "No hay registros disponibles",
    "infoFiltered": "(filtrado de _MAX_ registros totales)",
    'search': 'Buscar:',
    'paginate':{
        'next': 'Siguiente',
        'previous': 'Anterior'
            }
        }
    } );
</script>


@endsection
