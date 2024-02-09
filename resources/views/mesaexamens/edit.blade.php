@extends('app')

@section('content')

<div>
    <div class="row justify-content-center">
        <div>
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Actualizar Mesa de Examenes</h5>
                </div>
                <div class="card-body">
                    <form id="updateForm" action="{{ route('mesaexamens.update', ['mesaexamens' => $mesaexamen->id]) }}" method="POST">

                        @method('PATCH')
                        @csrf

                        @if (session('success'))
                            <h6 class="alert alert-success">{{ session('success') }}</h6>
                        @endif

                        @error('name')
                            <h6 class="alert alert-danger">{{ $message }}</h6>
                        @enderror

                        <div class="row mb-3">
                            <div class="col-sm-6">
                                <label for="anios_id" class="form-label">Año</label>
                                <select id="anios" name="anios_id" class="form-select">
                                    @foreach ($anios as $anio)
                                        <option value="{{ $anio->id }}" {{ $mesaexamen->anios_id == $anio->id ? 'selected' : '' }}>
                                            {{ $anio->description }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-sm-6">
                                <label for="carreras_id" class="form-label">Carrera</label>
                                <select id="carrera" name="carreras_id" class="form-select">
                                    @foreach ($carreras as $carrera)
                                        <option value="{{ $carrera->id }}" {{ $mesaexamen->carreras_id == $carrera->id ? 'selected' : '' }}>
                                            {{ $carrera->description }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-6">
                                <label for="unidad_curriculars_id" class="form-label">Unidad Curricular</label>
                                <select id="unidadcurricular" name="unidad_curriculars_id" class="form-select unidad-curricular-select">
                                    @foreach ($unidadCurriculars as $uc)
                                        <option value="{{ $uc->id }}" {{ $mesaexamen->unidad_curriculars_id == $uc->id ? 'selected' : '' }}
                                        data-carrera-id="{{ $uc->carrera->id }}"
                                        data-anio-id="{{ $uc->anio->id }}">
                                            {{ $uc->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div> 






                            <div class="col-sm-6">
                                <label for="turnos_id" class="form-label">Turno</label>
                                <select name="turnos_id" class="form-select">
                                    @foreach ($turnos as $turno)
                                        <option value="{{ $turno->id }}" {{ $mesaexamen->turnos_id == $turno->id ? 'selected' : '' }}>
                                            {{ $turno->description }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-6">
                                <label for="hora" class="form-label">Hora</label>
                                <input type="time" name="hora" class="form-control" value="{{ $mesaexamen->hora }}">
                            </div>

                            <div class="col-sm-6">
                                <label for="llamado" class="form-label">Llamado 1</label>
                                <input type="date" name="llamado" class="form-control" value="{{ $mesaexamen->llamado }}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-6">
                                <label for="llamado2" class="form-label">Llamado 2</label>
                                <input type="date" name="llamado2" class="form-control" value="{{ $mesaexamen->llamado2 }}">
                            </div>

                            <div class="col-sm-6">
                                <label for="presidente_id" class="form-label">Presidente</label>
                                <select name="presidente_id" class="presidente-select">
                                    @foreach ($docentes as $docente)
                                        <option value="{{ $docente->id }}" {{ $mesaexamen->presidente_id == $docente->id ? 'selected' : '' }}>
                                            {{ $docente->nom_doc }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-6">
                                <label for="vocal_id" class="form-label">Vocal</label>
                                <select name="vocal_id" class="vocal-select">
                                    @foreach ($docentes as $docente)
                                        <option value="{{ $docente->id }}" {{ $mesaexamen->vocal_id == $docente->id ? 'selected' : '' }}>
                                            {{ $docente->nom_doc }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-sm-6">
                                <label for="vocal2_id" class="form-label">Vocal 2</label>
                                <select name="vocal2_id" class="vocal2-select">
                                    @foreach ($docentes as $docente)
                                        <option value="{{ $docente->id }}" {{ $mesaexamen->vocal2_id == $docente->id ? 'selected' : '' }}>
                                            {{ $docente->nom_doc }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Botones con modales -->
                        <div class="row mb-3">
                            <div class="text-end">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#confirmUpdateModal">Actualizar Mesa de Examenes</button>
                                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#confirmBackModal">Volver</button>
                            </div>
                        </div>

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
                ¿Está seguro de que desea actualizar la Mesa de Examenes?
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

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
    
$(document).ready(function() {
            $('#carrera, #anios').change(function() {
                var selectedCarrera = $('#carrera').find(':selected').val();
                var selectedAnio = $('#anios').find(':selected').val();

                $('#unidadcurricular option').hide();
                $('#unidadcurricular option').filter(function() {
                    var carreraId = $(this).data('carrera-id');
                    var anioId = $(this).data('anio-id');

                    return (carreraId == selectedCarrera && anioId == selectedAnio);
                }).show();

                $('#unidadcurricular').val(null);
            });
        });



    </script>






    <!-- Agrega aquí el script de Select2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            // Inicializar Select2 para los campos deseados
            $('.presidente-select, .vocal-select, .vocal2-select').select2();
        });
    </script>

@endsection
