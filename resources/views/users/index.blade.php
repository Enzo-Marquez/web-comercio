
<div class="container w-25 border p-4 mt-4">
<link rel="stylesheet" href="{{ asset('assets/register.css') }}">

<section class="form-register">
    <h4>Formulario de Registro</h4>
    <form action="{{ route('users.store') }}" method="POST">
        @csrf

        @if (session('success'))
            <h6 class="alert alert-success">{{ session('success')}}</h6>
        @endif

        @error('usu_dni')
            <h6 class="alert alert-danger">{{ $message }}</h6>
        @enderror

        <div class="mb-3">
            <input type="text" class="controls" placeholder="Ingrese su DNI" name="usu_dni" class="form-control" id="usu_dni">
        </div>
        <br>

        @error('usu_nom')
            <h6 class="alert alert-danger">{{ $message }}</h6>
        @enderror

        <div class="mb-3">
            <input type="text" class="controls" placeholder="Ingrese su Nombre" name="usu_nom" class="form-control" id="usu_nom">
        </div>
        <br>

        @error('usu_ape')
            <h6 class="alert alert-danger">{{ $message }}</h6>
        @enderror

        <div class="mb-3">
            <input type="text" class="controls" placeholder="Ingrese su Apellido" name="usu_ape" class="form-control" id="usu_ape">
        </div>
        <br>

        @error('usu_contra')
            <h6 class="alert alert-danger">{{ $message }}</h6>
        @enderror

        <div class="mb-3">
            <input type="password" class="controls" placeholder="Ingrese su Contraseña" name="usu_contra" class="form-control" id="usu_contra">
        </div>
        <br>

        @error('email')
            <h6 class="alert alert-danger">{{ $message }}</h6>
        @enderror

        <div class="mb-3">
            <input type="text" class="controls" placeholder="Ingrese su Correo" name="email" class="form-control" id="email">
        </div>

        {{-- <p>Estoy de acuerdo con <a href="#">Términos y Condiciones</a></p> --}}

        <button type="submit" class="botons">Registrar</button>
        <p><a href="/login">¿Ya tengo cuenta?</a></p>
        </section>
    </form>

    


    

  

