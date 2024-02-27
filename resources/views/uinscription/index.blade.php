@extends('app')
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">    

@section('content')

@php
    use Carbon\Carbon;
@endphp
<!-- Incluir Font Awesome (CDN) en el head de tu HTML -->


@if (Auth::user()->user_type === 'user')
    <div>
        <div class="row justify-content-center">
            <div>
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Formulario de Inscripción</h5>
                    </div>


<!-- Asegúrate de haber importado Carbon en la parte superior de tu archivo de vista -->

















                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif


                             @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif

                        <div class="row">
                            <!-- Información del Usuario -->
                            <div class="col-md-6 mb-3">
                                <h6>Información del Usuario:</h6>
                                <table class="table table-bordered">
                                    <tr>
                                        <input type="text" style="display: none;" name="user_id"
                                            value="{{\Illuminate\Support\Facades\Auth::user()->id}}">

                                        <th>DNI</th>
                                        <td>
                                            @if(Auth::user()->dni)
                                                {{ Auth::user()->dni }}
                                            @else
                                                <p class="text-danger">¡Error! No se ha encontrado un DNI cargado para este usuario.</p>
                                            @endif
                                        </td>
                                    </tr>

                                <th>Teléfono</th>
                                        <td>
                                            @if(Auth::user()->telefono)
                                                {{ Auth::user()->telefono }}
                                            @else
                                                <p class="text-danger">¡Error! No se ha encontrado un Telefono cargado para este usuario.</p>
                                            @endif
                                        </td>
                                    </tr>

                                    <th>Email</th>
                                        <td>
                                            @if(Auth::user()->email)
                                                {{ Auth::user()->email }}
                                            @else
                                                <p class="text-danger">¡Error! No se ha encontrado un Telefono cargado para este usuario.</p>
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

                            @if ($mesaexamens)
                                <div class="col-md-6 mb-3">
                                    <h6>Información de la Mesa de Examen:</h6>
                                    <table class="table table-bordered">
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
                                </div>
                            @endif
                        </div>

                   

                    @endif
                    



@unless(Cache::get('ocultar_boton'))
@if (Auth::user()->user_type === 'admin')
        <div class="alert alert-success mt-3">
        Inscripciones Habilitadas
    </div>
    @endif
    @if (Auth::user()->user_type === 'user')
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#inscriptionModal">
        Inscribirme
    </button>
    @endif
@else
@if (Auth::user()->user_type === 'user')
    <div class="alert alert-warning mt-3">
        El tiempo límite de inscripción ha pasado. Ya no es posible inscribirse o eliminarse de la Mesa.
    </div>
    @endif
    @if (Auth::user()->user_type === 'admin')
        <div class="alert alert-warning mt-3">
        Inscripciones Deshabilitadas
    </div>
    @endif
@endunless

@if (Auth::user()->user_type === 'admin')
<!-- Botón para ocultar -->
<button type="button" class="btn btn-danger" onclick="ocultarBoton()">Deshabilitar Inscripciones</button>

<!-- Botón para mostrar -->
<button type="button" class="btn btn-success" onclick="mostrarBoton()">Habilitar Inscripciones</button>
@endif





<script>
    function ocultarBoton() {
        $.ajax({
            url: '/ocultar-boton',
            type: 'GET',
            success: function(response) {
                location.reload(); // Recarga la página para reflejar el cambio
            }
        });
    }

    function mostrarBoton() {
        $.ajax({
            url: '/mostrar-boton',
            type: 'GET',
            success: function(response) {
                location.reload(); // Recarga la página para reflejar el cambio
            }
        });
    }
</script>
















<!-- Modal para el Formulario de Inscripción -->
<div class="modal fade" id="inscriptionModal" tabindex="-1" role="dialog" aria-labelledby="inscriptionModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="inscriptionModalLabel">Formulario de Inscripción</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulario de Inscripción -->
                <form action="{{ route('uinscription.store') }}" method="POST" id="inscriptionForm">
                    @csrf
                    <!-- Otros campos similares a los de tu formulario de mesaexamens -->
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="mesaexamen_id" value="{{ $mesa_id }}">
                    
                    <!-- Otros campos del formulario -->

                    <div class="mb-3">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="termsCheckbox" name="termsCheckbox" required>
                            <label class="form-check-label" for="termsCheckbox">  Acepto los términos y condiciones. Al enviar este formulario, confirmo que he leído y estoy de acuerdo con los términos y condiciones establecidos para rendir esta asignatura.</label><br><br>
                            <strong style="color: red;">¡POR FAVOR UNA VEZ INSCRIPTO DESCARGUE EL COMPROBANTE PARA EVITAR INCONVENIENTES!</strong>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" onclick="validateTerms()">Enviar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function validateTerms() {
        if (!document.getElementById('termsCheckbox').checked) {
            alert('Debes aceptar los términos y condiciones.');
        } else {
            document.getElementById('inscriptionForm').submit();
        }
    }
</script>













<!-- Botón y Modal para eliminar -->
@if ($uinscription)
@unless(Cache::get('ocultar_boton_eliminar'))

    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmDeleteModal" data-form-action="{{ route('uinscription.destroy', ['id' => $uinscription->id, 'mesaexamen_id' => $uinscription->mesaexamen_id]) }}">
    {{-- {{ isset($mesaexamens) && Carbon::now()->diffInDays($mesaexamens->llamado) <= 10 ? 'disabled' : '' }}> --}}
    Eliminar Inscripción
</button>
@endunless

    <!-- Modal de Confirmación de Eliminación -->
    <div class="modal" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmar Eliminación</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ¿Está seguro de que desea eliminar esta inscripción?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <form id="deleteForm" method="POST" action="{{ route('uinscription.destroy', ['id' => $uinscription->id, 'mesaexamen_id' => $uinscription->mesaexamen_id]) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <style>
 .red-color {
        color:red;
    }
   </style>


@if (isset($uinscription))
<div style="text-align: right;">
    <a href="{{ route('uinscription.generatePdf', ['uinscription_id' => $uinscription->id]) }}" target="_blank" style="display: inline-block; text-decoration: none; background-color: #808080; color: #fff; padding: 10px 20px; border-radius: 5px; border: 1px solid #808080;">
        <span style="vertical-align: middle;">Generar Comprobante</span>
        <img src="{{ asset('assets/img/boton-pdf.png') }}" alt="Generar PDF" style="max-width: 40px; vertical-align: middle; margin-left: 5px;">
    </a>
</div>




@endif
@endif



@endsection
