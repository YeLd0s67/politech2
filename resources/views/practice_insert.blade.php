@extends('layouts.app')

@section('content')
    
    <h3 align="center">Практика Енгізу</h3>
    <br/>
    @auth
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ "Еңгізілді" }}
                </div>
            @endif
            <form method="POST" action="{{ route('practices.store') }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <label>Мамандық</label>
                    <select class="form-select" aria-label="Default select example" name="speciality" id="speciality">
                        @foreach ($profs as $prof)
                            <option value="{{ $prof->short_name }}">{{ $prof->short_name }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="form-group">
                    <label>Оқуға түскен жылы</label>
                    <input type="text" name="year" id="year" class="form-control" value="" />
                </div>

                <div class="form-group">
                    <label>Cеместр</label>
                    <select class="form-select" aria-label="Default select example" name="semester" id="semester">
                      <option value="1" selected>1</option>
                      <option value="2">2</option>
                  </select>  
                </div>

                <div class="form-group">
                    <label>Топ</label>
                    <input type="text" name="group" id="group" class="form-control" value="" />
                </div>

                <div class="form-group">
                    <label>Практика атауы</label>
                    <input type="text" name="practice" id="practice" class="form-control" value="" />
                </div>

                <div class="form-group">
                    <label>Практика түрі</label>
                    <select class="form-select" aria-label="Default select example" name="practice_type" id="practice_type">
                        <option value="Оқу" selected>Оқу</option>
                        <option value="Кәсіптік">Кәсіптік</option>
                        <option value="Технологиялық">Технологиялық</option>
                        <option value="Өндірістік">Өндірістік</option>
                        <option value="Диплом алды">Диплом алды</option>
                    </select>  
                </div>

                <div class="form-group">
                    <label>Жетекшінің Аты-жөні</label>
                    <input type="text" name="advisor" id="advisor" class="form-control" value="" />

                </div>

                  <div class="form-group">
                    <div class="col-md-6">
                      <input type="submit" name="submit" value='Енгізу' class='btn btn-success'>
                    </div>
                  </div>
            </form>
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