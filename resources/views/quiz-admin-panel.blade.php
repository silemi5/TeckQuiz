@extends('layouts.app')
@section('title', 'Quiz Dashboard - TeckQuiz')
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
                    <script>
                        $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                        });

                        function ChangeQuizStatus(quiz_event_id, quiz_status){
                            $.post("/quiz/changestatus", {quiz_event_id, quiz_status}, function(data){
                                var response = jQuery.parseJSON(data)
                                var qid = quiz_event_id
                                if (response.status == 0){
                                    if (quiz_status == 0){//Disables the quiz
                                        $("#buttonPanel" + qid).html("<a href='#' onclick='ChangeQuizStatus(" + qid + ", 1)' class='btn btn-outline-primary'>Enable quiz</a> <a href='' class='btn btn-outline-secondary' data-toggle='modal' data-target='#ManageQuiz'>Manage quiz</a>");
                                    }else if(quiz_status == 1){//Enables the quiz
                                        $("#buttonPanel" + qid).html("<a href='#' onclick='ChangeQuizStatus(" + qid + ", 0)' class='btn btn-outline-primary'>Disable quiz</a> <a href='#' onclick='endQuiz(" + qid + ", 2)' class='btn btn-outline-danger'>End quiz</a> <a href='#' class='btn btn-outline-secondary' data-toggle='modal' data-target='#'>Details</a>");
                                    }else if(quiz_status == 2){//Ends the quiz
                                        $("#quiz_card" + qid).html("");
                                        $("#quiz_card" + qid).hide();
                                    }
                                }else{
                                    alert("Something happened! Quiz not started!");
                                }
                            });
                        }
                        
                    </script>
                    <div class="col container row mb-2">
                        <!-- Example of a quiz event entry -->
                        <div class="col quiz-event">
                            @foreach ($quiz_events as $qe)
                            <div class="card mb-2" id="quiz_card{{ $qe->quiz_event_id }}">
                                <div class="card-body">
                                    <h4 class="card-title">{{ $qe->quiz_event_name }}</h4>
                                    <h6 class="card-subtitle mb-2 text-muted">{{ $qe->subject_desc }}</h6>
                                    <div id="buttonPanel{{ $qe->quiz_event_id }}">
                                    @if($qe->quiz_event_status == 0)
                                        <a href="#" onclick="ChangeQuizStatus({{ $qe->quiz_event_id }}, 1)" class="btn btn-outline-primary">Enable quiz</a>
                                        <a href="#" class="btn btn-outline-secondary" data-toggle="modal" data-target="#ManageQuiz">Manage quiz</a>
                                    @elseif($qe->quiz_event_status == 1)
                                        <a href="#" onclick="ChangeQuizStatus({{ $qe->quiz_event_id }}, 0)" class="btn btn-outline-primary">Disable quiz</a>
                                        <a href="#" onclick="ChangeQuizStatus({{ $qe->quiz_event_id }}, 2)" class="btn btn-outline-danger">End quiz</a>
                                        <a href="#" class="btn btn-outline-secondary" data-toggle="modal" data-target="#">Manage Quiz</a>
                                    @endif
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        
                    </div>
                    <div class="col">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#NewQuizEventModal">New quiz event</button>
                        <button class="btn btn-secondary" data-toggle="modal" data-target="">View finished quiz events</button>
                    </div>
                </div>
                <div class="tab-pane fade" id="manage-class" role="tabpanel" aria-labelledby="manage-class"><!-- Manage Class -->
                    <!-- Fetch instructor's subjects -->
                    <h3>Manage Class</h3>
                    <div class="col container row mb-2">
                        <!-- Quiz event entry -->
                        <div class="col quiz-event">
                            @foreach ($classes as $classe)
                            <div class="card mb-2">
                                <div class="card-body">
                                    <h4 class="card-title">{{ $classe->subject_code }}: {{ $classe->subject_desc }}</h4>
                                    <h6 class="card-subtitle mb-2 text-muted">{{ $classe->course_sec }}</h6>
                                    <a href="#" class="btn btn-outline-primary" data-toggle="modal" data-target="#StartQuiz">Manage Class</a>
                                    <a href="#" class="btn btn-outline-secondary" data-toggle="modal" data-target="#ManageQuiz">Add new student</a>
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
        <!-- Modal -->
        <div class="modal fade" id="NewQuizEventModal" tabindex="-1" role="dialog" aria-labelledby="NewQuizEventModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form class="modal-content form" action="/new/quiz" method="POST">
                     {{ csrf_field() }}
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalTitle">New Quiz Event</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group"><label for="">Quiz Name</label><input name="quiz_name" type="text" class="form-control"></div>
                        <div class="form-group">
                            <label for="">Class</label>
                            <select name="class_id" id="class_id" class="form-control">
                                 @foreach ($classes as $classe)
                                    <option value="{{ $classe->class_id }}">{{ $classe->subject_desc }} ({{ $classe->course_sec }})</option>
                                 @endforeach
                            </select>
                        </div>
                        <div class="form-group"><label for="">Questions</label><input name="questions" type="number" min="1" class="form-control"></div>
                        <!-- TODO: Time limit -->
                        <div class="form-group">
                            <label for="">Questionnaire to use</label>
                            <select name="questionnaire" id="questionnaire" class="form-control">
                                <option value="1">Create new questionnaire</option>
                                <option value="2">Use existing questionnaire</option>
                            </select>
                        </div>
                        <input type="hidden" name="valid" value="1">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Next</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection