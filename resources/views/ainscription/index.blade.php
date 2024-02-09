@extends('app')

@section('content')

<style>
    .table th,
    .table td {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .table th {
        text-align: center;
    }

    .table th.long-header {
        white-space: normal;
    }

    .table-container {
        overflow-x: auto; /* Agrega desplazamiento horizontal cuando la tabla es demasiado ancha */
    }

    .table tbody tr {
        margin-bottom: 10px;
    }
</style>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-12">
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
                        <table class="table table-sm table-bordered">
                            <thead>
                                <tr>
                                    <th class="long-header">Numero De Inscricpion</th>
                                    <th>Usuario</th>
                                    <th>Año</th>
                                    <th>Carrera - Asignatura</th>
                                    <th>Turno</th>
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

<div class="d-flex justify-content-between align-items-center">
    <br>
    <br>
</div>

@endsection
