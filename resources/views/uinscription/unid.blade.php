@extends('app')

@section('content')
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
        <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <h1 class="text-center">Mesas de Examenes</h1>
     
        
        {{-- <form action="{{ route('unidades-curriculares.filter') }}" method="GET" class="mb-3">
    <div class="input-group">
        <input type="text" name="search" class="form-control" placeholder="Buscar Asignatura...">
        <button type="submit" class="btn btn-primary">Buscar</button>
    </div>
</form> --}}

    <div>
      </div>  

    <table class="table table-bordered" id="asd">
        <thead>
            <tr>
                <th>Año</th>
                <th>Unidad Curricular</th>
                <th class="text-end">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($mesaexamens as $mesaexamen)
                <tr>
                    <td>{{ $mesaexamen->anio->description }}</td>
                    <td>{{ $mesaexamen->unidadCurricular->name }}</td>
                    <th class="text-end">
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
<script defer src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script defer src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script defer src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

<script>
$('#asd').DataTable({
responsive: true,
autoWidth: false,
scrollX: true,

"language": {
            "lengthMenu": "Mostrar " + 
            `<select class="form-select form-select-sm">
            <option value='5'>5</option>
            <option value='10'>10</option>
            <option value='15'>15</option>
            </select>` + 
            " Registros por pagina",
    "zeroRecords": "Nada Encontrado - Disculpa",
    "info": "Mostrando la Pagina _PAGE_ De _PAGES_",
    "infoEmpty": "No hay registros disponibles",
    "infoFiltered": "(filtrado de _MAX_ registros totales)",
    'search': 'Buscar:',
    'paginate':{
        'next': 'Siguiente',
        'previous': 'Anterior'
            }
        }
    } );
</script>

@endsection