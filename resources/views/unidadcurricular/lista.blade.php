@extends('app')

@section('content')



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

                    <div class="mb-3">
        <form action="{{ route('unidadcurricular.filter') }}" method="GET">
            @csrf
                <label for="search">Buscar:</label>
                <input type="text" class="form-control" name="search" id="search">

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

        <button type="submit" class="btn btn-primary">Filtrar</button>
    </form>
</div>

<div class="container">


                    <div class="mt-4">
                        <table class="table table-sm table-bordered">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Año</th>
                                    <th>Carrera</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="listaConsulta">
                              @foreach ($unidadcurricular as $unidad)
        @if (
            (empty(request('anios_id')) || $unidad->anios_id == request('anios_id')) &&
            (empty(request('carrera_id')) || $unidad->carreras_id == request('carrera_id'))
        )
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
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
<a href="{{ route('unidadcurricular.index') }}" class="btn btn-primary">Agregar Unidad Curricular</a>

                    
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>

   $(document).ready(function() {
    var inputElement = document.getElementById("search");
    if (localStorage.getItem("searchText")) {
        inputElement.value = localStorage.getItem("searchText");
    }
    inputElement.addEventListener("input", function(event) {
        localStorage.setItem("searchText", event.target.value);
        search_table(event.target.value);
    });

    $('#search').keyup(function() {
        search_table($(this).val());
    });

    function search_table(value) {
        var searchWords = value.toLowerCase().split(" ");
        $('#listaConsulta tr').each(function() {
            var found = true;
            var rowText = $(this).text().toLowerCase();

            for (var i = 0; i < searchWords.length; i++) {
                var searchWord = searchWords[i].trim();
                if (rowText.indexOf(searchWord) === -1) {
                    found = false;
                    break;
                }
            }

            if (found) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    }

    search_table($('#search').val());
});



<script>
        $(document).ready(function() {
            $('.carrera-select, .anio-select').change(function() {
                var selectedCarrera = $('.carrera-select').find(':selected').val();
                var selectedAnio = $('.anio-select').find(':selected').val();

                $('.unidad-curricular-select option').hide();
                $('.unidad-curricular-select option').filter(function() {
                    var carreraId = $(this).data('carrera-id');
                    var anioId = $(this).data('anio-id');

                    return (carreraId == selectedCarrera && anioId == selectedAnio);
                }).show();

                $('.unidad-curricular-select').val(null);
            });
        });
    </script>

@endsection
