@extends('layouts.app')

@section('content')
    
    <h3 align="center">Оқытушы</h3>
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
            <form method="post" action="{{ route('update.student') }}">
                {{ csrf_field() }}
                @foreach ($student as $s)
                    <div class="form-group">
                        <label>ЖСН</label>
                        <input type="text" name="iin" id="iin" class="form-control" value="{{ $s->iin }}" />
                    </div>
                    <div class="form-group">
                        <label>Тегі</label>
                        <input type="text" name="surename" id="surname" class="form-control" value="{{ $s->last_name }}" />
                    </div>
                    <div class="form-group">
                        <label>Аты</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $s->first_name }}" />
                    </div>
                    <div class="form-group">
                        <label>Әкесінің аты</label>
                        <input type="text" name="middle" id="middle_name" class="form-control" value="{{ $s->middle_name }}" />
                    </div>
                    <div class="form-group">
                        <label>Туған күні</label>
                        <input type="date" name="birthday" id="birthday" class="form-control" value="{{ $s->date_birth }}" />
                    </div>
                    <div class="form-group">
                        <label>Жынысы</label>
                        <select class="form-select" aria-label="Default select example" name="gender" id="gender">
                            @if ($s->gender == 'Еркек')
                                <option value="Еркек" selected>Еркек</option>
                                <option value="Әйел">Әйел</option>
                            @else
                                <option value="Еркек">Еркек</option>
                                <option value="Әйел" selected>Әйел</option>    
                            @endif
                        </select>                
                    </div>
                    <div class="form-group">
                        <label>Азаматтығы</label>
                        <select class="form-select" aria-label="Default select example" name="citizen" onchange='Citizen(this.value);'>
                            @if ($s->citizen == 'Қазақстан')
                                <option value="Қазақстан" selected>Қазақстан</option>
                                <option value="Басқа">Басқа</option>
                            @else
                                <option value="{{ $s->other_citizen }}">{{ $s->other_citizen }}</option>
                                <option value="Қазақстан">Қазақстан</option>
                                <option value="Басқа">Басқа</option>
                            @endif 
                        </select>
                        <input type="text" name="other_citizen" class="form-control" value="" id="other_citizen" style='display:none;' />
                    </div>
                    <div class="form-group">
                        <label>Ұлты</label>
                        <select class="form-select" aria-label="Default select example" name="nation" onchange='Nation(this.value);'> 
                            @if ($s->nation == 'Қазақ')
                            <option value="Қазақ" selected>Қазақстан</option>
                            <option value="Басқа">Басқа</option>
                            @else
                                <option value="{{ $s->other_nation }}">{{ $s->other_nation }}</option>
                                <option value="Қазақстан">Қазақстан</option>
                                <option value="Басқа">Басқа</option>
                            @endif 
                        </select>
                        <input type="text" name="other_nation" class="form-control" value="" id="other_nation" style='display:none;' />
                    </div>
                    <div class="form-group">
                        <label>Мамандығы</label>
                        <select class="form-select" aria-label="Default select example" name="responsibility" id="responsibility">
                            @if ($s->current_status == 'Осы ұйымда жұмыс істейді')
                                <option value="Осы ұйымда жұмыс істейді" selected>Осы ұйымда жұмыс істейді</option>
                                <option value="Декреттік демалыста">Декреттік демалыста</option>
                                <option value="Ауру себебінен демалыста">Ауру себебінен демалыста</option>
                                <option value="Әскерде">Әскерде</option>
                                <option value="Еңбек ақысы сақталмайтын демалыста">Еңбек ақысы сақталмайтын демалыста</option>
                            @elseif ($s->current_status == 'Декреттік демалыста')
                                <option value="Осы ұйымда жұмыс істейді">Осы ұйымда жұмыс істейді</option>
                                <option value="Декреттік демалыста" selected>Декреттік демалыста</option>
                                <option value="Ауру себебінен демалыста">Ауру себебінен демалыста</option>
                                <option value="Әскерде">Әскерде</option>
                                <option value="Еңбек ақысы сақталмайтын демалыста">Еңбек ақысы сақталмайтын демалыста</option>
                            @elseif ($s->current_status == 'Ауру себебінен демалыста')
                                <option value="Осы ұйымда жұмыс істейді">Осы ұйымда жұмыс істейді</option>
                                <option value="Декреттік демалыста">Декреттік демалыста</option>
                                <option value="Ауру себебінен демалыста" selected>Ауру себебінен демалыста</option>
                                <option value="Әскерде">Әскерде</option>
                                <option value="Еңбек ақысы сақталмайтын демалыста">Еңбек ақысы сақталмайтын демалыста</option>
                            @elseif ($s->current_status == 'Әскерде')
                                <option value="Осы ұйымда жұмыс істейді">Осы ұйымда жұмыс істейді</option>
                                <option value="Декреттік демалыста">Декреттік демалыста</option>
                                <option value="Ауру себебінен демалыста">Ауру себебінен демалыста</option>
                                <option value="Әскерде" selected>Әскерде</option>
                                <option value="Еңбек ақысы сақталмайтын демалыста">Еңбек ақысы сақталмайтын демалыста</option>
                            @elseif ($s->current_status == 'Еңбек ақысы сақталмайтын демалыста')
                                <option value="Осы ұйымда жұмыс істейді">Осы ұйымда жұмыс істейді</option>
                                <option value="Декреттік демалыста">Декреттік демалыста</option>
                                <option value="Ауру себебінен демалыста">Ауру себебінен демалыста</option>
                                <option value="Әскерде">Әскерде</option>
                                <option value="Еңбек ақысы сақталмайтын демалыста" selected>Еңбек ақысы сақталмайтын демалыста</option>
                            @endif 
                        </select>   
                    </div>
                    <div class="form-group">
                        <label>Лауазым</label>
                        <select class="form-select" aria-label="Default select example" name="rank" id="rank">
                            @if ($s->rank == 'Әлеуметтік педагог')
                                <option value="Әлеуметтік педагог" selected>Әлеуметтік педагог</option>
                                <option value="Аға шебер">Аға шебер</option>
                                <option value="Жалпы білім беретін пәндер бойынша оқытушы">Жалпы білім беретін пәндер бойынша оқытушы</option>
                                <option value="Өндірістік оқыту шебері">Өндірістік оқыту шебері</option>
                                <option value="Жалпы кәсіптік және арнайы пәндер бойынша оқытушы">Жалпы кәсіптік және арнайы пәндер бойынша оқытушы</option>
                            @elseif ($s->rank == 'Аға шебер')
                                <option value="Әлеуметтік педагог">Әлеуметтік педагог</option>
                                <option value="Аға шебер" selected>Аға шебер</option>
                                <option value="Жалпы білім беретін пәндер бойынша оқытушы">Жалпы білім беретін пәндер бойынша оқытушы</option>
                                <option value="Өндірістік оқыту шебері">Өндірістік оқыту шебері</option>
                                <option value="Жалпы кәсіптік және арнайы пәндер бойынша оқытушы">Жалпы кәсіптік және арнайы пәндер бойынша оқытушы</option>
                            @elseif ($s->rank == 'Жалпы білім беретін пәндер бойынша оқытушы')
                                <option value="Әлеуметтік педагог">Әлеуметтік педагог</option>
                                <option value="Аға шебер">Аға шебер</option>
                                <option value="Жалпы білім беретін пәндер бойынша оқытушы" selected>Жалпы білім беретін пәндер бойынша оқытушы</option>
                                <option value="Өндірістік оқыту шебері">Өндірістік оқыту шебері</option>
                                <option value="Жалпы кәсіптік және арнайы пәндер бойынша оқытушы">Жалпы кәсіптік және арнайы пәндер бойынша оқытушы</option>
                            @elseif ($s->rank == 'Өндірістік оқыту шебері')
                                <option value="Әлеуметтік педагог">Әлеуметтік педагог</option>
                                <option value="Аға шебер">Аға шебер</option>
                                <option value="Жалпы білім беретін пәндер бойынша оқытушы">Жалпы білім беретін пәндер бойынша оқытушы</option>
                                <option value="Өндірістік оқыту шебері" selected>Өндірістік оқыту шебері</option>
                                <option value="Жалпы кәсіптік және арнайы пәндер бойынша оқытушы">Жалпы кәсіптік және арнайы пәндер бойынша оқытушы</option>
                            @elseif ($s->rank == 'Жалпы кәсіптік және арнайы пәндер бойынша оқытушы')
                                <option value="Әлеуметтік педагог">Әлеуметтік педагог</option>
                                <option value="Аға шебер">Аға шебер</option>
                                <option value="Жалпы білім беретін пәндер бойынша оқытушы">Жалпы білім беретін пәндер бойынша оқытушы</option>
                                <option value="Өндірістік оқыту шебері">Өндірістік оқыту шебері</option>
                                <option value="Жалпы кәсіптік және арнайы пәндер бойынша оқытушы" selected>Жалпы кәсіптік және арнайы пәндер бойынша оқытушы</option>
                            @endif 
                        </select> 
                    </div>
                    <div class="form-group">
                        <label>Қызметкер</label>
                        <select class="form-select" aria-label="Default select example" name="work_type" id="work_type">
                            @if ($s->type_of_busy == 'Штаттық')
                                <option value="Штаттық" selected>Штаттық</option>
                                <option value="Қоса атқарушы">Қоса атқарушы</option>
                            @else
                                <option value="Штаттық">Штаттық</option>
                                <option value="Қоса атқарушы" selected>Қоса атқарушы</option>
                            @endif 
                            
                        </select> 
                    </div>
                    <div class="form-group">
                        <label>Академиялық, ғылыми дәреже</label>
                        <select class="form-select" aria-label="Default select example" name="academic_degree" id="academic_degree">
                            @if ($s->academic_degree == 'Дәрежесі жоқ')
                                <option value="Дәрежесі жоқ" selected>Дәрежесі жоқ</option>
                                <option value="Магистр">Магистр</option>
                                <option value="Ғылым кандидаты">Ғылым кандидаты</option>
                                <option value="Ғылымдар докторы">Ғылымдар докторы</option>
                                <option value="PhD докторы">PhD докторы</option>
                                <option value="Бағдар бойынша доктор">Бағдар бойынша доктор</option>
                            @elseif ($s->academic_degree == 'Магистр')
                                <option value="Дәрежесі жоқ">Дәрежесі жоқ</option>
                                <option value="Магистр" selected>Магистр</option>
                                <option value="Ғылым кандидаты">Ғылым кандидаты</option>
                                <option value="Ғылымдар докторы">Ғылымдар докторы</option>
                                <option value="PhD докторы">PhD докторы</option>
                                <option value="Бағдар бойынша доктор">Бағдар бойынша доктор</option>
                            @elseif ($s->academic_degree == 'Ғылым кандидаты')
                                <option value="Дәрежесі жоқ">Дәрежесі жоқ</option>
                                <option value="Магистр">Магистр</option>
                                <option value="Ғылым кандидаты" selected>Ғылым кандидаты</option>
                                <option value="Ғылымдар докторы">Ғылымдар докторы</option>
                                <option value="PhD докторы">PhD докторы</option>
                                <option value="Бағдар бойынша доктор">Бағдар бойынша доктор</option>
                            @elseif ($s->academic_degree == 'Ғылымдар докторы')
                                <option value="Дәрежесі жоқ">Дәрежесі жоқ</option>
                                <option value="Магистр">Магистр</option>
                                <option value="Ғылым кандидаты">Ғылым кандидаты</option>
                                <option value="Ғылымдар докторы" selected>Ғылымдар докторы</option>
                                <option value="PhD докторы">PhD докторы</option>
                                <option value="Бағдар бойынша доктор">Бағдар бойынша доктор</option>
                            @elseif ($s->academic_degree == 'PhD докторы')
                                <option value="Дәрежесі жоқ">Дәрежесі жоқ</option>
                                <option value="Магистр">Магистр</option>
                                <option value="Ғылым кандидаты">Ғылым кандидаты</option>
                                <option value="Ғылымдар докторы">Ғылымдар докторы</option>
                                <option value="PhD докторы" selected>PhD докторы</option>
                                <option value="Бағдар бойынша доктор">Бағдар бойынша доктор</option>
                            @elseif ($s->academic_degree == 'Бағдар бойынша доктор')
                                <option value="Дәрежесі жоқ">Дәрежесі жоқ</option>
                                <option value="Магистр">Магистр</option>
                                <option value="Ғылым кандидаты">Ғылым кандидаты</option>
                                <option value="Ғылымдар докторы">Ғылымдар докторы</option>
                                <option value="PhD докторы">PhD докторы</option>
                                <option value="Бағдар бойынша доктор" selected>Бағдар бойынша доктор</option>
                            @endif 
                        </select> 
                    </div>
                    <div class="form-group">
                        <label>Білімі</label>
                        <select class="form-select" aria-label="Default select example" name="educ" id="educ">
                            @if ($s->degree == 'Жоғары (кәсіптік)')
                                <option value="Жоғары (кәсіптік)" selected>Жоғары (кәсіптік)</option>
                                <option value="Жоғары (педагогикалық)">Жоғары (педагогикалық)</option>
                                <option value="Жоғары (мектепке дейінгі)">Жоғары (мектепке дейінгі)</option>
                                <option value="Техникалық және кәсіптік білім">Техникалық және кәсіптік білім</option>
                                <option value="Техникалық және кәсіптік (педагогикалық)">Техникалық және кәсіптік (педагогикалық)</option>
                                <option value="Техникалық және кәсіптік (мектепке дейінгі)">Техникалық және кәсіптік (мектепке дейінгі)</option>
                                <option value="Жалпы орта білім">Жалпы орта білім</option>
                            @elseif ($s->degree == 'Жоғары (педагогикалық)')
                                <option value="Жоғары (кәсіптік)">Жоғары (кәсіптік)</option>
                                <option value="Жоғары (педагогикалық)" selected>Жоғары (педагогикалық)</option>
                                <option value="Жоғары (мектепке дейінгі)">Жоғары (мектепке дейінгі)</option>
                                <option value="Техникалық және кәсіптік білім">Техникалық және кәсіптік білім</option>
                                <option value="Техникалық және кәсіптік (педагогикалық)">Техникалық және кәсіптік (педагогикалық)</option>
                                <option value="Техникалық және кәсіптік (мектепке дейінгі)">Техникалық және кәсіптік (мектепке дейінгі)</option>
                                <option value="Жалпы орта білім">Жалпы орта білім</option>
                            @elseif ($s->degree == 'Жоғары (мектепке дейінгі)')
                                <option value="Жоғары (кәсіптік)">Жоғары (кәсіптік)</option>
                                <option value="Жоғары (педагогикалық)">Жоғары (педагогикалық)</option>
                                <option value="Жоғары (мектепке дейінгі)" selected>Жоғары (мектепке дейінгі)</option>
                                <option value="Техникалық және кәсіптік білім">Техникалық және кәсіптік білім</option>
                                <option value="Техникалық және кәсіптік (педагогикалық)">Техникалық және кәсіптік (педагогикалық)</option>
                                <option value="Техникалық және кәсіптік (мектепке дейінгі)">Техникалық және кәсіптік (мектепке дейінгі)</option>
                                <option value="Жалпы орта білім">Жалпы орта білім</option>
                            @elseif ($s->degree == 'Техникалық және кәсіптік білім')
                                <option value="Жоғары (кәсіптік)">Жоғары (кәсіптік)</option>
                                <option value="Жоғары (педагогикалық)">Жоғары (педагогикалық)</option>
                                <option value="Жоғары (мектепке дейінгі)">Жоғары (мектепке дейінгі)</option>
                                <option value="Техникалық және кәсіптік білім" selected>Техникалық және кәсіптік білім</option>
                                <option value="Техникалық және кәсіптік (педагогикалық)">Техникалық және кәсіптік (педагогикалық)</option>
                                <option value="Техникалық және кәсіптік (мектепке дейінгі)">Техникалық және кәсіптік (мектепке дейінгі)</option>
                                <option value="Жалпы орта білім">Жалпы орта білім</option>
                            @elseif ($s->degree == 'Техникалық және кәсіптік (педагогикалық)')
                                <option value="Жоғары (кәсіптік)">Жоғары (кәсіптік)</option>
                                <option value="Жоғары (педагогикалық)">Жоғары (педагогикалық)</option>
                                <option value="Жоғары (мектепке дейінгі)">Жоғары (мектепке дейінгі)</option>
                                <option value="Техникалық және кәсіптік білім">Техникалық және кәсіптік білім</option>
                                <option value="Техникалық және кәсіптік (педагогикалық)" selected>Техникалық және кәсіптік (педагогикалық)</option>
                                <option value="Техникалық және кәсіптік (мектепке дейінгі)">Техникалық және кәсіптік (мектепке дейінгі)</option>
                                <option value="Жалпы орта білім">Жалпы орта білім</option>
                            @elseif ($s->degree == 'Техникалық және кәсіптік (мектепке дейінгі)')
                                <option value="Жоғары (кәсіптік)">Жоғары (кәсіптік)</option>
                                <option value="Жоғары (педагогикалық)">Жоғары (педагогикалық)</option>
                                <option value="Жоғары (мектепке дейінгі)">Жоғары (мектепке дейінгі)</option>
                                <option value="Техникалық және кәсіптік білім">Техникалық және кәсіптік білім</option>
                                <option value="Техникалық және кәсіптік (педагогикалық)">Техникалық және кәсіптік (педагогикалық)</option>
                                <option value="Техникалық және кәсіптік (мектепке дейінгі)" selected>Техникалық және кәсіптік (мектепке дейінгі)</option>
                                <option value="Жалпы орта білім">Жалпы орта білім</option>
                            @elseif ($s->degree == 'Жалпы орта білім')
                                <option value="Жоғары (кәсіптік)">Жоғары (кәсіптік)</option>
                                <option value="Жоғары (педагогикалық)">Жоғары (педагогикалық)</option>
                                <option value="Жоғары (мектепке дейінгі)">Жоғары (мектепке дейінгі)</option>
                                <option value="Техникалық және кәсіптік білім">Техникалық және кәсіптік білім</option>
                                <option value="Техникалық және кәсіптік (педагогикалық)">Техникалық және кәсіптік (педагогикалық)</option>
                                <option value="Техникалық және кәсіптік (мектепке дейінгі)">Техникалық және кәсіптік (мектепке дейінгі)</option>
                                <option value="Жалпы орта білім" selected>Жалпы орта білім</option>
                            @endif 
                        </select> 
                    </div>
                    <div class="form-group">
                        <label class="form-check-label" for="flexCheckDefault">
                            ЖОО-да оқиды (в текущий период)
                        </label>
                        <select class="form-select" aria-label="Default select example" name="study" id="educ">
                            @if ($s->studying == 'Иә')
                                <option value="Иә" selected>Иә</option>
                                <option value="Жоқ">Жоқ</option>
                            @else
                                <option value="Иә">Иә</option>
                                <option value="Жоқ" selected>Жоқ</option>
                            @endif 
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Жұмысқа қабылдау кезіндегі жалпы еңбек өтілі</label>
                        <input type="text" name="pre_work_history" id="pre_work_history" class="form-control" value="{{ $s->pre_work_history }}" />
                    </div>
                    <div class="form-group">
                        <label>Ағымдағы мерзімдегі жалпы еңбек өтілі</label>
                        <input type="text" name="curr_overall_history" id="curr_overall_history" class="form-control" value="{{ $s->curr_overall_work_history }}" />
                    </div>
                    <div class="form-group">
                        <label>Ағымдағы мерзімдегі педагогикалық еңбек өтілі</label>
                        <input type="text" name="curr_ped_history" id="curr_ped_history" class="form-control" value="{{ $s->curr_ped_work_history }}" />
                    </div>
                    <div class="form-group">
                        <label>Осы ұйымдағы жалпы еңбек өтілі</label>
                        <input type="text" name="overall_work_history" id="overall_work_history" class="form-control" value="{{ $s->company_work_history }}" />
                    </div>
                    <div class="form-group">
                        <label>Тұрғылықты мекен-жайы</label>
                        <input type="text" name="address" id="address" class="form-control" value="{{ $s->address }}" />
                    </div>
                    <div class="form-group">
                        <label>Электронды адрес (Е-mail)</label>
                        <input type="text" name="email" id="email" class="form-control" value="{{ $s->email }}" />
                    </div>
                    <div class="form-group">
                        <label>Ұялы телефон (нөмірі)</label>
                        <input type="text" name="phone" id="phone" class="form-control" value="{{ $s->phone }}" />
                    </div>
                    <div class="form-group">
                        <label>Санаты</label>
                        <select class="form-select" aria-label="Default select example" name="sanat" id="sanat">
                            @if ($s->sanat == 'Cанаты жоқ')
                                <option value="Cанаты жоқ" selected>Cанаты жоқ</option>
                                <option value="Екінші санатты">Екінші санатты</option>
                                <option value="Бірінші санатты">Бірінші санатты</option>
                                <option value="Жоғары санатты">Жоғары санатты</option>
                                <option value="Педагог">Педагог</option>
                                <option value="Педагог - модератор">Педагог - модератор</option>
                                <option value="Педагог – сарапшы">Педагог – сарапшы</option>
                                <option value="Педагог – зерттеуші">Педагог – зерттеуші</option>
                                <option value="Педагог – шебер">Педагог – шебер</option>
                            @elseif ($s->sanat == 'Екінші санатты')
                                <option value="Cанаты жоқ">Cанаты жоқ</option>
                                <option value="Екінші санатты" selected>Екінші санатты</option>
                                <option value="Бірінші санатты">Бірінші санатты</option>
                                <option value="Жоғары санатты">Жоғары санатты</option>
                                <option value="Педагог">Педагог</option>
                                <option value="Педагог - модератор">Педагог - модератор</option>
                                <option value="Педагог – сарапшы">Педагог – сарапшы</option>
                                <option value="Педагог – зерттеуші">Педагог – зерттеуші</option>
                                <option value="Педагог – шебер">Педагог – шебер</option>
                            @elseif ($s->sanat == 'Бірінші санатты')
                                <option value="Cанаты жоқ">Cанаты жоқ</option>
                                <option value="Екінші санатты">Екінші санатты</option>
                                <option value="Бірінші санатты" selected>Бірінші санатты</option>
                                <option value="Жоғары санатты">Жоғары санатты</option>
                                <option value="Педагог">Педагог</option>
                                <option value="Педагог - модератор">Педагог - модератор</option>
                                <option value="Педагог – сарапшы">Педагог – сарапшы</option>
                                <option value="Педагог – зерттеуші">Педагог – зерттеуші</option>
                                <option value="Педагог – шебер">Педагог – шебер</option>
                            @elseif ($s->sanat == 'Жоғары санатты')
                                <option value="Cанаты жоқ">Cанаты жоқ</option>
                                <option value="Екінші санатты">Екінші санатты</option>
                                <option value="Бірінші санатты">Бірінші санатты</option>
                                <option value="Жоғары санатты" selected>Жоғары санатты</option>
                                <option value="Педагог">Педагог</option>
                                <option value="Педагог - модератор">Педагог - модератор</option>
                                <option value="Педагог – сарапшы">Педагог – сарапшы</option>
                                <option value="Педагог – зерттеуші">Педагог – зерттеуші</option>
                                <option value="Педагог – шебер">Педагог – шебер</option>
                            @elseif ($s->sanat == 'Педагог')
                                <option value="Cанаты жоқ">Cанаты жоқ</option>
                                <option value="Екінші санатты">Екінші санатты</option>
                                <option value="Бірінші санатты">Бірінші санатты</option>
                                <option value="Жоғары санатты">Жоғары санатты</option>
                                <option value="Педагог" selected>Педагог</option>
                                <option value="Педагог - модератор">Педагог - модератор</option>
                                <option value="Педагог – сарапшы">Педагог – сарапшы</option>
                                <option value="Педагог – зерттеуші">Педагог – зерттеуші</option>
                                <option value="Педагог – шебер">Педагог – шебер</option>
                            @elseif ($s->sanat == 'Педагог - модератор')
                                <option value="Cанаты жоқ">Cанаты жоқ</option>
                                <option value="Екінші санатты">Екінші санатты</option>
                                <option value="Бірінші санатты">Бірінші санатты</option>
                                <option value="Жоғары санатты">Жоғары санатты</option>
                                <option value="Педагог">Педагог</option>
                                <option value="Педагог - модератор" selected>Педагог - модератор</option>
                                <option value="Педагог – сарапшы">Педагог – сарапшы</option>
                                <option value="Педагог – зерттеуші">Педагог – зерттеуші</option>
                                <option value="Педагог – шебер">Педагог – шебер</option>
                            @elseif ($s->sanat == 'Педагог – сарапшы')
                                <option value="Cанаты жоқ">Cанаты жоқ</option>
                                <option value="Екінші санатты">Екінші санатты</option>
                                <option value="Бірінші санатты">Бірінші санатты</option>
                                <option value="Жоғары санатты">Жоғары санатты</option>
                                <option value="Педагог">Педагог</option>
                                <option value="Педагог - модератор">Педагог - модератор</option>
                                <option value="Педагог – сарапшы" selected>Педагог – сарапшы</option>
                                <option value="Педагог – зерттеуші">Педагог – зерттеуші</option>
                                <option value="Педагог – шебер">Педагог – шебер</option>
                            @elseif ($s->sanat == 'Педагог – зерттеуші')
                                <option value="Cанаты жоқ">Cанаты жоқ</option>
                                <option value="Екінші санатты">Екінші санатты</option>
                                <option value="Бірінші санатты">Бірінші санатты</option>
                                <option value="Жоғары санатты">Жоғары санатты</option>
                                <option value="Педагог">Педагог</option>
                                <option value="Педагог - модератор">Педагог - модератор</option>
                                <option value="Педагог – сарапшы">Педагог – сарапшы</option>
                                <option value="Педагог – зерттеуші" selected>Педагог – зерттеуші</option>
                                <option value="Педагог – шебер">Педагог – шебер</option>
                            @elseif ($s->sanat == 'Педагог – шебер')
                                <option value="Cанаты жоқ">Cанаты жоқ</option>
                                <option value="Екінші санатты">Екінші санатты</option>
                                <option value="Бірінші санатты">Бірінші санатты</option>
                                <option value="Жоғары санатты">Жоғары санатты</option>
                                <option value="Педагог">Педагог</option>
                                <option value="Педагог - модератор">Педагог - модератор</option>
                                <option value="Педагог – сарапшы">Педагог – сарапшы</option>
                                <option value="Педагог – зерттеуші" >Педагог – зерттеуші</option>
                                <option value="Педагог – шебер" selected>Педагог – шебер</option>
                            @endif 

                        </select>  
                    </div>
                    <div class="form-group">
                        <label>Оқыту тілі</label>
                        <select class="form-select" aria-label="Default select example" name="edu_lang" id="edu_lang">
                            @if ($s->lang == 'Қазақ')
                                <option value="Қазақ" selected>Қазақ</option>
                                <option value="Орыс">Орыс</option>
                                <option value="Ағылшын">Ағылшын</option>
                            @elseif ($s->lang == 'Орыс')
                                <option value="Қазақ">Қазақ</option>
                                <option value="Орыс" selected>Орыс</option>
                                <option value="Ағылшын">Ағылшын</option>
                            @else
                                <option value="Қазақ">Қазақ</option>
                                <option value="Орыс">Орыс</option>
                                <option value="Ағылшын" selected>Ағылшын</option>
                            @endif 

                        </select>                  
                    </div>
                    <div class="form-group">
                        <label>Ағылшын тілін білу деңгейі</label>
                        <select class="form-select" aria-label="Default select example" name="english" id="english">
                            @if ($s->english_level == 'Beginner')
                                <option value="Beginner" selected>Beginner</option>
                                <option value="Elementary">Elementary</option>
                                <option value="Pre-Intermediate">Pre-Intermediate</option>
                                <option value="Intermediate">Intermediate</option>
                                <option value="Upper – Intermediate">Upper – Intermediate</option>
                                <option value="Advanced">Advanced</option>
                                <option value="Profciency">Profciency</option>
                                <option value="IELTS">IELTS</option>
                                <option value="TOEFL">TOEFL</option>
                                <option value="Ағылшын тілін білмейді">Ағылшын тілін білмейді</option>
                            @elseif ($s->english_level == 'Elementary')
                                <option value="Beginner">Beginner</option>
                                <option value="Elementary" selected>Elementary</option>
                                <option value="Pre-Intermediate">Pre-Intermediate</option>
                                <option value="Intermediate">Intermediate</option>
                                <option value="Upper – Intermediate">Upper – Intermediate</option>
                                <option value="Advanced">Advanced</option>
                                <option value="Profciency">Profciency</option>
                                <option value="IELTS">IELTS</option>
                                <option value="TOEFL">TOEFL</option>
                                <option value="Ағылшын тілін білмейді">Ағылшын тілін білмейді</option>
                            @elseif ($s->english_level == 'Pre-Intermediate')
                                <option value="Beginner">Beginner</option>
                                <option value="Elementary">Elementary</option>
                                <option value="Pre-Intermediate" selected>Pre-Intermediate</option>
                                <option value="Intermediate">Intermediate</option>
                                <option value="Upper – Intermediate">Upper – Intermediate</option>
                                <option value="Advanced">Advanced</option>
                                <option value="Profciency">Profciency</option>
                                <option value="IELTS">IELTS</option>
                                <option value="TOEFL">TOEFL</option>
                                <option value="Ағылшын тілін білмейді">Ағылшын тілін білмейді</option>
                            @elseif ($s->english_level == 'Intermediate')
                                <option value="Beginner">Beginner</option>
                                <option value="Elementary">Elementary</option>
                                <option value="Pre-Intermediate">Pre-Intermediate</option>
                                <option value="Intermediate" selected>Intermediate</option>
                                <option value="Upper – Intermediate">Upper – Intermediate</option>
                                <option value="Advanced">Advanced</option>
                                <option value="Profciency">Profciency</option>
                                <option value="IELTS">IELTS</option>
                                <option value="TOEFL">TOEFL</option>
                                <option value="Ағылшын тілін білмейді">Ағылшын тілін білмейді</option>
                            @elseif ($s->english_level == 'Upper – Intermediate')
                                <option value="Beginner">Beginner</option>
                                <option value="Elementary">Elementary</option>
                                <option value="Pre-Intermediate">Pre-Intermediate</option>
                                <option value="Intermediate">Intermediate</option>
                                <option value="Upper – Intermediate" selected>Upper – Intermediate</option>
                                <option value="Advanced">Advanced</option>
                                <option value="Profciency">Profciency</option>
                                <option value="IELTS">IELTS</option>
                                <option value="TOEFL">TOEFL</option>
                                <option value="Ағылшын тілін білмейді">Ағылшын тілін білмейді</option>
                            @elseif ($s->english_level == 'Advanced')
                                <option value="Beginner">Beginner</option>
                                <option value="Elementary">Elementary</option>
                                <option value="Pre-Intermediate">Pre-Intermediate</option>
                                <option value="Intermediate">Intermediate</option>
                                <option value="Upper – Intermediate">Upper – Intermediate</option>
                                <option value="Advanced" selected>Advanced</option>
                                <option value="Profciency">Profciency</option>
                                <option value="IELTS">IELTS</option>
                                <option value="TOEFL">TOEFL</option>
                                <option value="Ағылшын тілін білмейді">Ағылшын тілін білмейді</option>
                            @elseif ($s->english_level == 'Profciency')
                                <option value="Beginner">Beginner</option>
                                <option value="Elementary">Elementary</option>
                                <option value="Pre-Intermediate">Pre-Intermediate</option>
                                <option value="Intermediate">Intermediate</option>
                                <option value="Upper – Intermediate">Upper – Intermediate</option>
                                <option value="Advanced">Advanced</option>
                                <option value="Profciency" selected>Profciency</option>
                                <option value="IELTS">IELTS</option>
                                <option value="TOEFL">TOEFL</option>
                                <option value="Ағылшын тілін білмейді">Ағылшын тілін білмейді</option>
                            @elseif ($s->english_level == 'IELTS')
                                <option value="Beginner">Beginner</option>
                                <option value="Elementary">Elementary</option>
                                <option value="Pre-Intermediate">Pre-Intermediate</option>
                                <option value="Intermediate">Intermediate</option>
                                <option value="Upper – Intermediate">Upper – Intermediate</option>
                                <option value="Advanced">Advanced</option>
                                <option value="Profciency">Profciency</option>
                                <option value="IELTS" selected>IELTS</option>
                                <option value="TOEFL">TOEFL</option>
                                <option value="Ағылшын тілін білмейді">Ағылшын тілін білмейді</option>
                            @elseif ($s->english_level == 'TOEFL')
                                <option value="Beginner">Beginner</option>
                                <option value="Elementary">Elementary</option>
                                <option value="Pre-Intermediate">Pre-Intermediate</option>
                                <option value="Intermediate">Intermediate</option>
                                <option value="Upper – Intermediate">Upper – Intermediate</option>
                                <option value="Advanced">Advanced</option>
                                <option value="Profciency">Profciency</option>
                                <option value="IELTS">IELTS</option>
                                <option value="TOEFL" selected>TOEFL</option>
                                <option value="Ағылшын тілін білмейді">Ағылшын тілін білмейді</option>
                            @elseif ($s->english_level == 'Ағылшын тілін білмейді')
                                <option value="Beginner">Beginner</option>
                                <option value="Elementary">Elementary</option>
                                <option value="Pre-Intermediate">Pre-Intermediate</option>
                                <option value="Intermediate">Intermediate</option>
                                <option value="Upper – Intermediate">Upper – Intermediate</option>
                                <option value="Advanced">Advanced</option>
                                <option value="Profciency">Profciency</option>
                                <option value="IELTS">IELTS</option>
                                <option value="TOEFL">TOEFL</option>
                                <option value="Ағылшын тілін білмейді" selected>Ағылшын тілін білмейді</option>
                            @endif 

                        </select> 
                    </div>   
                @endforeach
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