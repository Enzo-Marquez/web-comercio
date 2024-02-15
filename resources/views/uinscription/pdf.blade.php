<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comprobante de Inscripción</title>
    <!-- Estilos en línea para el PDF -->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h1, h2 {
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .text-danger {
            color: #d9534f;
        }
    </style>
</head>
<body>

<div style="text-align: center;">
    <img src="{{ public_path('assets/img/Escuela.png') }}" alt="Logo" style="max-width: 10%; height: auto; margin-bottom: 20px; float: left; margin-right: 20px;">
    <h2 style="float: left; margin-top: 20px;">Escuela Superior de Comercio Nº 43</h2>
    <div style="clear: both;"></div>
</div>
    <h1>Comprobante de Inscripción</h1>

    <div>
        <!-- Información del Usuario -->
        <div>
            <h2>Información Del Alumno:</h2>
            <table>
                <tr>
                    <th>DNI</th>
                    <td>
                        @if(Auth::user()->dni)
                            {{ Auth::user()->dni }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Nombre</th>
                    <td>{{ Auth::user()->name }}</td>
                </tr>
                <tr>
                    <th>Apellido</th>
                    <td>
                        @if(Auth::user()->apellido)
                            {{ Auth::user()->apellido }}
                        @else
                            <p class="text-danger">¡Error! No se ha encontrado un apellido cargado para este usuario.</p>
                        @endif
                    </td>
                </tr>
            </table>
        </div>

        <div>
            <h2>Información de la Mesa de Examen:</h2>
            <table>
                @if ($mesaexamens)
                    <tr>
                        <th>Carrera</th>
                        <td>{{ $mesaexamens->carrera->description }}</td>
                    </tr>
                    <tr>
                        <th>Año</th>
                        <td>{{ $mesaexamens->anio->description }}</td>
                    </tr>
                    <tr>
                        <th>Unidad Curricular</th>
                        <td>{{ $mesaexamens->unidadCurricular->name }}</td>
                    </tr>
                    <tr>
                        <th>Primer Llamado</th>
                        <td>{{ \Carbon\Carbon::parse($mesaexamens->llamado)->format('d/m/Y') }}</td>
                    </tr>
                    <tr>
                        <th>Segundo Llamado</th>
                        <td>{{ \Carbon\Carbon::parse($mesaexamens->llamado2)->format('d/m/Y') }}</td>
                    </tr>
                    <tr>
                        <th>Hora</th>
                        <td>{{ $mesaexamens->hora }}</td>
                    </tr>
                    <tr>
                        <th>Presidente</th>
                        <td>{{ $mesaexamens->presidente->nom_doc }}</td>
                    </tr>
                    <tr>
                        <th>Vocal 1</th>
                        <td>{{ $mesaexamens->vocal->nom_doc }}</td>
                    </tr>
                    <tr>
                        <th>Vocal 2</th>
                        <td>{{ $mesaexamens->vocal2->nom_doc }}</td>
                    </tr>
                </table>
            @endif
        </div>
    </div>

    <!-- Número de Inscripción y Fecha de Inscripción -->
    @if ($uinscription)
        <h3>Número de Inscripción: {{ $uinscription->id }}</h3>
    <h3>Fecha de Inscripción: {{ $uinscription->created_at->format('d/m/Y') }} - Hora de Inscripción: {{ $uinscription->created_at->format('H:i:s') }}</h3>

    @else
        <p class="text-danger">¡Error! No se encontró una inscripción válida.</p>
    @endif

<p>Este comprobante tiene validez exclusiva mientras su inscripción en la mesa de examen correspondiente esté activa. En el caso de optar por la eliminación de su inscripción, este documento perderá su vigencia. Le solicitamos actuar con responsabilidad en este punto. Agradecemos su comprensión y le deseamos éxito en su examen.</p>
</body>
</html>
