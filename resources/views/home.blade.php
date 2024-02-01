@extends('adminlte::page')

@section('title', 'Dashboard Administración')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <p>Bienvenido al panel de administración de AdminLTE.</p>

    @if(empty(auth()->user()->dni) || empty(auth()->user()->apellido))
        <div class="alert alert-warning" id="incomplete-profile-alert">
            <strong>¡Atención!</strong> Completa tu perfil ingresando tu DNI y apellido en el apartado Perfil.
        </div>
    @endif
@stop

@push('js')
    <script>
        // Verifica si el perfil está completo
        var isProfileComplete = {{ (empty(auth()->user()->dni) || empty(auth()->user()->apellido)) ? 'false' : 'true' }};

        // Muestra la alerta solo si el perfil no está completo
        if (!isProfileComplete) {
            $('#incomplete-profile-alert').show();

            // Cierra el mensaje después de 5 segundos (puedes ajustar este tiempo según tus necesidades)
            setTimeout(function() {
                $('#incomplete-profile-alert').fadeOut('fast');
            }, 500000000);
        }
    </script>
@endpush
