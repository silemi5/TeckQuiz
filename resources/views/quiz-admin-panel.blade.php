@extends('layouts.app')
@section('title', 'Administrator\'s Dashboard - TeckQuiz')
@section('content')
<style>
    main{
        padding-top: 2.5rem;
    }
</style>
<main>
    <div class="container-fluid">
        <div class="row">
            <nav class="col-sm-3 col-md-2 d-none d-sm-block bg-light sidebar">
                <ul class="nav nav-pills flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" id="v-pills-dashboard" data-toggle="pill" href="#dashboard" role="tab" aria-controls="v-pills-dashboard"
                            aria-expanded="true">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $classes->count() == 0 ? 'disabled' : '' }}" id="v-pills-home-tab" data-toggle="pill" href="#quiz-events" role="tab" aria-controls="v-pills-home"
                            aria-expanded="true">Quiz Events</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $classes->count() == 0 ? '' : '' }} " id="v-pills-profile-tab" data-toggle="pill" href="#classes" role="tab" aria-controls="v-pills-profile"
                            aria-expanded="true">Classes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#settings" role="tab" aria-controls="v-pills-settings"
                            aria-expanded="true">Settings</a>
                    </li>
                </ul>
            </nav>

            <main class="col-sm-9 ml-sm-auto col-md-10 pt-3" role="main">
                <div class="tab-content container" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="dashboard" role="tabpanel" aria-labelledby="dashboard">
                        <h1 class="align-left">Dashboard</h1><hr>
                        <div class="row">
                            <div class="col-3">
                                <div class="card text-white bg-primary">
                                    <div class="card-body">
                                        <span>{{ $quiz_events->count() }} quiz{{ $quiz_events->count() <= 1 ? '' : 'zes' }} available!</span>
                                    </div>
                                    <a class="card-footer text-white clearfix small z-1" href="">See quiz</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="tab-pane fade {{ $classes->count() == 0 ? '' : '' }}" id="quiz-events" role="tabpanel" aria-labelledby="quiz-events">
                        <h1 class="text-left">Quiz Events</h1>
                        <div class="col-10">
                            <h4>Current Quizzes</h4>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Topic</th>
                                        <th>Subject</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($quiz_events as $qe)
                                        <tr id="quiz_entry{{ $qe->quiz_event_id }}">
                                            <td><a href="/quiz/{{ $qe->quiz_event_id }}">{{ $qe->quiz_event_name }}</a></td>
                                            <td>{{ $qe->classe->subject->subject_desc }}</td>
                                            <td>{{ $qe->classe->course_sec}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @if(count($finished_quiz_events) >= 1)
                            <div class="col-10">
                                <h4>Past Quizzes</h4>
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Topic</th>
                                            <th>Subject</th>
                                            <th>Class</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($finished_quiz_events as $qe)
                                            <tr>
                                                <td><a href="/quiz/{{ $qe->quiz_event_id }}">{{ $qe->quiz_event_name }}</a></td>
                                                <td>{{ $qe->classe->subject->subject_desc }}</td>
                                                <td>{{ $qe->classe->course_sec}}</td>
                                                
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>

                    <div class="tab-pane fade" id="classes" role="tabpanel" aria-labelledby="classes"><!-- Manage Class -->
                        <h3>Classes</h3>
                        <div class="col container row mb-2">
                            <!-- Quiz event entry -->
                            <div class="col quiz-event">
                                @foreach ($classes as $classe)
                                <div class="card mb-2">
                                    <div class="card-body">
                                        <h4 class="card-title">{{ $classe->subject->subject_code }}: {{ $classe->subject->subject_desc }}</h4>
                                        <h6 class="card-subtitle mb-2 text-muted">{{ $classe->course_sec }}</h6>
                                        <a href="/class/{{ $classe->class_id }}" class="btn btn-outline-primary">View Class</a>
                                        <a href="#" class="btn btn-outline-secondary" data-toggle="modal" data-target="#ManageQuiz">Add new student</a>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="settings">
                        <h3>Advanced Settings</h3>
                            <div class="card" style="width: 40rem;">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <a class="btn btn-primary" href="/subjects" style="float: right">Manage subjects</a>
                                        <strong>Manage subjects</strong>
                                        <p>This will allow you to edit subjects to serve as basis for the classes.</p>
                                    </li>
                                    <li class="list-group-item">
                                        <a class="btn btn-primary" href="/teachers" style="float: right">Manage teachers</a>
                                        <strong>Manage teachers</strong>
                                        <p>This will allow you to add teachers to use this system.</p>
                                    </li>
                                </ul>
                            </div>
                    </div>

                </div>
            </main>      
        </div>
    </div>
</main>


@endsection