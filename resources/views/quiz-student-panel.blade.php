@extends('layouts.master')
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
                            <h4 class="card-title">Database Management Systems 2</h4>
                            <h6 class="card-subtitle mb-2 text-muted">Database Approach</h6>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Start quiz</a>
                        </div>
                        <div class="card-footer">
                            Time left to take the quiz: 00:00:01
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Quiz Event</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Do you want to start the quiz event entitled <strong>Quiz 1</strong>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Start now</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Back</button>
            </div>
            </div>
        </div>
    </div>

@endsection
