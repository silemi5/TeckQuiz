@extends('layouts.app') @section('title', 'Subjects - TeckQuiz') @section('content')
<style>
    body {
        padding-top: 70px;
    }
</style>
<div class="container">
    <h1>Subjects</h1>
    <div class="row">
        <div class="col-9">
            
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Subject Code</th>
                        <th>Description</th>
                        <th>Classes</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($subjects as $s)
                        <tr>
                            <th scope="row">{{ $s->subject_id }}</th>
                            <td>{{$s->subject_code}}</td>
                            <td>{{$s->subject_desc}}</td>
                            <td>{{$s->classe->count()}}</td>
                        <td><a href="" class="btn btn-primary btn-sm">Edit</a> <a href="" class="btn btn-danger btn-sm">Delete</a></td>
                    </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-3">
            <div class="card">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <a href="">Add new subject</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>


@endsection