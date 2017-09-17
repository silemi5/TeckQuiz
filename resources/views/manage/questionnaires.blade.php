@extends('layouts.app')
@section('title', 'Manage Questionnaire - TeckQuiz')
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
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="basic-info" role="tabpanel" aria-labelledby="v-pills-home-tab">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad, inventore.
                    </div>
                    <div class="tab-pane fade" id="questions" role="tabpanel" aria-labelledby="v-pills-profile-tab">

                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist">
                    <a class="nav-link active" id="basic-info-tab" data-toggle="pill" href="#basic-info" role="tab" aria-controls="v-pills-home"
                        aria-expanded="true">Basic Information</a>
                    <a class="nav-link" id="questions-tab" data-toggle="pill" href="#questions" role="tab" aria-controls="v-pills-profile"
                        aria-expanded="true">Questions</a>
                </div>
            </div>
            

        </div>
        
    </section>

@endsection