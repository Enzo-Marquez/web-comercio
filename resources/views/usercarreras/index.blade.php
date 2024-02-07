@extends('app')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Carreras Asignadas</h5>
                    </div>

                    <!-- Formulario para agregar carrera directamente desde el índice -->
                    <form action="{{ route('usercarreras.store') }}" method="POST" class="p-3">
                        @csrf

                        <div class="mb-3">
                            <label for="carrera_id" class="form-label">Carreras</label>
                            <select name="carrera_id" class="form-select">
                                <option selected disabled>Seleccione una carrera</option>
                                @foreach ($carreras as $carrera)
                                    <option value="{{ $carrera->id }}">{{ $carrera->description }}</option>
                                @endforeach
                            </select>
                        </div>

                        <input type="text" style="display: none;" name="user_id" value="{{ \Illuminate\Support\Facades\Auth::user()->id }}">
                        <button type="submit" class="btn btn-primary">Agregar Carrera</button>
                    </form>

                    <!-- Separador -->
                    <div class="mt-3"></div>

                    <!-- Sección para mostrar las asignaciones existentes -->
                            @if (session('success'))
                                <div class="alert alert-success">
                                {{ session('success') }}
                                </div>
                            @endif

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                <strong>Error:</strong> ¡Debes Seleccionar Una Carrera!
                                </div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger">
                                {{ session('error') }}
                                </div>
                            @endif


                        <table class="table table-bordered mt-3">
                            <thead>
                                <tr>
                                    <th>Usuario</th>
                                    <th>DNI</th>
                                    <th>Apellido</th>
                                    <th>Carrera</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($usercarreras as $usercarrera)
                                    <tr>
                                        <td>{{ $usercarrera->user->name ?? 'N/A' }}</td>
                                        <td>{{ $usercarrera->user->dni ?? 'No Completado' }}</td>
                                        <td>{{ $usercarrera->user->apellido ?? 'No Completado' }}</td>
                                        <td>{{ $usercarrera->carrera ? $usercarrera->carrera->description : 'N/A' }}</td>
                                        <td>
                                            <!-- Botón para abrir la modal de confirmación -->
                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{ $usercarrera->id }}">
                                                Eliminar Carrera
                                            </button>

                                            <!-- Modal de confirmación -->
                                            <div class="modal fade" id="deleteModal{{ $usercarrera->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="deleteModalLabel">Confirmar Eliminación</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            ¿Estás seguro de que quieres eliminar esta carrera?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                            <!-- Formulario para la eliminación -->
                                                            <form action="{{ route('usercarreras.destroy', $usercarrera) }}" method="POST">
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
                </div>
            </div>
        </div>
    </div>
@endsection
