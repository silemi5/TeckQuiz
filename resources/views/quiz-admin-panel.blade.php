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
                        <a class="nav-link {{ $classes->count() == 0 ? 'disabled' : '' }} " id="v-pills-profile-tab" data-toggle="pill" href="#classes" role="tab" aria-controls="v-pills-profile"
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

                    <div class="tab-pane fade" id="quiz-events" role="tabpanel" aria-labelledby="quiz-events">
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
                                    <li class="list-group-item">
                                        <button class="btn btn-danger" data-toggle="modal" data-target="#changePassword" style="float: right">Change password</button>
                                        <strong>Change password</strong>
                                        <p>This will allow you to change your password.</p>
                                    </li>
                                </ul>
                            </div>
                    </div>

                </div>
            </main>      
        </div>
    </div>
</main>
<!-- Change password modal -->
<div class="modal fade" id="changePassword" tabindex="-1" role="dialog" aria-labelledby="changePassword" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Change password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Current password</label>
                    <input id="pwd" type="password" class="form-control">
                    <div class="invalid-feedback">
                        Input your correct password.
                    </div>
                </div>
                <div class="form-group">
                    <label for="">New password</label>
                    <input id="pwd_new" type="password" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="changePassword()">Change password</button>
            </div>
        </div>
    </div>
</div>
<!-- Change password Success Modal -->
<div class="modal fade" id="changePasswordSuccess" tabindex="-1" role="dialog" aria-labelledby="changePasswordSuccess"
    aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Success!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Password changed successfully!
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    function changePassword(){
        var oldPass = $('#pwd').val();
        var newPass = $('#pwd_new').val();
        var update_type = 0;

         $.ajax({
            url: '/account/' + {{Auth::id()}},
            type: 'PUT', //type is any HTTP method
            data: {
                update_type, oldPass, newPass
            }, //Data as js object
            success: function () {
                $('#changePassword').modal('hide')
                $('#changePasswordSuccess').modal('show')
            },
            error: function(data){
                $('#pwd').addClass('is-invalid');
            }
        });
    }
</script>

@endsection