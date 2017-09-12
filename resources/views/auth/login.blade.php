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
                    <form>
                        <div class="form-group">
                            <label for="">Username</label>
                            <input class="form-control" type="text">
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <input class="form-control" type="password">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary btn-block">Login</button>
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