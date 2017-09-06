@extends('layouts.app')
@section('title', 'Manage class - TeckQuiz')
@section('content')
    <style>
        body {
            padding-top: 70px;
        }
    </style>
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
                <h1>Class</h1>

                <div class="tab-content col" id="v-pills-tabContent">
                    <div class="tab-pane fade show active row" id="quiz-events" role="tabpanel" aria-labelledby="quiz-events">

                    </div>
                    <div class="tab-pane fade" id="manage-class" role="tabpanel" aria-labelledby="manage-class">

                    </div>
                    <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="settings">
                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Voluptatum, dignissimos.</p>
                    </div>
                </div>
            </main>

        </div>
    </div>
@endsection