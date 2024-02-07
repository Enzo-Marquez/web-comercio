@extends('app')

@section('content')

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Formulario de Turnos</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('turnos') }}" method="POST">
                        @csrf

                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        @error('description')
                            <div class="alert alert-danger">
                            <strong>Error:</strong> El campo "Turno" es obligatorio.
                            </div>
                            @enderror

                        <div class="mb-3">
                            <label for="description" class="form-label">Turnos</label>
                            <input type="text" name="description" class="form-control"
                                placeholder="Ingrese los turnos disponibles">
                            <div class="form-text">
                                Estos turnos, una vez creados, se podrán seleccionar en un desplegable en la creación de
                                la mesa de exámenes.
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Crear Turno</button>
                    </form>
                </div>
            </div>

            <div class="mt-4">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($turnos as $turno)
                            <tr>
                                <td>
                                    <a>{{ $turno->description }}</a>
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('turnos-edit', ['id' => $turno->id]) }}" class="btn btn-primary btn-sm">
                                        Editar
                                    </a>
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modal{{ $turno->id }}">
                                        Eliminar
                                    </button>
                                </td>
                            </tr>

                            <!-- Modal (Eliminación) -->
                            <div class="modal fade" id="modal{{ $turno->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title fs-5" id="exampleModalLabel">Eliminar Turno</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Al eliminar el Turno <strong>{{ $turno->description }}</strong>, se eliminará la opción de seleccionar dicho turno en la creación de la mesa de exámenes. ¿Está seguro de que desea eliminar el Turno?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                            <form action="{{ route('turnos-destroy', ['id' => $turno->id]) }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-danger">Eliminar</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>

                <!-- Paginación -->
                <div class="d-flex justify-content-center mt-4">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            {{-- Anterior --}}
                            @if ($turnos->onFirstPage())
                                <li class="page-item disabled">
                                    <span class="page-link">Anterior</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $turnos->previousPageUrl() }}" aria-label="Anterior">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                            @endif

                            {{-- Números de página --}}
                            @for ($i = 1; $i <= $turnos->lastPage(); $i++)
                                <li class="page-item {{ $turnos->currentPage() == $i ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $turnos->url($i) }}">{{ $i }}</a>
                                </li>
                            @endfor

                            {{-- Siguiente --}}
                            @if ($turnos->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $turnos->nextPageUrl() }}" aria-label="Siguiente">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            @else
                                <li class="page-item disabled">
                                    <span class="page-link">Siguiente</span>
                                </li>
                            @endif
                        </ul>
                    </nav>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
