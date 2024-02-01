@extends('app')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Formulario de Inscripción</h5>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <div class="row">
                            <!-- Información del Usuario -->
                            <div class="col-md-6 mb-3">
                                <h6>Información del Usuario:</h6>
                                <table class="table table-bordered">
                                    <tr>
                                        <input type="text" style="display: none;" name="user_id"
                                            value="{{\Illuminate\Support\Facades\Auth::user()->id}}">

                                        <th>DNI</th>
                                        <td>
                                            @if(Auth::user()->dni)
                                                {{ Auth::user()->dni }}
                                            @else
                                                <p class="text-danger">¡Error! No se ha encontrado un DNI cargado para este usuario.</p>
                                            @endif
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>Nombre</th>
                                        <td>{{ Auth::user()->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Apellido</th>
                                        <td>
                                            @if(Auth::user()->apellido)
                                                {{ Auth::user()->apellido }}
                                            @else
                                                <p class="text-danger">¡Error! No se ha encontrado un apellido cargado para este usuario.</p>
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            @if ($mesaexamens)
                                <div class="col-md-6 mb-3">
                                    <h6>Información de la Mesa de Examen:</h6>
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>Carrera</th>
                                            <td>{{ $mesaexamens->carrera->description }}</td>
                                        </tr>
                                        <tr>
                                            <th>Año</th>
                                            <td>{{ $mesaexamens->anio->description }}</td>
                                        </tr>
                                        <tr>
                                            <th>Unidad Curricular</th>
                                            <td>{{ $mesaexamens->unidadCurricular->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Primer Llamado</th>
                                            <td>{{ $mesaexamens->llamado }}</td>
                                        </tr>
                                        <tr>
                                            <th>Segundo Llamado</th>
                                            <td>{{ $mesaexamens->llamado2 }}</td>
                                        </tr>
                                        <tr>
                                            <th>Hora</th>
                                            <td>{{ $mesaexamens->hora }}</td>
                                        </tr>
                                        <tr>
                                            <th>Presidente</th>
                                            <td>{{ $mesaexamens->presidente->nom_doc }}</td>
                                        </tr>
                                        <tr>
                                            <th>Vocal 1</th>
                                            <td>{{ $mesaexamens->vocal->nom_doc }}</td>
                                        </tr>
                                        <tr>
                                            <th>Vocal 2</th>
                                            <td>{{ $mesaexamens->vocal2->nom_doc }}</td>
                                        </tr>
                                    </table>
                                </div>
                            @endif
                        </div>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Formulario de Inscripción -->
                        <form action="{{ route('uinscription.store') }}" method="POST">
                            @csrf
                            <!-- Otros campos similares a los de tu formulario de mesaexamens -->
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            <input type="hidden" name="mesaexamen_id" value="{{ $mesa_id }}">
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Enviar Formulario de Inscripción</button>
                            </div>
                        </form>

                        <!-- Botón y Modal para eliminar -->
                        @if ($uinscription)
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmDeleteModal" data-form-action="{{ route('uinscription.destroy', ['id' => $uinscription->id, 'mesaexamen_id' => $mesa_id]) }}">
                                Eliminar
                            </button>
                        @endif

                        <!-- Modal de Confirmación de Eliminación -->
                        <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmar Eliminación</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        ¿Está seguro de que desea eliminar esta inscripción?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        <form id="deleteForm" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Eliminar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function () {
            // Manejo de clic en el botón de eliminar
            $('#confirmDeleteModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var formAction = button.data('form-action');
                $('#deleteForm').attr('action', formAction);
            });
        });
    </script>
@endsection
