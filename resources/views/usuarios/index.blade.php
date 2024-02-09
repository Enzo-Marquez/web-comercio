@extends('app')

@php
    use App\Enums\UserType;
@endphp
@section('content')
    <section class="section">
        <div class="section-header" style="max-width: 500px;">
            <h3 class="page__heading">Perfil</h3>

        @if (Auth::user()->user_type === 'admin')
                <label for="search">Buscar:</label>
                <input type="text" class="form-control" name="search" id="search">
            @endif

        
        </div>
        <div class="section-body">
            <div class="row">
                <div>
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
                                    <tbody id="listaConsulta">
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






<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script>

   $(document).ready(function() {
        var inputElement = document.getElementById("search");
        if (localStorage.getItem("searchText")) {
            inputElement.value = localStorage.getItem("searchText");
        }
        inputElement.addEventListener("input", function(event) {
            localStorage.setItem("searchText", event.target.value);
        });

        $('#search').keyup(function() {
            search_table($(this).val());
        });

        function search_table(value) {
        var searchWords = value.toLowerCase().split(" ");
        $('#listaConsulta tr').each(function() {
            var found = true;
            var rowText = $(this).text().toLowerCase();

            for (var i = 0; i < searchWords.length; i++) {
            var searchWord = searchWords[i].trim();
            if (rowText.indexOf(searchWord) === -1) {
                found = false;
                break;
            }
            }

            if (found) {
            $(this).show();
            } else {
            $(this).hide();
            }
        });
        }


  search_table($('#search').val());


});

</script>



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
