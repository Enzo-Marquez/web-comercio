<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diseño Web</title>
    <link rel="stylesheet" href="{{ asset('assets\style.css') }}">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Share+Tech&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <div class="container">
        <nav>
            <div class="logo-container">
                <img class="emp" src="{{ asset('assets/img/Escuela.png') }}" alt="">
                <span class="logo-text">ESCUELA SUPERIOR DE COMERCIO N43</span>
            </div>
            @if (Route::has('login'))
            <div>
                @auth
                <a href="{{ url('/home') }}" class="btn-primary">
                    {{__('Inicio')}}
                </a>
                @else
                <ul>
                    <li>
                        <a href="{{ route('login') }}" class="btn-primary">
                            Iniciar Sesión
                        </a>
                    </li>
                    @if (Route::has('register'))
                    <li>
                        <a href="{{ route('register') }}" class="btn-primary">
                            Registrarse
                        </a>
                    </li>
                    @endif
                </ul>
                @endauth
            </div>
            @endif
        </nav>
        <header>
            <h1>BIENVENIDOS</h1>
            <h2>Sistema de Gestión de Mesas.</h2>
            <br>
            <a href="https://www.comercio.edu.ar/" target="_blank" rel="noopener noreferrer">
                <button type="button">
                    Mas Informacion
                    <img src="{{ asset('assets/img/bxs-right-arrow-alt.svg') }}" alt="">
                </button>
            </a>
            <br>
            <br>
            <br>
            <address>
                <strong> Dirección: </strong> Boulevard Lovato y San Martín, Reconquista, Santa Fe, Argentina
                <br>
                <br>
                <strong> Teléfono: </strong> 03482-421252
                <br>
                <br>
                <strong> Correo Electrónico: </strong> <a href="mailto:secretariasuperior@comercio.edu.ar">secretariasuperior@comercio.edu.ar</a>
            </address>
        </header>
        <br><br>
        <div class="icons">
    <a href="https://www.instagram.com/escuela_comercio_superior/" target="_blank">
        <i class='bx bxl-instagram'></i>
    </a>

    <a href="https://www.facebook.com/escsupdecomercio.nivelsuperior/" target="_blank">
        <i class='bx bxl-facebook'></i>
    </a>
    
    <a href="https://www.youtube.com/@SuperiorComercio" target="_blank">
        <i class='bx bxl-youtube'></i>
    </a>
    <!-- <i class='bx bxl-whatsapp' ></i> -->
</div>


</body>
</html>
