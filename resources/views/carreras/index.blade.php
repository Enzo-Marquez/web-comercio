@extends('app')

@section('content')

<div class="container w-25 border p-4 mt-4">
    <form action="{{ route('carreras') }}" method="POST">
      @csrf

      @if (session('success'))
        <h6 class="alert alert-success">{{ session('success')}}</h6>
      @endif

      @error('description')
      <h6 class="alert alert-danger">{{ $message }}</h6>
      @enderror

    <div class="mb-3">
    <label for="description" class="form-label">Carreras</label>
    <div class="form-text">Ingrese las carreras disponibles para las mesas de examenes, 
    estas una vez creadas se podrán seleccionar en un desplegable en la creación
    de la mesa de examen</div>
    <input type="text" name="description" class="form-control">
  </div>
  <button type="submit" class="btn btn-primary">Crear Carrera</button>
    </form>

    <div>
      @foreach ($carreras as $carrera)
         <div class="row py-1">
              <div class="col-md-9 d-flex align-items-center">
                <a href="{{ route('carreras-edit', ['id' => $carrera->id]) }}">{{ $carrera->description}}</a>
              </div>

              <div class="col-md-3 d-flex justify-content-end">

                  <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modal{{$carrera->id}}">
                  Eliminar  
                  </button>
              </div>
          </div>

      <!-- Modal -->
      <div class="modal fade" id="modal{{ $carrera->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar Carrera</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Al eliminar la Carrera <strong>{{ $carrera->description }}</strong> se eliminara la opcion de seleccionar dicha carrera en la creacion de la mesa de examen
        ¿Está seguro que desea eliminar la Carrera?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Volver</button>
    <form action="{{ route('carreras-destroy', ['id' => $carrera->id]) }}" method="POST">
    @method('DELETE')
    @csrf
    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal{{ $carrera->id }}">Eliminar</button>
    </form>
      </div>
    </div>
  </div>
</div>

      @endforeach   
    </div>
</div>
@endsection