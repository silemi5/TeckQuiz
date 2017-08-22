@extends('layouts.app')
@section('title', 'Quiz - TeckQuiz')

@section('content')
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1>Hello back {{ Auth::user()->usr }}!</h1>
                </div>

                <div class="col-12 container row">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Lorem, ipsum dolor.</h4>
                            <h6 class="card-subtitle mb-2 text-muted">Lorem ipsum dolor sit.</h6>
                            <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->
                            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Start quiz</a>
                        </div>
                        <div class="card-footer">
                            Time left to take the quiz: 00:00:01
                        </div>
                    </div>
                </div>
            </div>
        </div>


@endsection
