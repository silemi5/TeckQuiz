<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>My Results</title>

    <!-- Styles -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/teckquiz.css') }}" rel="stylesheet">
    <script src="{{ asset('assets/js/jquery-3.2.0.min.js') }}"></script>
</head>

<body>
    <div class="container">
        <h1 class="text-center">Quiz Report</h1>
        <h5 class="text-center">for {{ $results->quiz_event->quiz_event_name }}</h5>
        <hr>
        <p>
            Student name: 
            <b>
                {{ $results->user_profile->family_name }},
                {{ $results->user_profile->given_name }}
                {{ $results->user_profile->ext_name }}
                {{$results->user_profile->middle_name }}
            </b>
        </p>
        <br><br>
        <p>
            The above mentioned student got a score of <b>{{ $results->score }}</b>.
        </p>
        <p>
            This is a computer generated report.
        </p>
    </div>
</body>