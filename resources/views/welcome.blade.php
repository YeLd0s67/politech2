@extends('layouts.app')

@section('content')
    @auth
    <div class="flex justify-center">
        <div  style="font-family: 'Pacifico', cursive;" class="w-8/12 bg-yellow-100 p-6 rounded-lg">
            Қош келдіңіз {{ auth()->user()->name }}!
        </div>
    </div>
    @endauth
    @guest
    <div class="flex justify-center">
        <div  style="font-family: 'Pacifico', cursive;" class="w-8/12 bg-yellow-100 p-6 rounded-lg">
            Жұмыс жасау үшін, Кіру немес Тіркелу керек
        </div>
    </div>  
    @endguest
@endsection