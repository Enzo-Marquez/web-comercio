@extends('app')

@section('content')
    <section class="section">
        <div class="section-header" style="max-width: 500px;">
            <h3 class="page__heading">Editar Perfil</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div>
                    <div class="card">
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>¡Error al procesar la información!</strong>
                                    <p>Por favor, revise los siguientes campos:</p>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <form action="{{ route('usuarios.update', $usuarioEditar->id) }}" method="POST" id="editForm">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="text" name="email" class="form-control" value="{{ $usuarioEditar->email }}" readonly style="background-color: #f2f2f2; color: #555; cursor: not-allowed;">
                                            <label for="name">Nombre</label>
                                            <input type="text" name="name" class="form-control" value="{{ $usuarioEditar->name }}">
                                            <label for="apellido">Apellido</label>
                                            <input type="text" name="apellido" class="form-control" value="{{ $usuarioEditar->apellido }}">
                                            <label for="dni">DNI</label>
                                            <input type="number" name="dni" class="form-control" value="{{ $usuarioEditar->dni }}">
                                            @if(\Illuminate\Support\Facades\Auth::user()->can('edit-roles'))
    <label for="rol">Rol</label>
    <select name="rol" class="form-control">
        @foreach($roles as $rol)
            <option value="{{ $rol }}" {{ $usuarioEditar->user_type == $rol ? 'selected' : '' }}>{{ ucfirst($rol) }}</option>
        @endforeach
    </select>
@endif

                                            </select>
                                        </div>
                                        <br>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-primary" id="confirmEdit">Guardar Cambios</button>
                                <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Atrás</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal" tabindex="-1" role="dialog" id="confirmModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmar Guardar Cambios</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que deseas guardar los cambios?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="saveChangesBtn">Guardar Cambios</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#confirmEdit').on('click', function () {
                $('#confirmModal').modal('show');
            });

            $('#confirmModal').on('hide.bs.modal', function () {
                // Limpiar el formulario o realizar acciones adicionales si es necesario
            });

            $('#saveChangesBtn').on('click', function () {
                // Agregar aquí la lógica para guardar los cambios
                $('#editForm').submit();  // Esto enviará el formulario después de la confirmación
                $('#confirmModal').modal('hide');
            });
        });
    </script>
@endsection
