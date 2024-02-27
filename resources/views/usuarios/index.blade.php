@extends('app')

@php
    use App\Enums\UserType;
@endphp

@section('content')

<style>
.fixed-width-btn {
    width: 100px; /* Ajusta el ancho según sea necesario */
}
</style>
    <section class="section">
        <div>
            <h3 class="page__heading">Perfil</h3>

            @if (Auth::user()->user_type === 'admin')
                <div>
                    <form action="{{ route('usuarios.index') }}" method="GET" class="mb-3">
                        @csrf
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Buscar usuarios...">
                            <button type="submit" class="btn btn-primary">Buscar</button>
                        </div>
                    </form>
                </div>
            @endif
        </div>
        <div>
            <div class="row">
                <div>
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-stripped mt-2">
                                    <thead>
                                        <th style="display: none;">Id</th>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>Dni</th>
                                        <th>Email</th>
                                        <th>Teléfono</th>
                                        <th>Acciones</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($usuarios as $usuario)
                                            <tr>
                                                <td style="display: none;">{{ $usuario->id }}</td>
                                                <td>{{ $usuario->name }}</td>
                                                <td>{{ $usuario->apellido }}</td>
                                                <td>{{ $usuario->dni }}</td>
                                                <td>{{ $usuario->email }}</td>
                                                <td>{{ $usuario->telefono }}</td>
                                                <td>
                                                    @if (Auth::user()->user_type === 'admin' && $usuario->id !== Auth::user()->id)
                                                        <a class="btn btn-primary btn-sm fixed-width-btn" href="{{ route('usuarios.edit', $usuario->id) }}">Editar Rol</a>
                                                    @elseif (Auth::user()->user_type === 'admin' && $usuario->id === Auth::user()->id)
                                                        <a class="btn btn-success btn-sm fixed-width-btn" href="{{ route('usuarios.edit', $usuario->id) }}">Editar Datos</a>
                                                    @elseif (Auth::user()->user_type === 'user' && $usuario->id === Auth::user()->id)
                                                        <a class="btn btn-primary btn-sm fixed-width-btn" href="{{ route('usuarios.edit', $usuario->id) }}">Editar Datos</a>
                                                    @elseif (Auth::user()->user_type === 'moderator' && $usuario->id === Auth::user()->id)
                                                    <a class="btn btn-primary btn-sm fixed-width-btn" href="{{ route('usuarios.edit', $usuario->id) }}">Editar Datos</a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            @if (Auth::user()->user_type === 'admin')
                                <!-- Muestra los botones de paginación en estilo de chat -->
                                <div class="d-flex justify-content-center mt-4">
                                    <nav aria-label="Page navigation example">
                                        <!-- Código de paginación aquí -->
                                    </nav>
                                </div>
                            @endif
                            @if (Auth::user()->user_type === 'user')
                            <a class="btn btn-info" href="{{ route('usercarreras.index')}}">Administrar Carreras</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
