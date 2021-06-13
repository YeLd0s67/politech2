@extends('layouts.app')

@section('content')
    
    <h3 align="center">Түлектер</h3>
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
                    {{ session()->get('message') }}
                </div>
            @endif
            <form method="post" action="{{ route('second.insert.send') }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <label>ЖСН</label>
                    <input type="text" name="iin" id="iin" class="form-control" value="" />
                </div>
                <div class="form-group">
                    <label>Жеке куәлік</label>
                    <input type="text" name="passport" id="passport" class="form-control" value="" />
                </div>
                <div class="form-group">
                    <label>Тегі</label>
                    <input type="text" name="surename" id="surname" class="form-control" value="" />
                </div>
                <div class="form-group">
                    <label>Аты</label>
                    <input type="text" name="name" id="name" class="form-control" value="" />
                </div>
                <div class="form-group">
                    <label>Әкесінің аты</label>
                    <input type="text" name="middle" id="middle_name" class="form-control" value="" />
                </div>
                <div class="form-group">
                    <label>Туған күні</label>
                    <input type="date" name="birthday" id="birthday" class="form-control" value="" />
                </div>
                <div class="form-group">
                    <label>Жынысы</label>
                    <select class="form-select" aria-label="Default select example" name="gender" id="gender">
                        <option value="Ер" selected>Ер</option>
                        <option value="Әйел">Әйел</option>
                    </select>                
                </div>
                <div class="form-group">
                    <label>Ұлты</label>
                    <select class="form-select" aria-label="Default select example" name="nation" onchange='Nation(this.value);'> 
                        <option value="Қазақ">Қазақ</option>
                        <option value="Басқа">Басқа</option>
                    </select>
                    <input type="text" name="other_nation" class="form-control" value="" id="other_nation" style='display:none;' />
                </div>
                <div class="form-group">
                    <label>Мамандық коды</label>
                    <input type="text" name="spec_code" id="spec_code" class="form-control" value="" />
                </div>
                <div class="form-group">
                    <label>Мамандық атауы</label>
                    <input type="text" name="spec" id="spec" class="form-control" value="" />
                </div>
                <div class="form-group">
                    <label>Тобы</label>
                    <input type="text" name="group" id="group" class="form-control" value="" />
                </div>
                <div class="form-group">
                    <label>Оқу  негізі</label>
                    <select class="form-select" aria-label="Default select example" name="grant"> 
                        <option value="Мемлекеттік тапсырыс негізінде">Мемлекеттік тапсырыс негізінде</option>
                        <option value="Ақылы негізде">Ақылы негізде</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Жұмысқа орналасқаны (мекеме атауы)</label>
                    <input type="text" name="company" id="company" class="form-control" value="" />
                </div>
                <div class="form-group">
                    <label>ЖОО-да оқиды (Ағымдық мерзімде)</label>
                    <select class="form-select" aria-label="Default select example" name="study"> 
                        <option value="Ия">Ия</option>
                        <option value="Жок">Жок</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Жоғары оқу орнында (ЖОО атауы)</label>
                    <input type="text" name="university" id="university" class="form-control" value="" />
                </div>
                <div class="form-group">
                    <label>Жоғары оқу орнындағы оқу түрі</label>
                    <select class="form-select" aria-label="Default select example" name="study_type"> 
                        <option value="күндізгі">күндізгі</option>
                        <option value="қашықтықтан">қашықтықтан</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Жоғары оқу орнына түскен жылы</label>
                    <input type="text" name="university_year" id="university_year" class="form-control" value="" />
                </div>
                <div class="form-group">
                    <label>Жоғары оқу орнына біттірген жылы</label>
                    <input type="text" name="end_year" id="end_year" class="form-control" value="" />
                </div>
                <div class="form-group">
                    <label>Техникалық және кәсіптік білім ұйымдарында (атауы)</label>
                    <input type="text" name="work" id="work" class="form-control" value="" />
                </div>
                <div class="form-group">
                    <label>Әскери қызмет ету қатарына шақырылған жылы</label>
                    <input type="text" name="army" id="army" class="form-control" value="" />
                </div>
                <div class="form-group">
                    <label>Қазақстан Республикасынан тыс жерге кеткен</label>
                    <input type="text" name="abroad" id="abroad" class="form-control" value="" />
                </div>
                <div class="form-group">
                    <label>Бала күтімі бойынша демалыс</label>
                    <input type="text" name="child" id="child" class="form-control" value="" />
                </div>
                <div class="form-group">
                    <label>Жұмыспен қамтылмаған</label>
                    <input type="text" name="unemployed" id="unemployed" class="form-control" value="" />
                </div>
                <div class="form-group">
                    <label>Тұрғылықты мекен-жайы</label>
                    <input type="text" name="address" id="address" class="form-control" value="" />
                </div>
                <div class="form-group">
                    <label class="form-check-label" for="flexCheckDefault">
                        Электронды адрес (Е-mail)
                    </label>
                    <input type="text" name="email" id="email" class="form-control" value="" />
                </div>
                <div class="form-group">
                    <label class="form-check-label" for="flexCheckDefault">
                        Ұялы телефон (нөмірі)
                    </label>
                    <input type="text" name="phone" id="phone" class="form-control" value="" />
                </div>
                <div class="form-group">
                    <label>Жеке кәсібін ашқан жылы, кәсібінің атауы</label>
                    <input type="text" name="business" id="business" class="form-control" value="" />
                </div>

                <div align="right" class="form-group">
                    <input style="color: white" type="submit" name="send" class="btn btn-info" value="Енгізу" />
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

    <script type="text/javascript">
        function Citizen(val){
         var element=document.getElementById('other_citizen');
         if(val=='Басқа')
           element.style.display='block';
         else  
           element.style.display='none';
        }
        function Nation(val){
         var element=document.getElementById('other_nation');
         if(val=='Басқа')
           element.style.display='block';
         else  
           element.style.display='none';
        }
        
    </script> 
@endsection