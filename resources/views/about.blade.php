@extends('layouts.app')

@section('title', 'About us - TeckQuiz')
@section('content')
<style>
    main{
        padding-top: 90px;
    }
</style>
<main>
    <div class="container">
        <div class="row">
            <div class="col-8">
                <h3 class="display-3">Team</h3>
                <p>This webapp is developed and supported by these people.</p>
                <div class="list-group">
                    <div class="list-group-item">
                        <b class="text-muted">Emir M. Jo Jr.</b>
                    </div>
                    <div class="list-group-item">
                        <b class="text-muted">Fatima Mercy A. Onrubia</b>
                    </div>
                    <div class="list-group-item">
                        <b class="text-muted">Keren Keziah A. Pequit</b>
                    </div>
                    <div class="list-group-item">
                        <b class="text-muted">Christian P. Reyes</b>
                    </div>
                </div>
            </div>
            <div class="col-8 pt-4">
                <h3 class="display-3">Source code</h3>
                <p>
                    The source code for this web application is available
                    <a href="https://github.com/silemi5/TeckQuiz">here</a>.
                </p>
                <p>This project is licensed under the MIT License.</p>
            </div>
            
        </div>
    </div>
</main>


@endsection