@extends('layouts.app')

@section('title', 'TeckQuiz - An Online Quiz Management System')
@section('content')
    <div class="main">
        <style>
            p.home-lead {
                font-size: 26px;
            }

            h1.home-title {
                font-size: 72px;
            }
        </style>
        <div class="jumbotron">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 col-md-12 text-left">
                        <h1 class="home-title">TeckQuiz</h1>
                        <p class="home-lead">
                            An Online Quiz System built for the Web.
                        </p>
                    </div>
                    @if (Auth::guest())
                    <div class="col-lg-5 col-md-12 col-sm-12">
                        <div class="card">
                            <!-- <div class="card-header">Register</div> -->
                            <div class="card-body">
                                @if($errors->has('usr'))
                                    <strong>{{ $errors->first('usr') }}</strong>
                                @endif
                                 @if($errors->has('password'))
                                    <strong>{{ $errors->first('password') }}</strong>
                                @endif
                                <form method="POST" action="{{ route('register') }}">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="">Name</label>
                                        <div class="form-inline">
                                            <input name="n_given" id="n_given" type="text" placeholder="Given name" class="form-control form-inline m-1" style="width: 128px">
                                            <input name="n_middle" id="n_middle" type="text" placeholder="M.I." class="form-control form-inline m-1" style="width: 52px">
                                            <input name="n_family" id="n_family" type="text" placeholder="Family name" class="form-control form-inline m-1" style="width: 128px">
                                            <input name="n_ext" id="n_ext" type="text" placeholder="Ext." class="form-control form-inline m-1" style="width: 52px">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Username</label>
                                        <input name="usr" id="usr" type="text" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Password</label>
                                        <input name="password" id="password" type="password" class="form-control">
                                        <small class="form-text text-muted">At least 8 characters</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Confirm Password</label>
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Class Code</label>
                                        <input name="class_code" id="class_code" type="text" class="form-control">
                                        <small class="form-text text-muted">Ask your teacher for the code</small>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success btn-block">Register</button>
                                        <small class="form-text text-muted text-center">By clicking "Register", you agree to our terms of service and privacy policy.</small>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @else
                        <div class="col-lg-5 col-md-12 col-sm-12">
                        <div class="card">
                            <!-- <div class="card-header">Register</div> -->
                            <div class="card-body">
                                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Minima, modi!
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
@endsection