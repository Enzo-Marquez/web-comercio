@extends('app')

@section('content')

<div>
    <div class="row justify-content-center">
        <div>
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Formulario de Unidad Curricular</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('unidadcurricular.store') }}" method="POST">
                        @csrf

                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success')}}</div>
                        @endif

                        @error('name')
                            <div class="alert alert-danger">
                            <strong>Error:</strong> El campo "Unidad Curricular" es obligatorio.
                            </div>
                        @enderror

                        @error('anios_id')
                        <div class="alert alert-danger">
                        <strong>Error:</strong> El campo "Año" es obligatorio.
                        </div>
                        @enderror

                        @error('carreras_id')
                            <div class="alert alert-danger">
                            <strong>Error:</strong> El campo "Carreras" es obligatorio.
                            </div>
                        @enderror

                        <div class="mb-3">
                            <label for="name" class="form-label">Unidad Curricular</label>
                            <input placeholder="Ingrese la Unidad Curricular" type="text" name="name" class="form-control">
                            <div class="form-text">
                                Estas una vez creadas,
                                se podrán seleccionar en un desplegable en la creación de la mesa de exámenes.
                            </div>
                            
                        </div>

                        <div class="mb-3">
                            <label for="anios_id" class="form-label">Año</label>
                            <select name="anios_id" class="form-select">
                                <option selected disabled>Seleccione un año</option>
                                @foreach ($anios as $anio)
                                    <option value="{{ $anio->id }}">{{ $anio->description }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="carreras_id" class="form-label">Carrera</label>
                            <select name="carreras_id" class="form-select">
                                <option selected disabled>Seleccione una carrera</option>
                                @foreach ($carreras as $carrera)
                                    <option value="{{ $carrera->id }}">{{ $carrera->description }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Crear Unidad Curricular</button>
                        <a href="{{ url('unidadcurricular\listas') }}" class="btn btn-secondary">Ir a la Lista de Unidades Curriculares</a>
                    </form>
                </div>
            </div>

@endsection
