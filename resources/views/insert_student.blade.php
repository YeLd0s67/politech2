@extends('layouts.app')

@section('content')
    
    <h3 align="center">Студенттер</h3>
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
            <form method="post" action="{{ route('insert.send') }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <label>ЖСН</label>
                    <input type="text" name="iin" id="iin" class="form-control" value="" />
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
                    <label>Азаматтығы</label>
                    <select class="form-select" aria-label="Default select example" name="citizen" onchange='Citizen(this.value);'> 
                        <option value="Қазақстан">Қазақстан</option>
                        <option value="Басқа">Басқа</option>
                    </select>
                    <input type="text" name="other_citizen" class="form-control" value="" id="other_citizen" style='display:none;' />
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
                    <label>Мамандығы</label>
                    <input type="text" name="spec" id="spec" class="form-control" value="" />
                </div>
                <div class="form-group">
                    <label>Тобы</label>
                    <input type="text" name="group" id="group" class="form-control" value="" />
                </div>
                <div class="form-group">
                    <label>Жеке куәлік</label>
                    <input type="text" name="passport" id="passport" class="form-control" value="" />
                </div>
                <div class="form-group">
                    <label>Берген мекеме</label>
                    <input type="text" name="passport_given" id="passport_given" class="form-control" value="" />
                </div>
                <div class="form-group">
                    <label>Мекен-жайы: тіркелген және таразда тұратын мекен жайы</label>
                    <input type="text" name="address" id="address" class="form-control" value="" />
                </div>
                <div class="form-group">
                    <label class="form-check-label" for="flexCheckDefault">
                        Телефон: Ата анасының және студенттің
                    </label>
                    <input type="text" name="phone" id="phone" class="form-control" value="" />
                </div>
                <div class="form-group">
                    <label>Келген мектебі</label>
                    <input type="text" name="school" id="school" class="form-control" value="" />
                </div>
                <div class="form-group">
                    <label>Оқу тілі</label>
                    <input type="text" name="lang" id="lang" class="form-control" value="" />
                </div>
                <div class="form-group">
                    <label>Отбасындағы бала  саны</label>
                    <input type="text" name="family_children" id="family_children" class="form-control" value="" />
                </div>
                <div class="form-group">
                    <label>Қатысатын үйірмелері</label>
                    <input type="text" name="clubs" id="clubs" class="form-control" value="" />
                </div>
                <div class="form-group">
                    <label>Ата-анасының толық аты-жөні: Әкесінің және анасының</label>
                    <input type="text" name="parent_names" id="parent_names" class="form-control" value="" />
                </div>
                <div class="form-group">
                    <label>Жұмыс орны, қандай: Әкесінің және анасының</label>
                    <input type="text" name="work" id="work" class="form-control" value="" />
                </div>
                <div class="form-group">
                    <label>Әкесінің ж/е анасының жеке куәлігі</label>
                    <input type="text" name="parent_passport" id="parent_passport" class="form-control" value="" />
                </div>
                <div class="form-group">
                    <label>Әкесінің ж/е анасының жеке ИИН</label>
                    <input type="text" name="parent_iin" id="parent_iin" class="form-control" value="" />
                </div>
                <div class="form-group">
                    <label>Студенттің әлеуметтік статусы</label>
                    <select class="form-select" aria-label="Default select example" name="status" id="status">
                        <option value="Толық отбасынан шыққан">Толық отбасынан шыққан</option>
                        <option value="Толық емес отбасынан шыққан">Толық емес отбасынан шыққан</option>
                        <option value="Жетім">Жетім</option>
                        <option value="Жартылай жетім">Жартылай жетім</option>
                        <option value="Инвалид">Инвалид</option>
                    </select>  
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