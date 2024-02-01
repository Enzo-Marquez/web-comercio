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
                    <h5 class="mb-0">Lista de Mesas de Examen</h5>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="table-container"> <!-- Contenedor con desplazamiento horizontal -->
                        <table class="table table-bordered">
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
                                    <th>Acciones</th>
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
                                        <td>{{ $mesaexamen->llamado }}</td>
                                        <td>{{ $mesaexamen->llamado2 }}</td>
                                        <td>{{ $mesaexamen->presidente->nom_doc }}</td>
                                        <td>{{ $mesaexamen->vocal->nom_doc }}</td>
                                        <td>{{ $mesaexamen->vocal2->nom_doc }}</td>
                                        <td>
                                            <a href="{{ route('mesaexamens.edit', ['mesaexamen' => $mesaexamen->id]) }}" class="btn btn-primary">Editar</a>
                                        
                                        
                                            <!-- Botón Eliminar con Modal de Confirmación -->
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal{{ $mesaexamen->id }}">
                                                Eliminar
                                            </button>
                                            </td>
                                            <!-- Modal de Confirmación -->
                                            <div class="modal fade" id="confirmDeleteModal{{ $mesaexamen->id }}" tabindex="-1" aria-labelledby="confirmDeleteModalLabel{{ $mesaexamen->id }}" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="confirmDeleteModalLabel{{ $mesaexamen->id }}">Confirmar Eliminación</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            ¿Está seguro de que desea eliminar esta Mesa de Examen?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                            <form action="{{ route('mesaexamens.destroy', ['mesaexamen' => $mesaexamen->id]) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger">Eliminar</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <!-- Agrega más columnas según sea necesario -->
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-between align-items-center">
                        <br>
                        <br>
                        <a href="{{ route('mesaexamens.index') }}" class="btn btn-primary">Agregar Mesa de Examen</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
