@extends('app')

@section('content')

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Formulario de Docentes</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('docentes') }}" method="POST">
                        @csrf

                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        @error('nom_doc')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <div class="mb-3">
                            <label for="nom_doc" class="form-label">Docentes</label>
                            <input type="text" name="nom_doc" class="form-control" placeholder="Ingrese los docentes disponibles">
                            <div class="form-text">
                                Estos docentes, una vez creados, se podrán seleccionar en un desplegable en la creación de la mesa de exámenes.
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Crear Docente</button>
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
                        @foreach ($docentes as $docente)
                            <tr>
                                <td>
                                    <a>{{ $docente->nom_doc }}</a>
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('docentes-show', ['id' => $docente->id]) }}" class="btn btn-primary btn-sm">
                                        Editar
                                    </a>
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modal{{ $docente->id }}">
                                        Eliminar
                                    </button>
                                </td>
                            </tr>

                            <!-- Modal (Eliminación) -->
                            <div class="modal fade" id="modal{{ $docente->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title fs-5" id="exampleModalLabel">Eliminar Docente</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Al eliminar el Docente <strong>{{ $docente->nom_doc }}</strong>, se eliminará la opción de seleccionar dicha docente en la creación de la mesa de exámenes. ¿Está seguro de que desea eliminar la Docente?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                            <form action="{{ route('docentes-destroy', ['id' => $docente->id]) }}" method="POST">
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
                            @if ($docentes->onFirstPage())
                                <li class="page-item disabled">
                                    <span class="page-link">Anterior</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $docentes->previousPageUrl() }}" aria-label="Anterior">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                            @endif

                            {{-- Números de página --}}
                            @for ($i = 1; $i <= $docentes->lastPage(); $i++)
                                <li class="page-item {{ $docentes->currentPage() == $i ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $docentes->url($i) }}">{{ $i }}</a>
                                </li>
                            @endfor

                            {{-- Siguiente --}}
                            @if ($docentes->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $docentes->nextPageUrl() }}" aria-label="Siguiente">
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
