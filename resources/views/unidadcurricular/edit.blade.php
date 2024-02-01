@extends('app')

@section('content')

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Actualizar Unidad Curricular</h5>
                </div>
                <div class="card-body">
                    <form id="updateForm" action="{{ route('unidadcurricular.update', ['unidadcurricular' => $unidadcurricular->id]) }}" method="POST">
                        @method('PATCH')
                        @csrf

                        @if (session('success'))
                            <h6 class="alert alert-success">{{ session('success')}}</h6>
                        @endif

                        @error('name')
                            <h6 class="alert alert-danger">{{ $message }}</h6>
                        @enderror

                        <div class="mb-3">
                            <label for="anios_id" class="form-label">Año</label>
                            <select name="anios_id" class="form-select">
                                @foreach ($anios as $anio)
                                    <option value="{{ $anio->id }}" {{ $unidadcurricular->anios_id == $anio->id ? 'selected' : '' }}>
                                        {{ $anio->description }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="carreras_id" class="form-label">Carrera</label>
                            <select name="carreras_id" class="form-select">
                                @foreach ($carreras as $carrera)
                                    <option value="{{ $carrera->id }}" {{ $unidadcurricular->carreras_id == $carrera->id ? 'selected' : '' }}>
                                        {{ $carrera->description }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">Unidad Curricular</label>
                            <input type="text" name="name" class="form-control" value="{{ $unidadcurricular->name }}">
                            <div class="form-text">Modificar La Unidad Curricular, Modificarara Esta En la Opcion para Crear la Mesa de Examen</div>
                        </div>

                        <!-- Botones con modales -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#confirmUpdateModal">Actualizar Unidad Curricular</button>

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
                ¿Está seguro de que desea actualizar la Unidad Curricular?
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
