@extends('app')

@section('content')
    <h1>Unidades Curriculares</h1>
     
        
        <form action="{{ route('unidades-curriculares.filter') }}" method="GET" class="mb-3">
    <div class="input-group">
        <input type="text" name="search" class="form-control" placeholder="Buscar Asignatura...">
        <button type="submit" class="btn btn-primary">Buscar</button>
    </div>
</form>

    
        

    <table class="table table-bordered" id="listaConsulta">
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
    @php
        $btnClass = $mesaexamen->isInscrito ? 'btn btn-success' : 'btn btn-info';
        $btnText = $mesaexamen->isInscrito ? 'Inscripto' : 'Inscribirse';
    @endphp

    <a class="{{ $btnClass }}" href="{{ route('uinscription.index', $mesaexamen->id) }}">
        <i class="fas fa-pen fa-sm"></i>{{ ' ' }}{{ $btnText }}
    </a>
</td>

            @empty
                <tr>
                    <td colspan="4">No hay unidades curriculares disponibles.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
{{-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> --}}

    {{-- <script>

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

</script> --}}
@endsection
