@extends('app')

@section('content')

<div class="container w-25 border p-4 mt-4">
    <form action="{{ route('turnos') }}" method="POST">
      @csrf

      @if (session('success'))
        <h6 class="alert alert-success">{{ session('success')}}</h6>
      @endif

      @error('description')
      <h6 class="alert alert-danger">{{ $message }}</h6>
      @enderror

    <div class="mb-3">
    <label for="description" class="form-label">Turnos</label>
    <div class="form-text">Ingrese los turnos disponibles de las mesas de examen, 
    estos una vez creados se podrán seleccionar en un desplegable en la creación
    de la mesa de examen</div>
    <input type="text" name="description" class="form-control">
  </div>
  <button type="submit" class="btn btn-primary">Crear Turno</button>
    </form>

    <div>
      @foreach ($turnos as $turno)
         <div class="row py-1">
              <div class="col-md-9 d-flex align-items-center">
                <a href="{{ route('turnos-edit', ['id' => $turno->id]) }}">{{ $turno->description}}</a>
              </div>
              <div class="col-md-3 d-flex justify-content-end">
              <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal{{$turno->id}}">
              Eliminar
             </button>
          </div>
      </div>



      <!-- Modal -->
      <div class="modal fade" id="modal{{ $turno->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar Turno</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Al eliminar el Turno <strong>{{ $turno->description }}</strong> se eliminara la opcion de seleccionar dicho turno en la creacion de la mesa de examen
        ¿Está seguro que desea eliminar el Turno?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Volver</button>
    <form action="{{ route('turnos-destroy', ['id' => $turno->id]) }}" method="POST">
    @method('DELETE')
    @csrf
    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal{{ $turno->id }}">Eliminar</button>
    </form>
      </div>
    </div>
  </div>
</div>
      @endforeach   
    </div>
</div>
@endsection