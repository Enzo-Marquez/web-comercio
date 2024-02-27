@extends('app')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">

<div>
</div>
<div>
    <div class="row justify-content-center">
        <div>
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Lista de Mesas de Exámenes</h5>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

                    <form action="{{ route('mesaexamens.filter2') }}" method="POST">
                        @csrf
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

                    
<form action="{{ route('mesaexamens.destroyMultiple') }}" method="POST" id="deleteMultipleForm">
    @csrf
    @method('DELETE')

    <th><strong>Seleccionar Todo</strong><input type="checkbox" class="selectAllCheckbox" id="selectAll"></th> <!-- Contenedor con desplazamiento horizontal -->
<br><br>
    <div class="mb-3">
        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteMultipleModal">Eliminar Seleccionados</button>
    </div>

    <!-- Modal de Confirmación para Eliminar Seleccionados -->
    <div class="modal fade" id="confirmDeleteMultipleModal" tabindex="-1" aria-labelledby="confirmDeleteMultipleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteMultipleModalLabel">Confirmar Eliminación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Está seguro de que desea eliminar los elementos seleccionados?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </div>
            </div>
        </div>
    </div>


        

<div class="table-container">
    <table id="asd" class="table table-sm table-bordered">
        <thead>
            <tr>
                <th></th>
                <th>Carrera</th>
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
            </tr>
        </thead>
        <tbody>
            @foreach ($mesasexamenes as $mesaexamen)
                <tr>
                    <td><input type="checkbox" name="mesaexamen_ids[]" value="{{ $mesaexamen->id }}"></td>
                    <!-- Resto de las columnas -->
                    <td>{{ $mesaexamen->carrera->description }}</td>
                    <td>{{ $mesaexamen->anio->description }}</td>
                    <td>{{ $mesaexamen->unidadCurricular->name }}</td>
                    <td>{{ $mesaexamen->turno->description }}</td>
                    <td>{{ $mesaexamen->hora }}</td>
                    <td>{{ \Carbon\Carbon::parse($mesaexamen->llamado)->format('d/m/Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($mesaexamen->llamado2)->format('d/m/Y') }}</td>
                    <td>{{ $mesaexamen->presidente->nom_doc }}</td>
                    <td>{{ $mesaexamen->vocal->nom_doc }}</td>
                    <td>{{ $mesaexamen->vocal2->nom_doc }}</td>
                    <td class="text-end">
    <a href="{{ route('mesaexamens.edit', ['mesaexamen' => $mesaexamen->id]) }}" class="btn btn-primary btn-sm btn-block">
        Editar
    </a>
    {{-- <button type="button" class="btn btn-danger btn-sm btn-block" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal{{ $mesaexamen->id }}">
        Eliminar
    </button> --}}
    <!-- Resto de las acciones -->
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
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="text-center">
    @if (Auth::user()->user_type === 'admin')
        <a href="{{ route('mesaexamens.index') }}" class="btn btn-primary">Agregar Mesa de Examen</a>
    @endif
    <a href="{{ route('exportar-excel-mesaexamens', ['filtro_anio' => request('filtro_anio'), 'filtro_carrera' => request('filtro_carrera')]) }}" class="btn btn-success">Exportar a Excel</a>
</div>

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script>
$('#asd').DataTable({
responsive: true,
autoWidth: false,
scrollX: true,

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
<script>
$('#selectAll').on('change', function () {
    $('input[name="mesaexamen_ids[]"]').prop('checked', this.checked);
});

// Handle individual checkboxes
$('input[name="mesaexamen_ids[]"]').on('change', function () {
    $('#selectAll').prop('checked', $('input[name="mesaexamen_ids[]"]:checked').length === $('input[name="mesaexamen_ids[]"]').length);
});
        // Evento clic para el botón adicional de eliminar mesas seleccionadas
        $('#eliminarSeleccionadas').on('click', function () {
            // Implementa la lógica para eliminar las mesas seleccionadas aquí
            // Puedes usar JavaScript o hacer una solicitud AJAX al servidor
            // por ejemplo, puedes obtener los IDs de las mesas seleccionadas con $('input[name="mesaexamen_ids[]"]:checked')
        });

</script>

@endsection
