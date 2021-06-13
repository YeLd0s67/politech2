@extends('layouts.app')

@section('content')
    
    <h3 align="center">Үздік түлектердің жұмысқа орналасуы Енгізу</h3>
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
            <form method="POST" action="{{ route('bests.store') }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <label>Түлектің  аты-жөні</label>
                    <input type="text" name="name" id="name" class="form-control" value="" />
                </div>
                
                <div class="form-group">
                    <label>Мамандығының шифры</label>
                    <input type="text" name="code" id="code" class="form-control" value="" />
                </div>

                <div class="form-group">
                    <label>Оқу бітірген жылы</label>
                    <input type="text" name="end_year" id="end_year" class="form-control" value="" />
                </div>

                <div class="form-group">
                    <label>Жұмысқа орналасуы (қандай мекемеге)</label>
                    <input type="text" name="job" id="job" class="form-control" value="" />
                </div>

                <div class="form-group">
                    <label>Жеке кәсібін ашқандар</label>
                    <input type="text" name="business" id="business" class="form-control" value="" />
                </div>
                
                <div class="form-group">
                    <label>жоғары оқу орнында оқитындар </label>
                    <input type="text" name="study" id="study" class="form-control" value="" />
                </div>
                
                <div class="form-group">
                    <label>техникалық және кәсіптік білім ұйымдарында оқитындар </label>
                    <input type="text" name="tech" id="tech" class="form-control" value="" />
                </div>
                
                <div class="form-group">
                    <label>әскери қызмет ету қатарына шақырылғандар </label>
                    <input type="text" name="army" id="army" class="form-control" value="" />
                </div>                
                <div class="form-group">
                    <label>Қазақстан Республикасынан тыс жерге кеткендер </label>
                    <select class="form-select" aria-label="Default select example" name="abroad" id="abroad">
                        <option value="Иә" selected>Иә</option>
                        <option value="Жоқ">Жоқ</option>
                    </select>   
                </div>
                
                <div class="form-group">
                    <label>бала күтімі бойынша демалыс </label>
                    <select class="form-select" aria-label="Default select example" name="child" id="child">
                        <option value="Иә" selected>Иә</option>
                        <option value="Жоқ">Жоқ</option>
                    </select>   
                </div>                
                <div class="form-group">
                    <label>Жұмыспен қамтылмағандар </label>
                    <select class="form-select" aria-label="Default select example" name="work" id="work">
                        <option value="Қамтылған" selected>Қамтылған</option>
                        <option value="Қамтылмаған">Қамтылмаған</option>
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