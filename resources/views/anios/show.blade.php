@extends('app')

@section('content')

<div>
    <div class="row justify-content-center">
    <div>
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Editar Año</h5>
                </div>
                <div class="card-body">
                    <form id="updateForm" action="{{ route('anios-update', ['id' => $anio->id]) }}" method="POST">
                        @method('PATCH')
                        @csrf

                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        @error('description')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <div class="mb-3">
                            <label for="description" class="form-label">Años</label>
                            <input type="text" name="description" class="form-control"
                                value="{{ $anio->description }}">
                            <div class="form-text">
                                Ingrese los años disponibles para las mesas de exámenes. Estos, una vez creados, se podrán
                                seleccionar en un desplegable en la creación de la mesa de exámenes.
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#confirmUpdateModal">Actualizar Año</button>

                        <!-- Botón para volver atrás -->
                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#confirmBackModal">Volver</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Confirmar actualización -->
<div class="modal fade" id="confirmUpdateModal" tabindex="-1" aria-labelledby="confirmUpdateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmUpdateModalLabel">Confirmar Actualización</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ¿Está seguro de que desea actualizar el Año?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" form="updateForm" class="btn btn-primary">Actualizar</button>
            </div>
        </div>
    </div>
</div>

<!-- Confirmar volver atrás -->
<div class="modal fade" id="confirmBackModal" tabindex="-1" aria-labelledby="confirmBackModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmBackModalLabel">Confirmar Volver</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ¿Está seguro de que desea volver atrás?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                <a href="{{ url()->previous() }}" class="btn btn-primary">Aceptar</a>
            </div>
        </div>
    </div>
</div>

@endsection
