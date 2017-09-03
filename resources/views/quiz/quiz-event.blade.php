<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Quiz</title>

    <!-- Styles -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/teckquiz.css') }}" rel="stylesheet">
</head>
    <style>
        .sidebar{
            top: 0px;
        }
    </style>

<body>
    <?php $questionNum = 1 ?>
    <div class="container-fluid">
        <div class="row">
            <nav class="col-sm-3 col-md-2 d-none d-sm-block bg-light sidebar">
                <ul class="nav nav-pills flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" id="v-pills-welcome-tab" data-toggle="pill" href="#welcome" role="tab" aria-controls="v-pills-welcome"
                            aria-expanded="true">Welcome</a>
                    </li>
                    @foreach($quiz_content as $qc)
                        <li class="nav-item">
                            <a class="nav-link"
                                    id="v-pills-welcome-tab"
                                    data-toggle="pill"
                                    href="#q{{ $questionNum }}"
                                    role="tab"
                                    aria-controls="v-pills-q{{ $questionNum }}"
                                    aria-expanded="true">
                                Question {{ $questionNum++ }}
                            </a>
                        </li>
                    @endforeach
                </ul>
                <?php $questionNum = 1 ?>
            </nav>

            <main class="col-sm-9 ml-sm-auto col-md-10 pt-3" role="main">
                <div class="tab-content col" id="v-pills-tabContent">
                    
                    <div class="tab-pane active" id="welcome" role="tabpanel" aria-labelledby="welcome">
                        <h1>{{ $quiz->quiz_event_name }}</h1>
                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Voluptatum, dignissimos.</p>
                    </div>
                    @foreach($quiz_content as $qc)
                        <div class="tab-pane" id="q{{ $questionNum }}" role="tabpanel" aria-labelledby="q{{ $questionNum }}">
                            <h2>Question #{{ $questionNum++ }}</h2>
                            <p>{{ $qc->question_name }}</p>
                        </div>
                    @endforeach
                </div>
            </main>
        </div>
    </div>

    <script src="{{ asset('assets/js/jquery-3.2.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/popper.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
</body>


</html>