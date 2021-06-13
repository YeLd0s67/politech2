@extends('layouts.app')

@section('content')
    
    <h3 align="center"> Жұмыс орындарының кодтары </h3>
    <br/>
    @auth
    <div class="flex justify-center">
        {{-- <div class="form-group">
            <form method="GET" action="{{ route('job.list') }}">
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

        </div> --}}
        <div id="main" class="w-8/12 bg-white p-6 rounded-lg">
            <div class="input-group rounded">
                <input type="search" id="search" onkeyup="search()" class="form-control rounded" placeholder="Іздеу" aria-label="Search"
                  aria-describedby="search-addon" />
            </div>
                <table id="subj_table" class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th id="id" scope="col">#</th>
                            <th scope="col">Жұмысқа орындары кодтары</th>
                            <th scope="col">Жұмысқа орындары атаулары</th>
                            <th scope="col">Түлек аты</th>
                            <th scope="col">Тобы</th>
                            <th scope="col">Әрекет</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jobs as $key => $job )
                            <tr id={{ $job->id }}>
                                <td scope="row">{{ ++$key }}</td>
                                <td scope="row">{{ $job->code }}</td>
                                <td scope="row">{{ $job->name }}</td>
                                <td scope="row">{{ $job->grad }}</td>
                                <td scope="row">{{ $job->group }}</td>
                                <td scope="row"> 
                                    <div class="row">
                                        <div class="col-sm-12 text-center">
                                            <button id="del" value="{{ $job->id }}" class="btn btn-danger btn-md" onclick="deletejob({{ $job->id }})">Жою</button>
                                         </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            <br/>
            <button class="btn btn-primary" type="submit">
                <a class="text-white" href="{{ route('jobs.insert') }}">Жұмыс орындарының кодтарын енгізу</a>
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
        let deletejob = (id) => {
            if (confirm('Жою?')) {
                $.ajax({
                    type: "POST",
                    url: "/second/jobs/delete",
                    headers: {"X-CSRF-TOKEN": "{{ csrf_token() }}"},
                    data: {job_id: id},
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