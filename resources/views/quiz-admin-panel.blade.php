@extends('layouts.app')
@section('title', 'Quiz Panel - TeckQuiz')
@section('content')
<div class="container-fluid">
    <div class="row">
        <nav class="col-sm-3 col-md-2 d-none d-sm-block bg-light sidebar">
            <ul class="nav nav-pills flex-column">
                <li class="nav-item">
                    <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#quiz-events" role="tab" aria-controls="v-pills-home"
                        aria-expanded="true">Quiz Events</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#manage-class" role="tab" aria-controls="v-pills-profile"
                        aria-expanded="true">Manage class</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#settings" role="tab" aria-controls="v-pills-settings"
                        aria-expanded="true">Settings</a>
                </li>
            </ul>
        </nav>

        <main class="col-sm-9 ml-sm-auto col-md-10 pt-3" role="main">
            <!-- <h1>Dashboard</h1> -->

            <div class="tab-content col" id="v-pills-tabContent">
                <div class="tab-pane fade show active row" id="quiz-events" role="tabpanel" aria-labelledby="quiz-events">
                    <h3>Quiz Events</h3>
                    <div class="col container row mb-2">
                        <!-- Example of a quiz event entry -->
                        <div class="col quiz-event">
                            @foreach ($quiz_events as $qe)
                            <div class="card mb-2">
                                <div class="card-body">
                                    <h4 class="card-title">{{ $qe->quiz_event_name }}</h4>
                                    <h6 class="card-subtitle mb-2 text-muted">{{ $qe->subject_desc }}</h6>
                                    <a href="/quiz/{{ $qe->quiz_event_id }}" class="btn btn-outline-primary btn-sm">Start</a>
                                    <a href="#" class="btn btn-outline-secondary btn-sm" data-toggle="modal" data-target="#ManageQuiz">Manage quiz</a>
                                    <a href="#" class="btn btn-outline-secondary btn-sm" data-toggle="modal" data-target="#">Details</a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        
                    </div>
                    <div class="col">
                        <button class="btn btn-primary">New quiz event</button>
                    </div>
                </div>
                <div class="tab-pane fade" id="manage-class" role="tabpanel" aria-labelledby="manage-class">
                    <!-- Fetch instructor's subjects -->
                    <h3>Manage Class</h3>
                    <div class="col container row mb-2">
                        <!-- Quiz event entry -->
                        <div class="col quiz-event">
                            @foreach ($classes as $classe)
                            <div class="card mb-2">
                                <div class="card-body">
                                    <h4 class="card-title">{{ $classe->subject_code }}</h4>
                                    <h6 class="card-subtitle mb-2 text-muted">{{ $classe->subject_desc }}</h6>
                                    <a href="#" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#StartQuiz">Manage Class</a>
                                    <a href="#" class="btn btn-outline-secondary btn-sm" data-toggle="modal" data-target="#ManageQuiz">Add new student</a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col">
                        <button class="btn btn-primary">New class</button>
                    </div>

                </div>
                <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="settings">
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Voluptatum, dignissimos.</p>
                </div>
            </div>
        </main>
    </div>
</div>

@endsection