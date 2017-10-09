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

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Route::get('/panel', 'QuizController@RedirectToAppropriatePanel')->middleware('auth');//Redirect to appropriate panel
Route::get('/quiz/{quiz_id}', 'QuizController@TakeQuiz')->middleware('auth');//Take quiz
Route::get('/manage/class/{class_id}', 'QuizController@ViewClass')->middleware('auth');//View class
Route::get('manage/quiz/{quiz_id}', 'QuizController@ManageQuizEvent')->middleware('auth');//Manage quiz
Route::get('manage/subjects', 'QuizController@ManageSubjects')->middleware('auth');//Manage quiz
Route::get('/quiz/results/{quiz_id}', 'QuizController@QuizResults')->middleware('auth');//Sees result of quiz
Route::get('/manage/questionnaire/{qid}', 'QuizController@ManageQuestionnaire')->middleware('auth');
Route::get('/setup', 'QuizController@InitialSetup');

Route::post('/quiz/changestatus', 'QuizController@ChangeQuizEventStatus')->middleware('auth');//Change quiz event status
Route::post('/quiz/submit', 'QuizController@SubmitAnswers')->middleware('auth');//sends student's answers
Route::post('/student/update', 'QuizController@UpdateStudentInfo')->middleware('auth');//Update student profile
Route::post('/new/quiz', 'QuizController@NewQuizEventForm')->middleware('auth');//creates new quiz form
Route::post('/new/quiz/add', 'QuizController@CreateQuizEvent')->middleware('auth');//adds new quiz event
Route::post('/new/class', 'QuizController@CreateClasse')->middleware('auth');//adds new quiz event

Route::get('/changelog', function (){
    return view('changelog');
});

Route::post('/test', function (){
    return $_POST;
});

Route::get('/{any}', function(){
    abort(404);
});
