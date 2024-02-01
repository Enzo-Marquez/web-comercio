@extends('app')

@section('content')
    <form action="{{ route('unidades_curriculares') }}" method="post">
        @csrf
        <div class="mb-3">
            <label for="carrera_id" class="form-label">Selecciona una carrera</label>
            <select name="carrera_id" class="form-select">
                @if ($carreras->isNotEmpty())
                    @foreach ($carreras as $carrera)
                        <option value="{{ $carrera->id }}">{{ $carrera->description }}</option>
                    @endforeach
                @else
                    <option value="" disabled>No estás inscripto en ninguna carrera</option>
                @endif
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Ver Mesas de Exámenes</button>
    </form>
@endsection
