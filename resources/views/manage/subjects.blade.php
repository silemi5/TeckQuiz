@extends('layouts.app') @section('title', 'Subjects - TeckQuiz') @section('content')
<style>
    body {
        padding-top: 70px;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-8">
            <h1>Subjects</h1>
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
                    <tr>
                        <th scope="row">1</th>
                        <td>CSIT 000</td>
                        <td>Web Development</td>
                        <td>1</td>
                        <td><a href="" class="btn btn-primary btn-sm">Edit</a> <a href="" class="btn btn-danger btn-sm">Delete</a></td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>CSIT 000</td>
                        <td>Lorem, ipsum dolor.</td>
                        <td>5</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>


@endsection