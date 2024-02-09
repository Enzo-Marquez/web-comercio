@extends('app')

@section('content')
    <form action="{{ route('filtrarCarreras') }}" method="post">
        @csrf
        <div class="mb-3">
            <label for="carrera_id" class="form-label">Filtrar por carrera</label>
            <select name="carrera_id" class="form-select">
                <option value="" selected>Todas las carreras</option>
                @if ($carreras->isNotEmpty())
                    @foreach ($carreras as $carrera)
                        <option value="{{ $carrera->id }}">{{ $carrera->description }}</option>
                    @endforeach
                @else
                    <option value="" disabled>No hay carreras disponibles</option>
                @endif
            </select>
        </div>
        <div class="mb-3">
            <label for="anio_id" class="form-label">Filtrar por año</label>
            <select name="anio_id" class="form-select">
                <option value="" selected>Todos los años</option>
                @if ($anios->isNotEmpty())
                    @foreach ($anios as $anio)
                        <option value="{{ $anio->id }}">{{ $anio->description }}</option>
                    @endforeach
                @else
                    <option value="" disabled>No hay años disponibles</option>
                @endif
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Ver Inscripciones</button>
    </form>
@endsection
