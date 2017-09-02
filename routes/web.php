<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Route::get('/quiz', 'QuizController@RedirectToAppropriatePanel')->middleware('auth');

Route::get('/quiz/{quiz_id}', 'QuizController@TakeQuiz')->middleware('auth');

Route::post('/new/quiz', 'QuizController@NewQuizEvent')->middleware('auth');

Route::post('/new/quiz/add', 'QuizController@AddNewQuizEvent')->middleware('auth');

Route::post('/startquiz', 'QuizController@StartQuizEvent')->middleware('auth');

Route::get('/changelog', function (){
    return view('changelog');
});

Route::get('/test', function (){
    return "Working!";
});
