@extends('layouts.app')

@section('content')
    <h3 align="center">Мамандықтар</h3>
    <br/>    
    @auth
        <div class="flex justify-center">
            <div class="w-8/12 bg-white p-6 rounded-lg">
                <div class="input-group rounded">
                    <input type="search" id="search" onkeyup="search()" class="form-control rounded" placeholder="Іздеу" aria-label="Search"
                      aria-describedby="search-addon" />
                </div>
                    <table id="teach_table" class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th id="id" scope="col">#</th>
                                <th scope="col">Шифр</th>
                                <th scope="col">Толық атауы</th>
                                <th scope="col">Қысқартылған атауы </th>
                                <th scope="col">Топтар</th>
                                <th scope="col">Оқуға түскен жылы</th>
                                <th scope="col">Әрекет</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($profs as $key => $prof )
                                <tr id={{ $prof->id }}>
                                    <td scope="row">{{ ++$key }}</td>
                                    <td scope="row">{{ $prof->code }}</td>
                                    <td scope="row">{{ $prof->description }}</td>
                                    <td scope="row">{{ $prof->short_name }}</td>
                                    <td scope="row">{{ $prof->groups }}</td>
                                    <td scope="row">{{ $prof->year }}</td>
                                    <td scope="row"> 
                                        <div class="row">
                                            <div class="col-sm-12 text-center">
                                                <button id="del" value="{{ $prof->id }}" class="btn btn-danger btn-md" onclick="deleteprof({{ $prof->id }})">Жою</button>
                                             </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                <br/>
                <button class="btn btn-primary">
                    <a style="color: white" href="/profs/insert">Мамандықтар қосу</a>
                </button>
            </div>
        </div>
    @endauth
    @guest
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg">
            Жұмыс жасау үшін, Кіру немес Тіркелу керек
        </div>
    </div>  
    @endguest

    <script>
        jQuery(document).ready(function($) {
            $("#more").click(function() {
                $(this).attr("value")
            });
        });
    </script>
    <script>
        let deleteprof = (id) => {
            if (confirm('Жою?')) {
                $.ajax({
                    type: "POST",
                    url: "/prof/delete",
                    headers: {"X-CSRF-TOKEN": "{{ csrf_token() }}"},
                    data: {prof_id: id},
                    success: status_code => {
                        if (status = 200) {
                            window.location.reload(true);
                        } else {
                            alert("Упс... Қайта көріңіз");
                        }
                    }
                });
            }
        } 
    </script>
    <script>
        function search() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("search");
            filter = input.value.toUpperCase();
            table = document.getElementById("teach_table");
            tr = table.getElementsByTagName("tr");
            
            for (i = 1; i < tr.length; i++) {
                td = tr[i];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>
@endsection