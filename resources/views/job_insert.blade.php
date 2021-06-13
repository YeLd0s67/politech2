@extends('layouts.app')

@section('content')
    
    <h3 align="center">Жұмыс орындарының кодтары Енгізу</h3>
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
            <form method="POST" action="{{ route('jobs.store') }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <label>Жұмысқа орындары кодтары</label>
                    <input type="text" name="code" id="code" class="form-control" value="" />
                </div>
                
                <div class="form-group">
                    <label>Жұмысқа орындары атаулары</label>
                    <input type="text" name="name" id="name" class="form-control" value="" />
                </div>

                <div class="form-group">
                    <label>Түлек аты</label>
                    <input type="text" name="grad" id="grad" class="form-control" value="" />
                </div>

                <div class="form-group">
                    <label>Тобы</label>
                    <input type="text" name="group" id="group" class="form-control" value="" />
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