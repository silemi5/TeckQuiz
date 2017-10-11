@extends('layouts.app')
@section('title', 'Manage Quiz - TeckQuiz')
@section('content')
<style>
    body {
        padding-top: 90px;
    }
</style>
<section class="container">
    <h1>Manage Quiz</h1>
    <hr>
    <div class="row">
        <div class="col-lg-9">
            <h3>{{ $quiz_details->quiz_event_name }}</h3>
            <p>This is some basic information about the quiz.</p>
            <p>Class: <b><a href="/manage/class/view{{ $quiz_details->class_id }}"></a>{{ $quiz_details->classe->course_sec }}</b></p>
            <p>Subject: <b>{{ $quiz_details->classe->subject->subject_desc }}</b></p>
            <p>Questionnaire: <b><a href="/manage/questionnaire/{{ $quiz_details->questionnaire->questionnaire_id }}">{{ $quiz_details->questionnaire->questionnaire_name }}</a></b></p>
        </div>
        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            function ChangeQuizStatus(quiz_event_id, quiz_status) {
                $.post("/quiz/changestatus", { quiz_event_id, quiz_status }, function (data) {
                    var response = jQuery.parseJSON(data)
                    var qid = quiz_event_id
                    if (response.status == 0) {
                        if (quiz_status == 0) {//Disables the quiz
                            $("#quiz_actions").html("<button href=\"\" onclick=\"javascript:ChangeQuizStatus(" + quiz_event_id + ", 1)\" class=\"btn btn-primary\">Enable Quiz</button>");
                        } else if (quiz_status == 1) {//Enables the quiz
                            $("#quiz_actions").html("<button href=\"\" onclick=\"javascript:ChangeQuizStatus(" + quiz_event_id + ", 0)\" class=\"btn btn-primary\">Disable Quiz</button> <button href=\"\" onclick=\"javascript:ChangeQuizStatus(" + quiz_event_id + ", 2)\" class=\"btn btn-primary btn-danger\">End Quiz</button>");
                        } else if (quiz_status == 2) {//Ends the quiz
                            $("#quiz_actions").html("ENDED");
                            //$("#quiz_actions" ).hide();
                        }
                    } else {
                        alert("Something happened! Quiz not started!");
                    }
                });
            }
        </script>
        <div class="col-lg-3" id="quiz_actions">
            @if($quiz_details->quiz_event_status == 0)
                <button href="" onclick="javascript:ChangeQuizStatus({{ $quiz_details->quiz_event_id }}, 1)" class="btn btn-primary">Enable Quiz</button>
            @elseif($quiz_details->quiz_event_status == 1)
                <button href="" onclick="javascript:ChangeQuizStatus({{ $quiz_details->quiz_event_id }}, 0)" class="btn btn-primary">Disable Quiz</button>
                <button href="" onclick="javascript:ChangeQuizStatus({{ $quiz_details->quiz_event_id }}, 2)" class="btn btn-primary btn-danger">End Quiz</button>
            @endif
        </div>
    </div>

</section>

@endsection