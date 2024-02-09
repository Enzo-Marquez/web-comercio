@extends('app')

@section('content')
    <div class="container-fluid"> <!-- Utilizamos container-fluid en lugar de container para ocupar toda la pantalla -->
        <div class="row justify-content-center">
            <div> <!-- Cambiamos el tamaño de la columna a col-md-12 -->
                {{-- Utiliza la etiqueta <iframe> para mostrar la página web externa --}}
                <iframe src="https://www.comercio.edu.ar/fechas-importantes-para-estudiantes/" style="width: 100%; height: 100vh; border: none;"></iframe>
            </div>
        </div>
    </div>
@endsection
