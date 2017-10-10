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
                        <td>
                            <button href="" class="btn btn-primary btn-sm" type="button" class="btn btn-primary btn-sm"
                                data-toggle="modal" data-target="#ModifySubjectModal"
                                data-subid="{{ $s->subject_id }}"
                                data-code="{{ $s->subject_code }}"
                                data-desc="{{ $s->subject_desc }}">
                                Edit
                            </button>
                            <button href="" class="btn btn-danger btn-sm {{ $s->classe->count() != 0 ? 'disabled' : '' }}">Delete</button>
                        </td>
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
    <div class="modal fade" id="ModifySubjectModal" tabindex="-1" role="dialog" aria-labelledby="ModifySubjectModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Subject</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form">
                        <input type="hidden" id="usrid" value="-1">
                        <div class="form-group">
                            <label>Name:</label>
                            <div class="form-inline">
                                <input type="text" class="form-control m-1" placeholder="Family Name" id="f-name" style="width:12rem">
                                <input type="text" class="form-control m-1" placeholder="Given Name" id="g-name" style="width:12rem">
                                <input type="text" class="form-control m-1" placeholder="M.I." id="mi-name" style="width:4rem">
                                <input type="text" class="form-control m-1" placeholder="Extension Name" id="ne-name" style="width:12rem">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="UpdateProfile">Update Profile</button>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection