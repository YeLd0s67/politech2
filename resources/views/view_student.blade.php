@extends('layouts.app')

@section('content')
    <h3 align="center">Оқытушы</h3>
    <br/>
    @auth
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg">
            <ul class="list-group">
                @foreach ($student as $s )
                    <li class="list-group-item" style="display: inline-block;"><b>ЖСН:</b> {{ $s->iin }}</li>
                    <li class="list-group-item"><b>Тегі:</b> {{ $s->first_name }}</li>
                    <li class="list-group-item"><b>Аты:</b> {{ $s->last_name }}</li>
                    <li class="list-group-item"><b>Әкесінің аты:</b> {{ $s->middle_name }}</li>
                    <li class="list-group-item"><b>Туған күні:</b> {{ $s->date_birth }}</li>
                    <li class="list-group-item"><b>Жынысы:</b> {{ $s->gender }}</li>
                    @if ($s->citizen == 'Басқа')
                        <li class="list-group-item"><b>Азаматтығы:</b> {{ $s->other_citizen }}</li>    
                    @else 
                        <li class="list-group-item"><b>Азаматтығы:</b> {{ $s->citizen }}</li>   
                    @endif
                    
                    @if ($s->nation == 'Басқа')
                        <li class="list-group-item"><b>Ұлты:</b> {{ $s->other_nation }}</li>    
                    @else 
                        <li class="list-group-item"><b>Ұлты:</b> {{ $s->nation }}</li>   
                    @endif
                    <li class="list-group-item"><b>Мамандығы:</b> {{ $s->spec }}</li>
                    <li class="list-group-item"><b>Тобы:</b> {{ $s->group }}</li>
                    <li class="list-group-item"><b>Жеке куәлік:</b> {{ $s->passport }}</li>
                    <li class="list-group-item"><b>Берген мекеме:</b> {{ $s->passport_given }}</li>
                    <li class="list-group-item"><b>Мекен-жайы: тіркелген және таразда тұратын мекен жайы:</b> {{ $s->address }}</li>
                    <li class="list-group-item"><b>Телефон: Ата анасының және студенттің:</b> {{ $s->phone }}</li>
                    <li class="list-group-item"><b>Келген мектебі:</b> {{ $s->school }}</li>
                    <li class="list-group-item"><b>Оқу тілі:</b> {{ $s->lang }}</li>
                    <li class="list-group-item"><b>Отбасындағы бала саны:</b> {{ $s->family_children }}</li>
                    <li class="list-group-item"><b>Қатысатын үйірмелері:</b> {{ $s->clubs }}</li>
                    <li class="list-group-item"><b>Ата-анасының толық аты-жөні:</b> {{ $s->parent_names }}</li>
                    <li class="list-group-item"><b>Әкесінің ж/е анасының жеке куәлігі:</b> {{ $s->work }}</li>
                    <li class="list-group-item"><b>Әкесінің ж/е анасының жеке ИИН:</b>{{ $s->parent_passport }}</li>
                    <li class="list-group-item"><b>Студенттің әлеуметтік статусы:</b> {{ $s->parent_iin }}</li>
                    <li class="list-group-item"><b>Ағылшын тілін білу деңгейі:</b> {{ $s->status }}</li>                                
                @endforeach
            </ul>
            <br>
            {{-- @foreach ($student as $s)
                <button style="float:right" id="more" class="btn btn-primary btn-md"><a href='{{ route('edit.students', ['id' => $s->id ]) }}' class="text-white"> Өзгерту</a> </button>                
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