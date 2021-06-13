@extends('layouts.app')

@section('content')
    
    <h3 align="center">Пән Енгізу</h3>
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
            <form method="POST" action="{{ route('subjects.store') }}">
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
                    <label>Пән атауы</label>
                    <input type="text" name="subject" id="subject" class="form-control" value="" />
                </div>

                <div class="form-group">
                    <label>Сынақ түрі</label>
                    <select class="form-select" aria-label="Default select example" name="exam" id="exam">
                        <option value="Сынақ" selected>Сынақ</option>
                        <option value="Ағымды емтихан">Ағымды емтихан</option>
                        <option value="Мемл.емтихан">Мемл.емтихан</option>
                    </select>  
                </div>

                <div class="form-group">
                    <label>Бақылау жұмысы</label>
                    <select class="form-select" aria-label="Default select example" name="bakylau" id="bakylau">
                        <option value="Иә" selected>Иә</option>
                        <option value="Жоқ">Жоқ</option>
                    </select>  
                </div>
                
                <div class="form-group">
                    <label>Курстық жоба</label>
                    <select class="form-select" aria-label="Default select example" name="course_job" id="course_job">
                        <option value="Иә" selected>Иә</option>
                        <option value="Жоқ">Жоқ</option>
                    </select>  
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