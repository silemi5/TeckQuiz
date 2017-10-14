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

Route::get('/', 'QuizController@Home');
Route::get('/old', function (){
    return view('home-old');
});

Auth::routes();

Route::get('/panel', 'QuizController@RedirectToAppropriatePanel')->middleware('auth');//Redirect to appropriate panel

//Route::get('manage/subjects', 'QuizController@ManageSubjects')->middleware('auth');//Manage subject
Route::get('/manage/questionnaire/{qid}', 'QuizController@ManageQuestionnaire')->middleware('auth');
Route::get('/setup', 'QuizController@InitialSetup');

// Route::post('/quiz/submit', 'QuizController@SubmitAnswers')->middleware('auth');//sends student's answers
Route::post('/student/update', 'QuizController@UpdateStudentInfo')->middleware('auth');//Update student profile

Route::resource('quiz', 'QuizEventController'); //Related to Quiz Events
Route::resource('take', 'TakeQuizController'); //Related to taking of quiz

Route::resource('class', 'ClassController',  ['only' => [//Related to class
    'store', 'show', 'destroy'
]]);

Route::resource('question', 'QuestionController', ['only' => [
    'store', 'update',  'destroy',
]]); //Related to taking of quiz

Route::resource('subjects', 'SubjectController');

Route::resource('questionnaire', 'QuestionnaireController', ['only' => [
    'show',
]]);

Route::get('/changelog', function (){
    return view('changelog');
});

Route::post('/test', function (){
    return $_POST;
});

Route::get('/{any}', function(){
    abort(404);
});
