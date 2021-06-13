@extends('layouts.app')

@section('content')
    
    <h3 align="center">Пәндер</h3>
    <br/>
    @auth
    <div class="flex justify-center">
        <div class="form-group">
            <form method="GET" action="{{ route('subject.list') }}">
                {{ csrf_field() }}
                <label>Мамандық</label>
                <select class="form-select" name="speciality" id="speciality">
                    @foreach ($profs as $prof)
                        <option value="{{ $prof->short_name }}">{{ $prof->short_name }}</option>
                    @endforeach                            
                </select>
                <br/>
                <div class="form-group">
                    <div class="col-md-6">
                      <input type="submit" name="download" value='Пәндер тізімі' class='btn btn-success'>
                    </div>
                </div>
            </form>

        </div>
        <div id="main" class="w-8/12 bg-white p-6 rounded-lg">
            <div class="input-group rounded">
                <input type="search" id="search" onkeyup="search()" class="form-control rounded" placeholder="Іздеу" aria-label="Search"
                  aria-describedby="search-addon" />
            </div>
                <table id="subj_table" class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th id="id" scope="col">#</th>
                            <th scope="col">Мамандық</th>
                            <th scope="col">Оқуға түскен жылы</th>
                            <th scope="col">Семестр</th>
                            <th scope="col">Топ</th>
                            <th scope="col">Пән атауы</th>
                            <th scope="col">Студенттерді бағалау түрі</th>
                            <th scope="col">Бақылау жұмысы</th>
                            <th scope="col">Курстық жоба</th>
                            <th scope="col">Әрекет</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($subjects as $key => $subject )
                            <tr id={{ $subject->id }}>
                                <td scope="row">{{ ++$key }}</td>
                                <td scope="row">{{ $subject->speciality }}</td>
                                <td scope="row">{{ $subject->year }}</td>
                                <td scope="row">{{ $subject->semester }}</td>
                                <td scope="row">{{ $subject->group }}</td>
                                <td scope="row">{{ $subject->subject }}</td>
                                <td scope="row">{{ $subject->exam }}</td>
                                <td scope="row">{{ $subject->bakylau }}</td>
                                <td scope="row">{{ $subject->course_job }}</td>
                                <td scope="row"> 
                                    <div class="row">
                                        <div class="col-sm-12 text-center">
                                            <button id="del" value="{{ $subject->id }}" class="btn btn-danger btn-md" onclick="deleteSubject({{ $subject->id }})">Жою</button>
                                         </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            <br/>
            <button class="btn btn-primary" type="submit">
                <a class="text-white" href="{{ route('subjects.insert') }}">Пән енгізу</a>
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
        let deleteSubject = (id) => {
            if (confirm('Жою?')) {
                $.ajax({
                    type: "POST",
                    url: "/subjects/delete",
                    headers: {"X-CSRF-TOKEN": "{{ csrf_token() }}"},
                    data: {subject_id: id},
                    success: status_code => {
                        if (status = 200) {
                            window.location.reload(true);
                        }else {
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
            table = document.getElementById("subj_table");
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