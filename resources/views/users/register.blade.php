@extends('app')

@section('content')
 
<div class="container w-25 border p-4 mt-4">
    <form action="{{ route('users') }}" method="POST">
      @csrf

      @if (session('success'))
        <h6 class="alert alert-success">{{ session('success')}}</h6>
      @endif

      @error('usu_dni')
      <h6 class="alert alert-danger">Este correo ya se encuentra en la base de datos, por favor seleccione otro</h6>
      @enderror
       <div class="mb-3">
             <label for="exampleInputEmail1" class="form-label">DNI usuario</label>
             <input type="text" name="usu_ID" class="form-control" >
       </div>
       <br>
       @error('usu_contra')
      <h6 class="alert alert-danger">{{ $message }}</h6>
      @enderror
       <div class="mb-3">
             <label for="exampleInputEmail1" class="form-label">Contraseña Usuario</label>
             <input type="text" name="usu_contra" class="form-control" >
       </div>
       <br>
       @error('usu_nom')
      <h6 class="alert alert-danger">{{ $message }}</h6>
      @enderror
       <div class="mb-3">
             <label for="exampleInputEmail1" class="form-label">Nombre Usuario</label>
             <input type="text" name="usu_nom" class="form-control" >
       </div>
       <br>
       @error('usu_ape')
      <h6 class="alert alert-danger">{{ $message }}</h6>
      @enderror
       <div class="mb-3">
             <label for="exampleInputEmail1" class="form-label">Apellido Usuario</label>
             <input type="text" name="usu_ape" class="form-control" >
       </div>
       <br>
       @error('usu_correo')
       <h6 class="alert alert-danger">Este correo ya se encuentra en la base de datos, por favor seleccione otro</h6>
      @enderror
       <div class="mb-3">
             <label for="exampleInputEmail1" class="form-label">Correo Usuario</label>
             <input type="text" name="usu_correo" class="form-control" >
       </div>
  <button type="submit" class="btn btn-primary">Crear Nuevo Usuario</button>
    </form>
    <br>
    <br>

    <div style="max-height: 250px; overflow-y: auto;">
    @foreach ($users as $user)
        <div class="border p-3 mb-3">
            <div class="row py-1 border-bottom"> {{-- Línea separadora --}}
                <div class="col-md-9">
                    <div>DNI: <a href="{{ route('users-edit', ['usu_ID' => $user->usu_ID]) }}">{{ $user->usu_ID }}</a></div>
                    <div>Nombre: <span class="mx-2">{{ $user->usu_nom }}</span></div>
                    <div>Apellido: <span class="mx-2">{{ $user->usu_ape }}</span></div>
                </div>
                <div class="col-md-3 text-right">
                    <form action="{{ route('users-destroy', [$user->usu_ID]) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-danger btn-sm">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
</div>
</div>
@endsection