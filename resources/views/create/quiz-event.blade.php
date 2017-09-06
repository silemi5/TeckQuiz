@extends('layouts.app')
@section('title', 'Quiz Dashboard - TeckQuiz')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <h3>New Quiz Event</h3>
                <p>{{ $quiz['name'] }}</p>
                <hr>
                @if ($quiz['questionnaire'] == 1)
                    <!-- TODO: Display quiz name and subject -->
                    <form action="/new/quiz/add" class="form" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="quiz_name" value="{{ $quiz['name'] }}">
                        <input type="hidden" name="class_id" value="{{ $quiz['class_id'] }}">
                        @for($x = 1; $x <= $quiz['num']; $x++)
                        <h5>Question #{{ $x }}</h5>
                            <div class="form-group">
                                <label for="">Question</label><textarea class="form-control" name="question[]" id="" cols="30" rows="5" placeholder="Input question here..."></textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Question Type</label>
                                
                                <select name="question_type[]" id="opt{{ $x }}" class="form-control" id="">
                                    <option value="1">Identification</option>
                                    <option value="2">Multiple Choice</option>
                                    <option value="3">True or False</option>
                                </select>
                            </div>
                            
                            <div id="multiple-choice{{ $x }}" style="display: none;">
                                <div class="form-group">
                                    <input type="text" name="mc1[]"  class="form-control" placeholder="Choice 1">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="mc2[]"  class="form-control" placeholder="Choice 2">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="mc3[]"  class="form-control" placeholder="Choice 3">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="mc4[]"  class="form-control" placeholder="Choice 4">
                                </div>
                            </div>

                            <div class="form-group" id="c-identify{{ $x }}" style="display: none">
                                <label for="">Correct answer</label>
                                <input type="text" class="form-control" id="c-identify[]" name="c-identify[]" placeholder="Correct answer here...">
                            </div>

                            <div class="form-group" id="c-tf{{ $x }}" style="display: none">
                                <label for="">Correct choice</label>
                                <select id="c-tf[]" class="form-control" name="c-tf[]">
                                    <option value="0">True</option>
                                    <option value="1">False</option>
                                </select>
                            </div>

                            <div class="form-group" id="c-mc{{ $x }}" style="display: none">
                                <label for="">Correct choice</label>
                                <select name="c-mc[]" id="c-mc[]" class="form-control">
                                    <option value="1">Choice 1</option>
                                    <option value="2">Choice 2</option>
                                    <option value="3">Choice 3</option>
                                    <option value="4">Choice 4</option>
                                </select>
                            </div>      
                            
                            <hr>
                            <script>
                                $("#opt" + "{{ $x }}").change(function(){
                                    $("#multiple-choice" + "{{ $x }}").css("display", "none");//Multiple Choice
                                    $("#c-mc" + "{{ $x }}").css("display", "none");//correct choice

                                    $("#c-tf" + "{{ $x }}").css("display", "none");//True or False

                                    $("#c-identify" + "{{ $x }}").css("display", "none");//Identification

                                    if ($("#opt" + "{{ $x }}").val() == 1) {//Identification
                                        // console.log("Identify");
                                        $("#c-identify" + "{{ $x }}").css("display", "inline");//Identification
                                    }else if($("#opt" + "{{ $x }}").val() == 2){//Multiple choice
                                        // console.log("Multiple Choice");
                                        $("#multiple-choice" + "{{ $x }}").css("display", "inline");//Multiple Choice
                                        $("#c-mc" + "{{ $x }}").css("display", "inline");//correct choice
                                    }
                                    else if ($("#opt" + "{{ $x }}").val() == 3){//True or false
                                        // console.log("True or False");
                                        $("#c-tf" + "{{ $x }}").css("display", "inline");//True or False
                                    }
                                });
                            </script>
                        @endfor
                        <button class="btn btn-primary" type="submit">
                            Add new quiz
                        </button>
                    </form>
                @else
                    <h1>lol</h1>
                @endif
            </div>
        </div>
    </div>
@endsection