@extends('app')

@section('content')
    <h1>Unidades Curriculares</h1>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Año</th>
                <th>Unidad Curricular</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($mesaexamens as $mesaexamen)
                <tr>
                    <td>{{ $mesaexamen->anio->description }}</td>
                    <td>{{ $mesaexamen->unidadCurricular->name }}</td>
                    <td>
                    <a class="btn btn-info" href="{{ route('uinscription.index', $mesaexamen->id) }}"><i class=" fas fa-pen fa-sm"></i>{{' '}}Inscribirse</a>

                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No hay unidades curriculares disponibles.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
