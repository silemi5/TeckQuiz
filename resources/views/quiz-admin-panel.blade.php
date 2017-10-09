@extends('layouts.app')
@section('title', 'Quiz Dashboard - TeckQuiz')
@section('content')
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
                    <a class="nav-link {{ $classes->count() == 0 ? '' : '' }} " id="v-pills-profile-tab" data-toggle="pill" href="#my-classes" role="tab" aria-controls="v-pills-profile"
                        aria-expanded="true">My Classes</a>
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
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade {{ $classes->count() == 0 ? '' : '' }}" id="quiz-events" role="tabpanel" aria-labelledby="quiz-events">
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
                                        $("#buttonPanel" + qid).html("<button href=\"\" onclick=\"javascript:ChangeQuizStatus(" + quiz_event_id + ", 1)\" class=\"btn btn-sm btn-primary\">Enable Quiz</button> <button class=\"btn btn-sm btn-primary\">Manage Quiz</button>");
                                    }else if(quiz_status == 1){//Enables the quiz
                                        $("#buttonPanel" + qid).html("<button href=\"\" onclick=\"javascript:ChangeQuizStatus(" + quiz_event_id + ", 0)\" class=\"btn btn-sm btn-primary\">Disable Quiz</button> <button href=\"\" onclick=\"javascript:ChangeQuizStatus(" + quiz_event_id + ", 2)\" class=\"btn btn-sm btn-primary\">End Quiz</button> <button href=\"\" class=\"btn btn-sm btn-primary\">Manage Quiz</button>");
                                    }else if(quiz_status == 2){//Ends the quiz
                                        $("#quiz_entry" + qid).html("");
                                        $("#quiz_entry" + qid).hide();
                                    }
                                }else{
                                    alert("Something happened! Quiz not started!");
                                }
                            });
                        }
                        
                    </script>
                    <h1 class="text-left">Quiz Events</h1>
                    <div class="col-12">
                        <h4>Current Quizzes</h4>
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
                                @foreach($quiz_events as $qe)
                                    <tr id="quiz_entry{{ $qe->quiz_event_id }}">
                                        <td>{{ $qe->quiz_event_name }}</td>
                                        <td>{{ $qe->classe->subject->subject_desc }}</td>
                                        <td>{{ $qe->classe->course_sec}}</td>
                                        
                                        @if($qe->quiz_event_status == 0)
                                            <td id="buttonPanel{{ $qe->quiz_event_id }}">
                                                <button href="" onclick="javascript:ChangeQuizStatus({{ $qe->quiz_event_id }}, 1)" class="btn btn-sm btn-primary">Enable Quiz</button>
                                                <a href="/manage/quiz/{{ $qe->quiz_event_id }}" class="btn btn-sm btn-primary">Manage Quiz</a>
                                            </td>
                                        @elseif($qe->quiz_event_status == 1)
                                            <td id="buttonPanel{{ $qe->quiz_event_id }}">
                                                <button href="" onclick="javascript:ChangeQuizStatus({{ $qe->quiz_event_id }}, 0)" class="btn btn-sm btn-primary">Disable Quiz</button>
                                                <button href="" onclick="javascript:ChangeQuizStatus({{ $qe->quiz_event_id }}, 2)" class="btn btn-sm btn-primary">End Quiz</button>
                                                <a href="/manage/quiz/{{ $qe->quiz_event_id }}" class="btn btn-sm btn-primary">Manage Quiz</a>
                                            </td>
                                        @endif
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
                                            <td>{{ $qe->quiz_event_name }}</td>
                                            <td>{{ $qe->classe->subject->subject_desc }}</td>
                                            <td>{{ $qe->classe->course_sec}}</td>
                                            <td><a class="btn btn-sm btn-primary" href="/quiz/results/{{ $qe->quiz_event_id }}">See results</a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                    <button class="btn btn-primary" data-toggle="modal" data-target="#NewQuizEventModal">New quiz event</button>
                </div>

                <div class="tab-pane fade {{ $classes->count() == 0 ? '' : '' }}" id="my-classes" role="tabpanel" aria-labelledby="my-classes"><!-- Manage Class -->
                    <!-- Fetch instructor's subjects -->
                    <h3>My Classes</h3>
                    <div class="col container row mb-2">
                        <!-- Quiz event entry -->
                        <div class="col quiz-event">
                            @foreach ($classes as $classe)
                            <div class="card mb-2">
                                <div class="card-body">
                                    <h4 class="card-title">{{ $classe->subject->subject_code }}: {{ $classe->subject->subject_desc }}</h4>
                                    <h6 class="card-subtitle mb-2 text-muted">{{ $classe->course_sec }}</h6>
                                    <a href="/manage/class/{{ $classe->class_id }}" class="btn btn-outline-primary">Manage Class</a>
                                    <a href="#" class="btn btn-outline-secondary" data-toggle="modal" data-target="#ManageQuiz">Add new student</a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#NewClassModal">New class</button>
                    </div>

                </div>

                <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="settings">
                    <h3>Advanced Settings</h3>
                        <div class="card" style="width: 40rem;">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <button class="btn btn-primary" style="float: right">Manage subjects</button>
                                    <strong>Manage subjects</strong>
                                    <p>This will allow you to edit subjects to serve as basis for the classes.</p>
                                </li>
                                <li class="list-group-item">
                                    <button class="btn btn-danger" style="float: right">Delete this class</button>
                                    <strong>Delete this class</strong>
                                    <p>Once you delete this class, there is no turning back.</p>
                                </li>
                            </ul>
                        </div>
                </div>

            </div>
        </main>
        
        <!-- New Quiz Modal -->
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
                                    <option value="{{ $classe->class_id }}">{{ $classe->subject->subject_desc }} ({{ $classe->course_sec }})</option>
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

        <!-- New Class Modal -->
        <div class="modal fade" id="NewClassModal" tabindex="-1" role="dialog" aria-labelledby="NewClassModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form class="modal-content form" action="/new/class" method="POST">
                     {{ csrf_field() }}
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalTitle">New Class</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Class Name</label>
                            <input name="course_sec" type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Subject</label>
                            <select name="sub_id" id="" class="form-control">
                                @foreach($subjects as $s)
                                    <option value="{{ $s->subject_id }}">{{$s->subject_code}}: {{$s->subject_desc}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
        
    </div>
</div>

@endsection