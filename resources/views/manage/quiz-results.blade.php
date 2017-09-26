<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Styles -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/teckquiz.css') }}" rel="stylesheet">
    <script src="{{ asset('assets/js/jquery-3.2.0.min.js') }}"></script>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center">Quiz Results</h1>
                <h5 class="text-center">for {{ $results->quiz_event_name }}</h5>
            </div>
            <div class="col-12">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Score</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($results->classe->student_class as $result)
                            <tr>
                                <td>{{ $result->user_profile->family_name }}, {{ $result->user_profile->given_name }} {{ $result->user_profile->ext_name }} {{ $result->user_profile->middle_name }}</td>
                                <td>
                                    @if(is_null($result->student_score))
                                        <i>not taken</i>
                                    @else     
                                        {{ $result->student_score->score }}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <p class="text-center">----- END OF RESULTS -----</p>
            </div>
        </div>
    </div>

</body>

</html>