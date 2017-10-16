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
Auth::routes();

Route::get('/', 'QuizController@Home');

Route::get('/old', function (){return view('home-old');});

Route::get('/panel', 'QuizController@RedirectToAppropriatePanel');//Redirect to appropriate panel

Route::post('/student/update', 'QuizController@UpdateStudentInfo');//Update student profile, deprecated

Route::resource('quiz', 'QuizEventController', ['only' => [//Quiz Events
    'create', 'store', 'show', 'update'
]]); 

Route::resource('take', 'TakeQuizController', ['only' => [//Related to taking of quiz
    'store', 'show'
]]); 

Route::resource('class', 'ClassController',  ['only' => [//Class
    'store', 'show', 'destroy'
]]);

Route::resource('question', 'QuestionController', ['only' => [//Question
    'store', 'update',  'destroy',
]]); 

Route::resource('subjects', 'SubjectController', ['only' => [//Subject
    'index', 'store', 'update', 'destroy'
]]);

Route::resource('teachers', 'TeacherController', ['only' => [//Teacher list
    'index'
]]);

Route::resource('account', 'AccountController', ['only' => [//Account management
    'store', 'update', 'destroy'
]]);

Route::resource('questionnaire', 'QuestionnaireController', ['only' => [//Questionnaire
    'show', 
]]);

// Route::get('/changelog', function (){
//     return view('changelog');
// });

// Route::post('/test', function (){
//     return $_POST;
// });

// Route::get('/{any}', function(){
//     abort(404);
// });
