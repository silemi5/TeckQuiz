@extends('layouts.app')
@section('title', 'Manage Quiz - TeckQuiz')
@section('content')
    <style>
        body {
            padding-top: 90px;
        }
    </style>
    <section class="container">
        <h1>Manage Quiz</h1>
        <hr>
        <div class="row">
            <div class="col-md-9">
                <h3>{{ $quiz_details->quiz_event_name }}</h3>
                <p>This is some basic information about the quiz.</p>
                <p>Class: <b><a href="/manage/class/{{ $quiz_details->class_id }}"></a>{{ $quiz_details->classe->course_sec }}</b></p>
                <p>Subject: <b>{{ $quiz_details->classe->subject->subject_desc }}</b></p>
                <p>Questionnaire: <b><a href="#">{{ $quiz_details->questionnaire->questionnaire_name }}</a></b></p>
            </div>
            <div class="col-md-3">
                <button class="btn btn-primary">Enable Quiz</button>
                <button class="btn btn-primary">Disable Quiz</button>
            </div>
        </div>
        
    </section>

@endsection