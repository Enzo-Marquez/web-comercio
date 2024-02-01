@extends('app')

@section('content')
    <section class="section">
        <div class="section-header" style="max-width: 500px;">
            <h3 class="page__heading">Perfil</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-stripped mt-2">
                                    <thead style="background-color: #6777ef;">
                                        <th style="display: none;">Id</th>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>Dni</th>
                                        <th>E-mail</th>
                                        <th>Acciones</th>
                                        
                                        
                                    </thead>
                                    <tbody>
                                        @foreach ($usuarios as $usuario)
                                       @if(\Illuminate\Support\Facades\Auth::user()->id == $usuario->id)
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
@endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                           <a class="btn btn-info" href="{{ route('usercarreras.index')}}">Administrar Carreras</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
