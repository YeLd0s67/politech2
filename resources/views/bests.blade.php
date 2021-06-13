@extends('layouts.app')

@section('content')
    
    <h3 align="center"> Үздік түлектердің жұмысқа орналасуы </h3>
    <br/>
    @auth
    <div class="flex justify-center">
        {{-- <div class="form-group">
            <form method="GET" action="{{ route('best.list') }}">
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
            <div class="table-responsive">

                <table id="subj_table" class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th id="id" scope="col">#</th>
                            <th scope="col">Түлектің  аты-жөні</th>
                            <th scope="col">Мамандығының шифры</th>
                            <th scope="col">Оқу бітірген жылы</th>
                            <th scope="col">Жұмысқа орналасуы (қандай мекемеге)</th>
                            <th scope="col">Жеке кәсібін ашқандар</th>
                            <th scope="col">Жоғары оқу орнында оқитындар </th>
                            <th scope="col">техникалық және кәсіптік білім ұйымдарында оқитындар</th>
                            <th scope="col">әскери қызмет ету қатарына шақырылғандар</th>
                            <th scope="col">Қазақстан Республикасынан тыс жерге кеткендер</th>
                            <th scope="col">бала күтімі бойынша демалыс</th>
                            <th scope="col">Жұмыспен қамтылмағандар </th>
                            <th scope="col">Әрекет</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bests as $key => $best )
                            <tr id={{ $best->id }}>
                                <td scope="row">{{ ++$key }}</td>
                                <td scope="row">{{ $best->name }}</td>
                                <td scope="row">{{ $best->code }}</td>
                                <td scope="row">{{ $best->end_year }}</td>
                                <td scope="row">{{ $best->best }}</td>
                                <td scope="row">{{ $best->business }}</td>
                                <td scope="row">{{ $best->study }}</td>
                                <td scope="row">{{ $best->tech }}</td>
                                <td scope="row">{{ $best->army }}</td>
                                <td scope="row">{{ $best->abroad }}</td>
                                <td scope="row">{{ $best->child }}</td>
                                <td scope="row">{{ $best->work }}</td>
                                <td scope="row"> 
                                    <div class="row">
                                        <div class="col-sm-12 text-center">
                                            <button id="del" value="{{ $best->id }}" class="btn btn-danger btn-md" onclick="deletebest({{ $best->id }})">Жою</button>
                                         </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <br/>
            <button class="btn btn-primary" type="submit">
                <a class="text-white" href="{{ route('bests.insert') }}">Үздік түлектердің жұмысқа орналасуы енгізу</a>
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
        let deletebest = (id) => {
            if (confirm('Жою?')) {
                $.ajax({
                    type: "POST",
                    url: "/second/bests/delete",
                    headers: {"X-CSRF-TOKEN": "{{ csrf_token() }}"},
                    data: {best_id: id},
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