@extends('app')

@section('content')

<div class="container w-25 border p-4 mt-4">
    <form action="{{ route('unidadcurricular.update', ['unidadcurricular' => $unidadcurricular->id]) }}" method="POST">
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

        <button type="submit" class="btn btn-primary">Actualizar Unidad Curricular</button>
    </form>
</div>
@endsection
