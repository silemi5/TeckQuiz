@extends('layouts.app')
@section('title', 'Quiz Dashboard - TeckQuiz')
@section('content')
<style>
    body {
        padding-top: 90px;
    }
</style>
<div class="container">
    <h2>Create Quiz Event</h2>
    <form action="/test" method="POST" class="form">
        {{ csrf_field() }}
        <div class="col-6">
            <div class="form-group">
                <label for="">Quiz Name</label>
                <input name="q_name" type="text" class="form-control" required autofocus>
            </div>
            <div class="form-group">
                <label for="">Class</label>
                <select name="class_id" id="class_id" class="form-control">
                    @foreach ($classes as $classe)
                    <option value="{{ $classe->class_id }}">{{ $classe->subject->subject_desc }} ({{ $classe->course_sec }})</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-12" id="question">
            <h3>Questions</h3>
            <div class="row">
                <div class="col-8">
                    <label for="">Question</label>
                    <textarea class="form-control"name="question[0]" id="" cols="30" rows="5" placeholder="Input question here..."></textarea>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label for="">Question Type</label>

                        <select name="qt[0]" id="qt-0" class="form-control qt" >
                            <option value="0">---Select a question type---</option>
                            <option value="1">Identification</option>
                            <option value="2">Multiple Choice</option>
                            <option value="3">True or False</option>
                        </select>
                    </div>
                    <div class="form-group" id="removeOnAdd">
                        <button type="button" class="btn btn-primary btn-sm" onclick="addQuestion(0)">Add</button>
                    </div>
                </div>
                
                <div class="col-6" id="i-0" style="padding-top: 10px; display: none">
                    <label for="">Correct answer</label>
                    <input name="i[0]" type="text" class="form-control">
                </div>
                <div class="multiple-choice" id="mc-0" style="display: none">
                    <div class="col-12" style="padding-top: 10px;">
                        <div class="row">
                            <div class="col-3"><label>Choice 1</label><input name="mc[0][0]" type="text" class="form-control"></div>
                            <div class="col-3"><label>Choice 2</label><input name="mc[0][1]" type="text" class="form-control"></div>
                            <div class="col-3"><label>Choice 3</label><input name="mc[0][2]" type="text" class="form-control"></div>
                            <div class="col-3"><label>Choice 4</label><input name="mc[0][3]" type="text" class="form-control"></div>
                        </div>
                        <div class="row" style="padding-top: 10px;">
                            <div class="col-8">
                                <label for="">Correct choice</label>
                                <select name="c-mc[0]" id="c-mc[0]" class="form-control">
                                    <option value="0">Choice 1</option>
                                    <option value="1">Choice 2</option>
                                    <option value="2">Choice 3</option>
                                    <option value="3">Choice 4</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-3" id="tf-0" style="padding-top: 10px;  display: none">
                    <label for="">Correct answer</label>
                    <select name="tf[0]" id="" class="form-control">
                        <option value="1">True</option>
                        <option value="0">False</option>
                    </select>
                </div>
                <script>
                    $("#qt-0").change(function () {
                        $("#i-0").css('display', 'none');
                        $("#mc-0").css('display', 'none');
                        $("#tf-0").css('display', 'none');

                        if($(this).val() == 1){
                            $("#i-0").css('display', 'inline');
                        }
                        else if ($(this).val() == 2){
                             $("#mc-0").css('display', 'inline');
                        }
                        else if($(this).val() == 3){
                            $("#tf-0").css('display', 'inline');
                        }
                    });
                </script>
            </div>
            <hr>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Submit</button>
        </div>
    </form>
</div>
<script>
    var template = jQuery.validator.format(`
        <div class="row">
                <div class="col-8">
                    <label for="">Question</label>
                    <textarea class="form-control"name="question[{0}]" id="" cols="30" rows="5" placeholder="Input question here..."></textarea>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label for="">Question Type</label>

                        <select name="qt[{0}]" id="qt-{0}" class="form-control qt" >
                            <option value="0">---Select a question type---</option>
                            <option value="1">Identification</option>
                            <option value="2">Multiple Choice</option>
                            <option value="3">True or False</option>
                        </select>
                    </div>
                    <div class="form-group" id="removeOnAdd">
                        <button type="button" class="btn btn-primary btn-sm" onclick="addQuestion(1)">Add</button>
                    </div>
                </div>
                
                <div class="col-6" id="i-{0}" style="padding-top: 10px; display: none">
                    <label for="">Correct answer</label>
                    <input name="i[{0}]" type="text" class="form-control">
                </div>
                <div class="multiple-choice" id="mc-{0}" style="display: none">
                    <div class="col-12" style="padding-top: 10px;">
                        <div class="row">
                            <div class="col-3"><label>Choice 1</label><input name="mc[{0}][0]" type="text" class="form-control"></div>
                            <div class="col-3"><label>Choice 2</label><input name="mc[{0}][1]" type="text" class="form-control"></div>
                            <div class="col-3"><label>Choice 3</label><input name="mc[{0}][2]" type="text" class="form-control"></div>
                            <div class="col-3"><label>Choice 4</label><input name="mc[{0}][3]" type="text" class="form-control"></div>
                        </div>
                        <div class="row" style="padding-top: 10px;">
                            <div class="col-8">
                                <label for="">Correct choice</label>
                                <select name="c-mc[{0}]" id="c-mc[{0}]" class="form-control">
                                    <option value="0">Choice 1</option>
                                    <option value="1">Choice 2</option>
                                    <option value="2">Choice 3</option>
                                    <option value="3">Choice 4</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-3" id="tf-{0}" style="padding-top: 10px;  display: none">
                    <label for="">Correct answer</label>
                    <select name="tf[{0}]" id="" class="form-control">
                        <option value="1">True</option>
                        <option value="0">False</option>
                    </select>
                </div>
                <script>
                    $("#qt-{0}").change(function () {
                        $("#i-{0}").css('display', 'none');
                        $("#mc-{0}").css('display', 'none');
                        $("#tf-{0}").css('display', 'none');

                        if($(this).val() == 1){
                            $("#i-{0}").css('display', 'inline');
                        }
                        else if ($(this).val() == 2){
                             $("#mc-{0}").css('display', 'inline');
                        }
                        else if($(this).val() == 3){
                            $("#tf-{0}").css('display', 'inline');
                        }
                    });
                <\/script>
        </div>
        <hr>
    `);
    function addQuestion(id){
        var newId = id + 1;
        // $('#removeOnAdd').remove();
        $('#question').append(template(newId));
    }
</script>

@endsection