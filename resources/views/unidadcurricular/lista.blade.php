@extends('app')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">


<div>
    <div class="row justify-content-center">
        <div>
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Lista de Unidades Curriculares</h5>



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
        <form action="{{ route('unidadcurricular.filter') }}" method="GET">
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
</div>


                    <div class="mt-4">
                        <table id="asd" class="table table-bordered">
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
                <td class="text-end">
                <a href="{{ route('unidadcurricular.edit', ['unidadcurricular' => $unidad->id]) }}" class="btn btn-primary btn-sm">Editar
                </a>
                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modal{{ $unidad->id }}">
                    Eliminar
                </button>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="text-center">
<a href="{{ route('unidadcurricular.index') }}" class="btn btn-primary">Agregar Unidad Curricular</a>
<div>
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
            <option value='10'>10</option>
            <option value='25'>25</option>
            <option value='50'>50</option>
            <option value='100'>100</option>
            <option value='-1'>Todos</option>
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
