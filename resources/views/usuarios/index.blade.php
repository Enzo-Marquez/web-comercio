@extends('app')

@php
    use App\Enums\UserType;
@endphp

@section('content')
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
                                        <th>E-mail</th>
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
                                                <td> 
                                                    <a class="btn btn-primary btn-sm" href="{{ route('usuarios.edit', $usuario->id) }}">Editar</a>
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
                                    <ul class="pagination">
                                        @if ($usuarios->onFirstPage())
                                            <li class="page-item disabled">
                                                <span class="page-link">&laquo; Anterior</span>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $usuarios->previousPageUrl() }}" aria-label="Anterior">
                                                    <span aria-hidden="true">&laquo; Anterior</span>
                                                </a>
                                            </li>
                                        @endif

                                        @for ($i = 1; $i <= $usuarios->lastPage(); $i++)
                                            <li class="page-item {{ $usuarios->currentPage() == $i ? 'active' : '' }}">
                                                <a class="page-link" href="{{ $usuarios->url($i) }}">{{ $i }}</a>
                                            </li>
                                        @endfor

                                        @if ($usuarios->hasMorePages())
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $usuarios->nextPageUrl() }}" aria-label="Siguiente">
                                                    <span aria-hidden="true">Siguiente &raquo;</span>
                                                </a>
                                            </li>
                                        @else
                                            <li class="page-item disabled">
                                                <span class="page-link">Siguiente &raquo;</span>
                                            </li>
                                        @endif
                                    </ul>
                                </nav>
                            </div>
@endif
                            <a class="btn btn-info" href="{{ route('usercarreras.index')}}">Administrar Carreras</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
