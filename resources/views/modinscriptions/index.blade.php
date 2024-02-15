@extends('app')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
<div>
    <div class="row justify-content-center">
        <div>
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Lista de Inscripciones</h5>
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <div class="col-md-12">
                        <!-- Resto del código de la vista -->
                    </div>

                    <div class="table-container"> <!-- Contenedor con desplazamiento horizontal -->
                        <table id="asd" class="table table-sm table-bordered">
                            <thead>
                                <tr>
                                    <th class="long-header">Numero De Inscricpion</th>
                                    <th>Alumno</th>
                                    <th>Dni Alumno</th>
                                    <th>Correo Alumno</th>
                                    <th>Año</th>
                                    <th>Carrera - Asignatura</th>
                                    <th>Turno</th>
                                    <th>Llamado</th>
                                    <th>Llamado2</th>
                                    <th>Docentes</th>
                                    <th>Fecha y Hora de Inscripcion</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($uinscriptions as $uinscription)
                                    <tr>
                                        <td>{{ $uinscription->id }}</td>
                                        <td>
                                            @if ($uinscription->usuario)
                                                {{ $uinscription->usuario->name }} {{ $uinscription->usuario->apellido }}
                                            @else
                                                Usuario no disponible
                                            @endif
                                        </td>
                                        <td>
                                            @if ($uinscription->usuario)
                                                {{ $uinscription->usuario->dni }}
                                            @else
                                                Usuario no disponible
                                            @endif
                                        </td>
                                        <td>
                                            @if ($uinscription->usuario)
                                                {{ $uinscription->usuario->email }}
                                            @else
                                                Usuario no disponible
                                            @endif
                                        </td>
                                        <td>
                                            @if ($uinscription->mesaexamen && $uinscription->mesaexamen->anio)
                                                {{ $uinscription->mesaexamen->anio->description }}
                                            @else
                                                Año no disponible
                                            @endif
                                        </td>
                                        <td>
                                            @if ($uinscription->mesaexamen)
                                                {{ $uinscription->mesaexamen->carrera->description }} - {{ $uinscription->mesaexamen->unidadCurricular->name }}
                                            @else
                                                Mesa de examen no disponible
                                            @endif
                                        </td>
                                        <td>
                                            {{ $uinscription->mesaexamen->turno->description }}
                                        </td>
                                         <td>{{ \Carbon\Carbon::parse($uinscription->mesaexamen->llamado)->format('d/m/Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($uinscription->mesaexamen->llamado2)->format('d/m/Y') }}</td>
                                        <td>
    {{ optional($uinscription->mesaexamen->presidente)->nom_doc }} |
    {{ optional($uinscription->mesaexamen->vocal)->nom_doc }} |
    {{ optional($uinscription->mesaexamen->vocal2)->nom_doc }}
</td>
                                        <td>
                                            {{ $uinscription->created_at->format('d/m/Y -- H:i:s') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- <div class="text-center mt-3">
    <a href="{{ route('exportar-excel') }}" class="btn btn-success">Exportar a Excel</a>
</div> --}}

<div class="d-flex justify-content-between align-items-center">
    <br>
    <br>
</div>

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script>
$('#asd').DataTable({
responsive: true,
autoWidth: false,

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
