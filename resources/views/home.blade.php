@extends('layouts.app')

@section('title', 'TeckQuiz - An Online Quiz Management System')
@section('content')
    <style>
            body {
                padding-top: 50px;
            }
            .app-title-container {
                background: url('./assets/img/study-map.jpg') center center no-repeat;
                background-attachment: fixed;
                background-position: cover;
                height: 100vh;
                width: 100%;
            }

            .app-title {
                background: rgba(255, 255, 255, 0.5);
                position: relative;
                top: 50%;
                transform: translateY(-50%);
            }

            .center-features {
                background-color: rgba(255, 255, 255, 0.5);
                height: 100vh;
                padding: 10rem 0;
            }

            .app-feature-1 {
                background: url('./assets/img/crumpled-paper.jpg') center center no-repeat;
                background-attachment: fixed;
                background-position: cover;
                color: #212121;
            }

            .app-feature-2 {
                background-color: rgba(255, 255, 255, 0.5);
                background: url('./assets/img/work-enviroment.jpg') center center no-repeat;
                background-attachment: fixed;
                background-position: cover;
                color: #C5CAE9;
            }
        </style>
    <div class="container-fluid app-title-container">
        <div class="jumbotron app-title" style="border-radius: 0">
            <h1 class="text-center">TeckQuiz</h1>
            <p class="text-center">An Online Quiz Management System</p>
        </div>
    </div>
    <div class="container-fluid center-features app-feature-1">
        <h2 class="text-center"><strong>Forget the paper, just test.</strong></h2>
        <p class="text-center">Quiz without paper. Quiz without hassle.</p>
    </div>
    <div class="container-fluid center-features app-feature-2">
        <h2 class="text-center"><strong>Serve quiz with ease.</strong></h2>
        <p class="text-center">No more confusion, just do it.</p>
    </div>
@endsection
