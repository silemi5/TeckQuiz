@extends('layouts.app')
@section('title', '403 Error!')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>403 - Forbidden</h1><hr>
                <p>If you see this as a mistake, please contact your teacher.</p>
                <p><a href="/quiz">Go back to Quiz Panel.</a></p>
            </div>
        </div>
    </div>
@endsection