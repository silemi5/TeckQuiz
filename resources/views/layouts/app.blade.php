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
    <div id="app">
        <nav class="navbar navbar-expand-md fixed-top navbar-dark bg-dark">
            <a class="navbar-brand" href="/">TeckQuiz</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav col-md-10">
                    <li class="nav-item active">
                        <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#">Report a bug</a>
                    </li>

                </ul>
                <!-- Login here -->
                @if(Auth::guest())
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="" data-toggle="modal" data-target="#loginModal">Login</a>
                        </li>
                    </ul>
                @else
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ Auth::user()->usr }}
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <h6 class="dropdown-header">Signed in as: <b>{{ Auth::user()->usr }}</b></h6>
                            <a class="dropdown-item" href="/profile">Profile</a>
                            <a class="dropdown-item" href="/quiz">Quiz Panel</a>
                            <a class="dropdown-item" href="#">Preference</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                            </div>
                        </li>
                    </ul>

                @endif

            </div>
        </nav>
        @yield('content')

        
    </div>

    <!-- Scripts -->
    
    <script src="{{ asset('assets/js/popper.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
</body>

</html>