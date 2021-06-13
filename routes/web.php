<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostLikeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\http\Controllers\Auth\RegisterController;


Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

Route::post('/logout', 'Auth\LogoutController@store') -> name('logout');
Route::get('/login', 'Auth\LoginController@index') -> name('login');
Route::post('/login', 'Auth\LoginController@store');
Route::get('/register', 'Auth\RegisterController@index') -> name('register');
Route::post('/register', 'Auth\RegisterController@store');

Route::middleware(['raikhan'])->group(function () {

    Route::get('/student', 'StudentController@index') -> name('student');
    Route::get('/student/insert_student', 'StudentController@get_insert_view');
    Route::post('/student/insert_student/send', 'StudentController@insert') -> name('insert.send');

    Route::get('/student/view/{id}', 'StudentController@view') -> name('view.student');
    Route::get('/student/edit/{id}', 'StudentController@view_update') -> name('edit.students');
    Route::post('/student/update', 'StudentController@update') -> name('update.student');
    Route::post('/student/delete', 'StudentController@delete');
    Route::get('/students/student_achives', 'StudentController@get_achive_view') -> name('student.achives');
    Route::get('/students/student_achives/insert', 'StudentController@get_achive_insert_view') -> name('student.achives.insert');
    Route::post('/students/student_achives/store', 'StudentController@achive_store') -> name('student.achives.store');
    Route::post('/achives/delete', 'StudentController@achive_delete');

    Route::get('/subjects', 'SubjectController@view') -> name('subjects');
    Route::get('/subjects/insert', 'SubjectController@insert') -> name('subjects.insert');
    Route::get('/subjects/get_list', 'SubjectController@downloadSubjectslist') -> name('subject.list');
    Route::post('/subjects/store', 'SubjectController@store') -> name('subjects.store');
    Route::post('/subjects/delete', 'SubjectController@delete');

    Route::get('/profs', 'ProfController@view') -> name('profs');
    Route::get('/profs/insert', 'ProfController@insert') -> name('profs.insert');
    Route::post('/profs/store', 'ProfController@store') -> name('profs.store');

    Route::get('/practices', 'PracticeController@view') -> name('practices');
    Route::get('/practices/insert', 'PracticeController@insert') -> name('practices.insert');
    Route::get('/practices/get_list', 'PracticeController@downloadPraticelist') -> name('practice.list');
    Route::post('/practices/store', 'PracticeController@store') -> name('practices.store');
    Route::post('/practices/delete', 'PracticeController@delete');

});


Route::middleware(['moldir'])->prefix('second')->group(function () {

    Route::get('/graduate', 'GraduateController@index') -> name('second.graduate');
    Route::get('/graduate/insert_graduate', 'GraduateController@get_insert_view') -> name('second.insert_graduate');
    Route::post('/graduate/insert_graduate/send', 'GraduateController@insert') -> name('second.insert.send');
    Route::get('/graduate/view/{id}', 'GraduateController@view') -> name('second.view.graduate');
    Route::post('/graduate/delete', 'GraduateController@delete');

    Route::get('/jobs', 'JobController@view') -> name('jobs');
    Route::get('/jobs/insert', 'JobController@insert') -> name('jobs.insert');
    Route::post('/jobs/store', 'JobController@store') -> name('jobs.store');
    Route::post('/jobs/delete', 'JobController@delete');

    Route::get('/bests', 'BestController@index') -> name('bests');
    Route::get('/bests/insert', 'BestController@get_insert_view') -> name('bests.insert');
    Route::post('/bests/store', 'BestController@insert') -> name('bests.store');
    Route::post('/bests/delete', 'BestController@delete');

});