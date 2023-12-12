@extends('app')

@section('content')

<div class="container w-25 border p-4 mt-4">
    <form action="{{ route('carreras-update', ['id' => $carrera->id]) }}" method="POST">
      @method('PATCH')
      @csrf

      @if (session('success'))
        <h6 class="alert alert-success">{{ session('success')}}</h6>
      @endif

      @error('description')
      <h6 class="alert alert-danger">{{ $message }}</h6>
      @enderror

    <div class="mb-3">
    <label for="description" class="form-label">Carreras</label>
    <input type="text" name="description" class="form-control" value="{{ $carrera->description }}">
    <div class="form-text">Ingrese las carreras disponibles de las mesas de examen, 
    estos una vez creados se podrán seleccionar en un desplegable en la creación
    de la mesa de examen</div>
  </div>
  <button type="submit" class="btn btn-primary">Actualizar Carrera</button>
    </form>


</div>
@endsection