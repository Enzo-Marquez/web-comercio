@extends('app')

@section('content')

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Formulario de Unidad Curricular</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('unidadcurricular.store') }}" method="POST">
                        @csrf

                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success')}}</div>
                        @endif

                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <div class="mb-3">
                            <label for="name" class="form-label">Unidad Curricular</label>
                            <input placeholder="Ingrese la Unidad Curricular" type="text" name="name" class="form-control">
                            <div class="form-text">
                                Estas una vez creadas,
                                se podrán seleccionar en un desplegable en la creación de la mesa de exámenes.
                            </div>
                            
                        </div>

                        <div class="mb-3">
                            <label for="anios_id" class="form-label">Año</label>
                            <select name="anios_id" class="form-select">
                                <option selected disabled>Seleccione un año</option>
                                @foreach ($anios as $anio)
                                    <option value="{{ $anio->id }}">{{ $anio->description }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="carreras_id" class="form-label">Carrera</label>
                            <select name="carreras_id" class="form-select">
                                <option selected disabled>Seleccione una carrera</option>
                                @foreach ($carreras as $carrera)
                                    <option value="{{ $carrera->id }}">{{ $carrera->description }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Crear Unidad Curricular</button>
                    </form>
                </div>
            </div>

            <div class="mt-4">
                <table class="table">
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
                                <td>
                                    <a href="{{ route('unidadcurricular.show', ['unidadcurricular' => $unidad->id, 'anios' => $anios, 'carreras' => $carreras]) }}">
                                        {{ $unidad->name }}
                                    </a>
                                </td>
                                <td>{{ optional($unidad->anio)->description }}</td>
                                <td>{{ optional($unidad->carrera)->description }}</td>
                                <td>
                                    <button type="button" class="btn btn-danger" onclick="openModal({{ $unidad->id }})">
                                        Eliminar
                                    </button>
                                </td>
                            </tr>

                            <!-- Modal para eliminar -->
                            <div class="modal fade" id="modal-{{ $unidad->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar Unidad Curricular</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Al eliminar la Unidad Curricular <strong>{{ $unidad->name }}</strong>, se eliminará la opción de seleccionar dicha Unidad Curricular en la creación de la mesa de exámenes. ¿Está seguro de que desea eliminar la Unidad Curricular?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Volver</button>
                                            <form action="{{ route('unidadcurricular.destroy', ['unidadcurricular' => $unidad->id]) }}" method="POST">
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
            @if ($unidadcurricular->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link">Anterior</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $unidadcurricular->previousPageUrl() }}" aria-label="Anterior">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
            @endif

            {{-- Números de página --}}
            @for ($i = 1; $i <= $unidadcurricular->lastPage(); $i++)
                <li class="page-item {{ $unidadcurricular->currentPage() == $i ? 'active' : '' }}">
                    <a class="page-link" href="{{ $unidadcurricular->url($i) }}">{{ $i }}</a>
                </li>
            @endfor

            {{-- Siguiente --}}
            @if ($unidadcurricular->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $unidadcurricular->nextPageUrl() }}" aria-label="Siguiente">
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

<!-- Script para abrir el modal de eliminar-->
<script>
    function openModal(id) {
        var myModal = new bootstrap.Modal(document.getElementById('modal-' + id));
        myModal.show();
    }
</script>

@endsection
