<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Initial Setup | TeckQuiz</title>

    <!-- Styles -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/teckquiz.css') }}" rel="stylesheet">
</head>

<body>
    <div class="container card">
        <div class="card-body">
            <h3 class="card-title">Initial Setup</h3>
            <div class="row">
                <div class="col-6">
                    <div class="form">
                        <h4>Subject</h4>
                        <div class="form-group">
                            <label for="">Subject Code</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Description</label>
                            <input type="text" class="form-control">
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    <script src="{{ asset('assets/js/jquery-3.2.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/popper.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
</body>


</html>