@extends('layouts.app')

@section('content')
    <h3 align="center">Түлектер</h3>
    <br/>    
    @auth
        <div class="flex justify-center">
            <div class="w-8/12 bg-white p-6 rounded-lg">
                <div class="input-group rounded">
                    <input type="search" id="search" onkeyup="search()" class="form-control rounded" placeholder="Іздеу" aria-label="Search"
                      aria-describedby="search-addon" />
                </div>
                <div class="input-group rounded">
                    <select class="form-select" aria-label="Default select example" name="what" id="what">
                        <option value="Жылдар бойынша" selected>Жылдар бойынша</option>
                        <option value="Жұмыс орындары бойынша">Жұмыс орындары бойынша</option>
                        <option value="Әскер қатарына шақырылғандар">Әскер қатарына шақырылғандар</option>
                        <option value="Бала күтімі бойынша демалыс">Бала күтімі бойынша демалыс</option>
                    </select> 
                    <input type="text" name="year" id="year" class="form-control" value="" />

                    <button class="btn btn-primary" id="search" type="submit" onclick="myFunction()">
                        Іздеу
                    </button>
    
                </div>
                <div class="table-responsive">
                    <table id="subj_table" class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th id="id" scope="col">#</th>
                                <th scope="col">ЖСН</th>
                                <th scope="col">Аты</th>
                                <th scope="col">Тегі</th>
                                <th scope="col">Туған күні</th>
                                <th scope="col">Жынысы</th>
                                <th scope="col">Ұлты</th>
                                <th scope="col">Жоғары оқу орнын біттірген жылы</th>
                                <th scope="col">Жұмысқа орналасқаны (мекеме атауы)</th>
                                <th scope="col">Әскерге қызмет ету қатарына шақырылған жылы</th>
                                <th scope="col">Бала күтімі бойынша демалыс</th>
                                <th scope="col">Әрекет</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($graduates as $key => $graduate )
                                <tr id={{ $graduate->id }}>
                                    <td scope="row">{{ ++$key }}</td>
                                    <td id="IIN" scope="row">{{ $graduate->iin }}</td>
                                    <td scope="row">{{ $graduate->first_name }}</td>
                                    <td scope="row">{{ $graduate->last_name }}</td>
                                    <td scope="row">{{ $graduate->date_birth }}</td>
                                    <td scope="row">{{ $graduate->gender }}</td>
                                    @if ($graduate->citizen == 'Басқа')
                                        <td scope="row">{{ $graduate->other_nation }}</td>
                                    @else 
                                        <td scope="row">{{ $graduate->nation }}</td>
                                    @endif
                                    <td scope="row">{{ $graduate->end_year }}</td>
                                    <td scope="row">{{ $graduate->company }}</td>
                                    <td scope="row">{{ $graduate->army }}</td>
                                    <td scope="row">{{ $graduate->child }}</td>
                                    <td scope="row"> 
                                        <div class="row">
                                            <div class="col-sm-12 text-center">
                                                <button id="more" value="{{ $graduate->id }}" class="btn btn-primary btn-md"><a href='{{ route('second.view.graduate', ['id' => $graduate->id ]) }}' class="text-white">Көру</a></button>
                                                <button id="del" value="{{ $graduate->id }}" class="btn btn-danger btn-md" onclick="deletegraduate({{ $graduate->id }})">Жою</button>
                                             </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <br/>
                <button class="btn btn-primary">
                    <a style="color: white" href="/second/graduate/insert_graduate">Түлектер қосу</a>
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
        let deletegraduate = (id) => {
            if (confirm('Жою?')) {
                $.ajax({
                    type: "POST",
                    url: "/second/graduate/delete",
                    headers: {"X-CSRF-TOKEN": "{{ csrf_token() }}"},
                    data: {graduate_id: id},
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
    <script>
        function myFunction() {
            var input = document.getElementById("what");
            var input2 = document.getElementById("year");
            var filter = input.value.toUpperCase();
            var filter2 = input2.value.toUpperCase();

            var rows = document.querySelector("#subj_table tbody").rows;
            if(filter == 'ЖЫЛДАР БОЙЫНША'){
                for (var i = 0; i < rows.length; i++) {
                    var secondCol = rows[i].cells[7].textContent.toUpperCase();
                    console.log(secondCol);

                    if (secondCol.indexOf(filter2) > -1) {
                        rows[i].style.display = "";
                    } else {
                        rows[i].style.display = "none";
                    }      
                }
            }
            else if(filter == 'ӘСКЕР ҚАТАРЫНА ШАҚЫРЫЛҒАНДАР'){
                for (var i = 0; i < rows.length; i++) {
                    var secondCol = rows[i].cells[9].textContent.toUpperCase();
                    console.log(secondCol);

                    if (secondCol.indexOf(filter2) > -1) {
                        rows[i].style.display = "";
                    } else {
                        rows[i].style.display = "none";
                    }      
                }
            }else{
                for (var i = 0; i < rows.length; i++) {
                    var secondCol = rows[i].cells[10].textContent.toUpperCase();
                    console.log(secondCol);

                    if (secondCol.indexOf(filter2) > -1) {
                        rows[i].style.display = "";
                    } else {
                        rows[i].style.display = "none";
                    }      
                }
            }
        }
    </script>
@endsection