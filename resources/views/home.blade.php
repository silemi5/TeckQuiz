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
                    <div class="col-lg-5 col-md-12 col-sm-12">
                        <div class="card">
                            <div class="card-header">Register</div>
                            <div class="card-body">
                                <form>
                                    <div class="form-group">
                                        <label for="">Name</label>
                                        <div class="form-inline">
                                            <input type="text" placeholder="Given name" class="form-control form-inline m-1" style="width: 128px">
                                            <input type="text" placeholder="M.I." class="form-control form-inline m-1" style="width: 52px">
                                            <input type="text" placeholder="Family name" class="form-control form-inline m-1" style="width: 128px">
                                            <input type="text" placeholder="Ext." class="form-control form-inline m-1" style="width: 52px">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Username</label>
                                        <input type="text" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Password</label>
                                        <input type="password" class="form-control">
                                        <small class="form-text text-muted">At least 8 characters</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Class Code</label>
                                        <input type="text" class="form-control">
                                        <small class="form-text text-muted">Ask your teacher for the code</small>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-success btn-block">Register</button>
                                        <small class="form-text text-muted text-center">By clicking "Register", you agree to our terms of service and privacy policy.</small>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection