@extends('layouts.app')

@section('content')
    <h3 align="center">Студенттер</h3>
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
                                <th scope="col">ЖСН</th>
                                <th scope="col">Аты</th>
                                <th scope="col">Тегі</th>
                                <th scope="col">Әкесі аты</th>
                                <th scope="col">Туған күні</th>
                                <th scope="col">Жынысы</th>
                                <th scope="col">Азаматтығы</th>
                                <th scope="col">Әрекет</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $key => $student )
                                <tr id={{ $student->id }}>
                                    <td scope="row">{{ ++$key }}</td>
                                    <td id="IIN" scope="row">{{ $student->iin }}</td>
                                    <td scope="row">{{ $student->first_name }}</td>
                                    <td scope="row">{{ $student->last_name }}</td>
                                    <td scope="row">{{ $student->middle_name }}</td>
                                    <td scope="row">{{ $student->date_birth }}</td>
                                    <td scope="row">{{ $student->gender }}</td>
                                    @if ($student->citizen == 'Басқа')
                                        <td scope="row">{{ $student->other_citizen }}</td>
                                    @else 
                                        <td scope="row">{{ $student->citizen }}</td>
                                    @endif
                                
                                    <td scope="row"> 
                                        <div class="row">
                                            <div class="col-sm-12 text-center">
                                                <button id="more" value="{{ $student->id }}" class="btn btn-primary btn-md"><a href='{{ route('view.student', ['id' => $student->id ]) }}' class="text-white">Көру</a></button>
                                                <button id="del" value="{{ $student->id }}" class="btn btn-danger btn-md" onclick="deletestudent({{ $student->id }})">Жою</button>
                                             </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                <br/>
                <button class="btn btn-primary">
                    <a style="color: white" href="/student/insert_student">Студенттер қосу</a>
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
        let deletestudent = (id) => {
            if (confirm('Жою?')) {
                $.ajax({
                    type: "POST",
                    url: "/student/delete",
                    headers: {"X-CSRF-TOKEN": "{{ csrf_token() }}"},
                    data: {student_id: id},
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