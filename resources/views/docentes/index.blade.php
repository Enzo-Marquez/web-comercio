@extends('app')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">


<div>
    <div class="row justify-content-center">
        <div>
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
                            <div class="alert alert-danger">
                            <strong>Error:</strong> El campo "Docente" es obligatorio.
                            </div>
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

            {{-- <div class="mt-4">
                <form action="{{ route('docentes') }}" method="GET" class="mb-3">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Buscar docentes...">
                        <button type="submit" class="btn btn-primary">Buscar</button>
                    </div>
                </form> --}}

            <div class="mt-4">
                <table id="asd" class="table table-bordered">
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
                
            </div>
        </div>
    </div>
</div>

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
