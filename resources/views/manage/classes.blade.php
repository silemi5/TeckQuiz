@extends('layouts.app')
@section('title', 'Manage class - TeckQuiz')
@section('content')
    <style>
        body {
            padding-top: 70px;
        }
    </style>
    <div class="container-fluid">
        <div class="row">
            <nav class="col-sm-3 col-md-2 d-none d-sm-block bg-light sidebar">
                <ul class="nav nav-pills flex-column">
                    <li class="nav-item">
                        <a class="nav-link" id="v-pills-class" data-toggle="pill" href="#class-tab" role="tab" aria-controls="v-pills-class"
                            aria-expanded="true">Class</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" id="v-pills-students" data-toggle="pill" href="#students-tab" role="tab" aria-controls="v-pills-students"
                            aria-expanded="true">Students</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="v-pills-settings" data-toggle="pill" href="#settings-tab" role="tab" aria-controls="v-pills-settings"
                            aria-expanded="true">Settings</a>
                    </li>
                </ul>
            </nav>

            <main class="col-sm-9 ml-sm-auto col-md-10 pt-3" role="main">             
                <h3>{{ $quiz_class->subject_code }}: {{ $quiz_class->subject_desc }}</h3>
                <h5><span class="badge badge-primary">{{ $quiz_class->course_sec }}</span></h5>
                <hr>
                <div class="tab-content col" id="v-pills-tabContent">
                    <div class="tab-pane fade" id="class-tab" role="tabpanel" aria-labelledby="class-tab">
                        <h4>Statistics</h4>
                    </div>
                    <div class="tab-pane fade show active row" id="students-tab" role="tabpanel" aria-labelledby="students-tab">
                        <h2 class="text-left">Classlist</h2>
                        <table class="table table-striped">
                            <thead class="thead-inverse">
                                <tr>
                                    <th>Name</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($students as $s)
                                <tr>
                                    <td>{{ $s->family_name }}, {{ $s->given_name }} {{ $s->ext_name }} {{ $s->middle_name }}
                                        </td>
                                    <td>
                                        <button class="btn btn-primary" href="#">Edit</button>
                                        <button class="btn btn-primary" href="#">Delete</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <button class="btn btn-primary">Add new student</button>
                    </div>
                    <div class="tab-pane fade" id="settings-tab" role="tabpanel" aria-labelledby="settings-tab">
                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Voluptatum, dignissimos.</p>
                        <h4>Advanced Settings</h4>
                        <div class="card" style="width: 40rem;">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <button class="btn btn-warning" style="float: right">Disable this class</button>
                                    <strong>Disable this class</strong>
                                    <p>If your class has move up to another grade, you can disable the class here. Disabling will make the class read-only.</p>
                                </li>
                                <li class="list-group-item">
                                    <button class="btn btn-danger" style="float: right">Delete this class</button>
                                    <strong>Delete this class</strong>
                                    <p>Once you delete this class, there is no turning back.</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </main>

        </div>
    </div>
@endsection