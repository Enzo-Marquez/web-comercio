@extends('app')

@section('content')

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Formulario de Años</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('anios') }}" method="POST">
                        @csrf

                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        @error('description')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <div class="mb-3">
                            <label for="description" class="form-label">Años</label>
                            <div class="form-text">
                                Ingrese los años disponibles para las mesas de exámenes. Estos, una vez creados, se podrán
                                seleccionar en un desplegable en la creación de la mesa de exámenes.
                            </div>
                            <input type="text" name="description" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Crear Año</button>
                    </form>
                </div>
            </div>

            <div class="mt-4">
                @if(count($anios) > 0)
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Años De Carreras</th>
                                <th scope="col" class="text-end">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($anios as $anio)
                                <tr>
                                    <td>
                                        <a href="{{ route('anios-edit', ['id' => $anio->id]) }}">{{ $anio->description }}</a>
                                    </td>
                                    <td class="text-end">
                                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#modal{{ $anio->id }}">
                                            Eliminar
                                        </button>
                                    </td>
                                </tr>

                                <!-- Modal -->
                                <div class="modal fade" id="modal{{ $anio->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title fs-5" id="exampleModalLabel">Eliminar Año</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Al eliminar el año <strong>{{ $anio->description }}</strong>, se eliminará
                                                la opción de seleccionar dicho año en la creación de la mesa de exámenes.
                                                ¿Está seguro de que desea eliminar el Año?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Volver
                                                </button>
                                                <form action="{{ route('anios-destroy', ['id' => $anio->id]) }}"
                                                    method="POST">
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
                    
                    <!-- Controles de paginación -->
                    <div class="d-flex justify-content-center mt-4">
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            {{-- Anterior --}}
            @if ($anios->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link">Anterior</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $anios->previousPageUrl() }}" aria-label="Anterior">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
            @endif

            {{-- Números de página --}}
            @for ($i = 1; $i <= $anios->lastPage(); $i++)
                <li class="page-item {{ $anios->currentPage() == $i ? 'active' : '' }}">
                    <a class="page-link" href="{{ $anios->url($i) }}">{{ $i }}</a>
                </li>
            @endfor

            {{-- Siguiente --}}
            @if ($anios->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $anios->nextPageUrl() }}" aria-label="Siguiente">
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

                    
                @else
                    <p>No hay años disponibles.</p>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
