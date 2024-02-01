@extends('app')

@section('content')

<style>
    .table tbody tr {
        margin-bottom: 10px;
    }
</style>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Lista de Unidades Curriculares</h5>
                </div>
                <div class="card-body">
                    <!-- Mostrar mensaje de éxito si existe -->
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="mt-4">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Año</th>
                                    <th>Carrera</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($unidadcurricular as $unidad)
                                    <tr>
                                        <td>{{ $unidad->name }}</td>
                                        <td>{{ optional($unidad->anio)->description }}</td>
                                        <td>{{ optional($unidad->carrera)->description }}</td>
                                        <td>
                                            <div class="d-flex justify-content-between">
                                                <a href="{{ route('unidadcurricular.edit', ['unidadcurricular' => $unidad->id]) }}" class="btn btn-primary">Editar</a>
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal{{ $unidad->id }}">
                                                    Eliminar
                                                </button>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Modal (Eliminación) -->
<div class="modal fade" id="modal{{ $unidad->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Eliminar Unidad Curricular</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>¿Estás seguro de que quieres eliminar la unidad curricular "{{ $unidad->name }}"?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <form action="{{ route('unidadcurricular.destroy', ['unidadcurricular' => $unidad->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>

                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <a href="{{ route('unidadcurricular.index') }}" class="btn btn-primary">Agregar Unidad Curricular</a>

                    <!-- Paginación -->
                    <div class="d-flex justify-content-center mt-4">
                        <nav aria-label="Page navigation example">
                            <!-- ... (código de paginación) ... -->
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
