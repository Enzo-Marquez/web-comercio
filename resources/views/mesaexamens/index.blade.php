@extends('app')

@section('content')
    <div>
        <div class="row justify-content-center">
            <div>
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Formulario de Mesa de Examen</h5>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
        <strong></strong>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Error:</strong> Por favor, revisa los siguientes campos antes de continuar.
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
                        <form action="{{ url('/mesaexamens') }}" method="POST">
                            @csrf

                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label for="carreras_id" class="form-label">Carrera</label>
                                    <select name="carreras_id" class="form-select carrera-select">
                                        <option selected disabled>Seleccione una carrera</option>
                                        @foreach ($carreras as $carrera)
                                            <option value="{{ $carrera->id }}" data-carrera-id="{{ $carrera->id }}">{{ $carrera->description }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label for="anios_id" class="form-label">Año</label>
                                    <select name="anios_id" class="form-select anio-select">
                                        <option selected disabled>Seleccione un año</option>
                                        @foreach ($anios as $anio)
                                            <option value="{{ $anio->id }}" data-anio-id="{{ $anio->id }}">{{ $anio->description }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label for="unidad_curriculars_id" class="form-label">Unidad Curricular</label>
                                    <select name="unidad_curriculars_id" class="form-select unidad-curricular-select">
                                        <option selected disabled>Seleccione una unidad curricular</option>
                                        @foreach ($unidadcurricular as $unidad)
                                            <option value="{{ $unidad->id }}"
                                                    data-carrera-id="{{ $unidad->carrera->id }}"
                                                    data-anio-id="{{ $unidad->anio->id }}">
                                                {{ $unidad->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Agrega más campos según sea necesario -->

                                <div class="col-md-4">
                                    <label for="turnos_id" class="form-label">Turnos</label>
                                    <select name="turnos_id" class="form-select">
                                        <option selected disabled>Seleccione una turno</option>
                                        @foreach ($turnos as $turno)
                                            <option value="{{ $turno->id }}">{{ $turno->description }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label for="hora" class="form-label">Hora</label>
                                    <input type="time" name="hora" class="form-control">
                                </div>

<div class="col-md-4">
    <label for="llamado" class="form-label">Llamado 1</label>
    <input type="date" name="llamado" class="form-control">
</div>

<div class="col-md-4">
    <label for="llamado2" class="form-label">Llamado 2</label>
    <input type="date" name="llamado2" class="form-control">
</div>

<div class="col-md-4">
    <label for="presidente_id" class="form-label">Presidente</label>
    <select name="presidente_id" class="form-select presidente-select">
        <option selected disabled>Seleccione un Presidente</option>
        @foreach ($docentes as $docente)
            <option value="{{ $docente->id }}">{{ $docente->nom_doc }}</option>
        @endforeach
    </select>
</div>

<div class="col-md-4">
    <label for="vocal_id" class="form-label">Vocal</label>
    <select name="vocal_id" class="form-select vocal-select">
        <option selected disabled>Seleccione un Vocal</option>
        @foreach ($docentes as $docente)
            <option value="{{ $docente->id }}">{{ $docente->nom_doc }}</option>
        @endforeach
    </select>
</div>

<div class="col-md-4">
    <label for="vocal2_id" class="form-label">Vocal 2</label>
    <select name="vocal2_id" class="form-select vocal2-select">
        <option selected disabled>Seleccione un Vocal</option>
        @foreach ($docentes as $docente)
            <option value="{{ $docente->id }}">{{ $docente->nom_doc }}</option>
        @endforeach
    </select>
</div>

                            </div>

                            <input type="text" style="display: none;" name="user_id"
                                   value="{{ \Illuminate\Support\Facades\Auth::user()->id }}">

                            <br>
                            <button type="submit" class="btn btn-primary">Crear Mesa de Examen</button>
                            
                        </form>

                        <div class="d-flex justify-content-between align-items-center">
                            <h5></h5>
                            <a href="{{ url('mesaexamens\lista') }}" class="btn btn-secondary">Ver Lista</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
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










    <!-- Agrega aquí el script de Select2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            // Inicializar Select2 para los campos deseados
            $('.presidente-select, .vocal-select, .vocal2-select').select2();
        });
    </script>


<script>
    $(document).ready(function() {
        // Inicializar Select2 para los campos deseados
        $('.presidente-select, .vocal-select, .vocal2-select').select2();

        // Validar que no se repitan los nombres de docentes
        $('form').submit(function() {
            var selectedDocentes = [];
            $('.docente-select').each(function() {
                var selectedDocenteId = $(this).find(':selected').data('docente-id');
                if (selectedDocentes.indexOf(selectedDocenteId) !== -1) {
                    alert('Error: No se pueden repetir los nombres de los docentes.');
                    return false; // Evita que se envíe el formulario
                }
                selectedDocentes.push(selectedDocenteId);
            });
            return true; // Permite el envío del formulario si no hay nombres de docentes repetidos
        });
    });
</script>
@endsection