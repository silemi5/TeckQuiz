<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Login to TeckQuiz</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">

</head>

<body>
    <style>
        .login{
            max-width: 512px;
        }
        .container{
            margin: 7rem;
        }
    </style>
    <div class="container">
        <h3 class="text-center">Login to TeckQuiz</h3>
        <div class="row justify-content-center">
            <div class="col-4 card">
                <div class="card-body">
                    <form action="{{ route('login') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('usr') ? ' has-error' : '' }}">
                            <label for="">Username</label>
                            <input id="usr" name="usr" type="text" value="{{ old('usr') }}" class="form-control" required autofocus>
                            @if ($errors->has('usr'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('usr') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="">Password</label>
                            <input id="password" name="password" type="password" class="form-control" required>
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
        <div class="row justify-content-center mt-3">
            <div class="col-4 card">
                <div class="card-body">
                    <p class="text-center text-muted">
                        Don't have an account? <a href="">Contact your teacher</a>
                    </p>
                </div>
        </div>
    </div>
</body>

</html>