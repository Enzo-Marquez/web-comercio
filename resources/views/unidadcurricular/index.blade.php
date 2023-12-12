@extends('app')

@section('content')

<div class="container w-25 border p-4 mt-4">
    <form action="{{ route('unidadcurricular.store') }}" method="POST">
        @csrf

        @if (session('success'))
            <h6 class="alert alert-success">{{ session('success')}}</h6>
        @endif

        @error('name')
            <h6 class="alert alert-danger">{{ $message }}</h6>
        @enderror

        <div class="mb-3">
            <label for="name" class="form-label">Unidad Curricular</label>
            <div class="form-text">Ingrese las Años disponibles para las mesas de examenes, estas una vez creadas se podrán seleccionar en un desplegable en la creación de la mesa de examen</div>
            <input type="text" name="name" class="form-control">
        </div>

        <div class="mb-3">
            <label for="anios_id" class="form-label">Año</label>
            <select name="anios_id" class="form-select">
                @foreach ( $anios as $anio )
                    <option value="{{ $anio->id }}">{{ $anio->description }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="carreras_id" class="form-label">Carrera</label>
            <select name="carreras_id" class="form-select">
                @foreach($carreras as $carrera)
                    <option value="{{ $carrera->id }}">{{ $carrera->description }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Crear Unidad Curricular</button>
    </form>

    <div>
        @foreach ($unidadcurricular as $unidadcurricular)
            <div class="row py-1">
                <div class="col-md-9 d-flex align-items-center">
                <a href="{{ route('unidadcurricular.show', ['unidadcurricular' => $unidadcurricular->id, 'anios' => $anios, 'carreras' => $carreras]) }}">


                    
                    {{ $unidadcurricular->name }} - 
                    {{ $unidadcurricular->anio->description }} - 
                    {{ $unidadcurricular->carrera->description }}
                    
                    </a>
                </div>
                <div class="col-md-3 d-flex justify-content-end">
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal-{{$unidadcurricular->id}}">
                        Eliminar
                    </button>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="modal-{{ $unidadcurricular->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar Unidad Curricular</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Al eliminar el año <strong>{{ $unidadcurricular->name }}</strong> se eliminara la opcion de seleccionar dicho año en la creacion de la mesa de examen ¿Está seguro que desea eliminar el Año?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Volver</button>
                            <form action="{{ route('unidadcurricular.destroy', ['unidadcurricular' => $unidadcurricular->id]) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal{{ $unidadcurricular->id }}">Eliminar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        @endforeach     
    </div>
</div>
@endsection
