@extends('layouts.app')
@section('title', 'Quiz Panel - TeckQuiz')
@section('content')
<div class="container">
    <div class="row">
        <div class="alert alert-warning col-12" role="alert">
            This feature is not yet fully implemented!
        </div>
        <div class="col-12">
            <h1>Hello back teacher!</h1>
            <hr>
        </div>

        <div class="nav flex-column nav-pills col-3" id="v-pills-tab" role="tablist">
            <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#quiz-events" role="tab" aria-controls="v-pills-home"
                aria-expanded="true">Quiz Events</a>
            <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#manage-class" role="tab" aria-controls="v-pills-profile"
                aria-expanded="true">Manage class</a>
            <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#settings" role="tab" aria-controls="v-pills-settings"
                aria-expanded="true">Settings</a>
        </div>

        <div class="tab-content col-9" id="v-pills-tabContent">
            <div class="tab-pane fade show active" id="quiz-events" role="tabpanel" aria-labelledby="quiz-events">
                <!-- TODO: Change style of quiz presentation. -->
                <h3>Quiz Events</h3>
                <div class="col-12 container row">
                    <!-- Example of a quiz event entry -->
                    <div class="col quiz-event">
                        @foreach ($quiz_events as $qe)
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">{{ $qe->quiz_event_name }}</h4>
                                <h6 class="card-subtitle mb-2 text-muted">{{ $qe->subject_desc }}</h6>
                                <a href="{{ $qe->quiz_event_id }}" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#StartQuiz">Start</a>
                                <a href="#" class="btn btn-outline-secondary btn-sm" data-toggle="modal" data-target="#ManageQuiz">Manage quiz</a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="manage-class" role="tabpanel" aria-labelledby="manage-class">
                <!-- Fetch instructor's subjects -->

                <!-- <form action="">
                    <h3>Manage class</h3>
                    <div class="form-group">
                        <label for="select-class">Select class</label>
                        <select class="form-control" id="class-selected">
                            <option id="a">Database Management Systems 2</option>
                            <option id="b">System Analysis and Design</option>
                            <option id="c">Web Development</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-outline-primary">Go to class</button>
                        <button class="btn btn-primary">Add new class</button>
                    </div>
                </form> -->

                <h3>Manage Class</h3>
                <div class="col-12 container row">
                    <!-- Example of a quiz event entry -->
                    <div class="col quiz-event">
                        @foreach ($classes as $classe)
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">{{ $classe->subject_code }}</h4>
                                <h6 class="card-subtitle mb-2 text-muted">{{ $classe->subject_desc }}</h6>
                                <a href="" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#StartQuiz">Manage Class</a>
                                <a href="#" class="btn btn-outline-secondary btn-sm" data-toggle="modal" data-target="#ManageQuiz">Add new student</a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="settings">
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Voluptatum, dignissimos.</p>
            </div>
        </div>
    </div>
</div>

@endsection