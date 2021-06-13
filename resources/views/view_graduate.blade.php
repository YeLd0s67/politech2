@extends('layouts.app')

@section('content')
    <h3 align="center">Оқытушы</h3>
    <br/>
    @auth
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg">
            <ul class="list-group">
                @foreach ($graduate as $g )
                    <li class="list-group-item" style="display: inline-block;"><b>ЖСН:</b> {{ $g->iin }}</li>
                    <li class="list-group-item"><b>Тегі:</b> {{ $g->first_name }}</li>
                    <li class="list-group-item"><b>Аты:</b> {{ $g->last_name }}</li>
                    <li class="list-group-item"><b>Әкесінің аты:</b> {{ $g->middle_name }}</li>
                    <li class="list-group-item"><b>Туған күні:</b> {{ $g->date_birth }}</li>
                    <li class="list-group-item"><b>Жынысы:</b> {{ $g->gender }}</li>                    
                    @if ($g->nation == 'Басқа')
                        <li class="list-group-item"><b>Ұлты:</b> {{ $g->other_nation }}</li>    
                    @else 
                        <li class="list-group-item"><b>Ұлты:</b> {{ $g->nation }}</li>   
                    @endif
                    <li class="list-group-item"><b>Мамандық коды:</b> {{ $g->spec_code }}</li>
                    <li class="list-group-item"><b>Мамандық атауы:</b> {{ $g->spec }}</li>
                    <li class="list-group-item"><b>Tобы:</b> {{ $g->group }}</li>
                    <li class="list-group-item"><b>Оқу  негізі:</b> {{ $g->grant }}</li>
                    <li class="list-group-item"><b>Жұмысқа орналасқаны (мекеме атауы):</b> {{ $g->company }}</li>
                    <li class="list-group-item"><b>ЖОО-да оқиды (в текущий период):</b> {{ $g->study }}</li>
                    <li class="list-group-item"><b>Жоғары оқу орнында (ЖОО атауы):</b> {{ $g->university }}</li>
                    <li class="list-group-item"><b>Жоғары оқу орнындағы оқу түрі:</b> {{ $g->study_type }}</li>
                    <li class="list-group-item"><b>Жоғары оқу орнына түскен жылы:</b> {{ $g->university_year }}</li>
                    <li class="list-group-item"><b>Жоғары оқу орнына біттірген жылы:</b> {{ $g->end_year }}</li>
                    <li class="list-group-item"><b>техникалық және кәсіптік білім ұйымдарында (атауы):</b> {{ $g->work }}</li>
                    <li class="list-group-item"><b>Әскери қызмет ету қатарына шақырылған жылы:</b> {{ $g->army }}</li>
                    <li class="list-group-item"><b>Қазақстан Республикасынан тыс жерге кеткен:</b>{{ $g->abroad }}</li>
                    <li class="list-group-item"><b>Бала күтімі бойынша демалыс:</b> {{ $g->child }}</li>
                    <li class="list-group-item"><b>Жұмыспен қамтылмаған:</b> {{ $g->unemployed }}</li> 
                    <li class="list-group-item"><b>Тұрғылықты мекен-жайы:</b>{{ $g->address }}</li>
                    <li class="list-group-item"><b>Электронды адрес (Е-mail):</b> {{ $g->email }}</li>
                    <li class="list-group-item"><b>Ұялы телефон (нөмірі):</b> {{ $g->phone }}</li>
                    <li class="list-group-item"><b>Жеке кәсібін ашқан жылы, кәсібінің атауы:</b> {{ $g->business }}</li>                                
                @endforeach
            </ul>
            <br>
            {{-- @foreach ($gtudent as $g)
                <button style="float:right" id="more" class="btn btn-primary btn-md"><a href='{{ route('edit.students', ['id' => $g->id ]) }}' class="text-white"> Өзгерту</a> </button>                
            @endforeach --}}


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
@endsection