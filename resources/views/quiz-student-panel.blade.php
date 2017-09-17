@extends('layouts.app')
@section('title', 'Quiz - TeckQuiz')

@section('content')
<div class="container-fluid">
    <div class="row">
        <nav class="col-sm-3 col-md-2 d-none d-sm-block bg-light sidebar">
            <ul class="nav nav-pills flex-column">
                <li class="nav-item">
                    <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#pending" role="tab" aria-controls="v-pills-home"
                        aria-expanded="true">Pending Quiz</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#upcoming" role="tab" aria-controls="v-pills-profile"
                        aria-expanded="true">Upcoming Quiz</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" id="v-pills-settings-tab" data-toggle="pill" href="#settings" role="tab" aria-controls="v-pills-settings"
                        aria-expanded="true">Settings</a>
                </li>
            </ul>
        </nav>

        <main class="col-sm-9 ml-sm-auto col-md-10 pt-3" role="main">
            <div class="tab-content col" id="v-pills-tabContent">
                <div class="tab-pane fade show active" id="pending" role="tabpanel" aria-labelledby="quiz-events">
                    <h3>Pending Quizzes</h3>
                    <div class="col container row mb-2">
                        <!-- Example of a quiz event entry -->
                        <div class="col-6 quiz-event">
                            @foreach ($pending_quiz as $pq)
                            <div class="card mb-2">
                                <div class="card-body">
                                    <h4 class="card-title">{{ $pq->quiz_event_name }}</h4>
                                    <h6 class="card-subtitle mb-2 text-muted">{{ $pq->classe->subject->subject_desc }}</h6>
                                    <a href="/quiz/{{ $pq->quiz_event_id }}" class="btn btn-outline-primary">Start</a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="upcoming" role="tabpanel" aria-labelledby="manage-class">
                    <h3>Upcoming Quizzes</h3>
                    <div class="col container row mb-2">
                        <!-- Example of a quiz event entry -->
                        <div class="col-6 quiz-event">
                            @foreach ($upcoming_quiz as $uq)
                            <div class="card mb-2">
                                <div class="card-body">
                                    <h4 class="card-title">{{ $uq->quiz_event_name }}</h4>
                                    <h6 class="card-subtitle mb-2 text-muted">{{ $uq->classe->subject->subject_desc }}</h6>
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
        </main>
    </div>
</div>


@endsection
