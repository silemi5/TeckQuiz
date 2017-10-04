@extends('layouts.app') @section('title', 'Manage Questionnaire - TeckQuiz') @section('content')
<style>
    body {
        padding-top: 90px;
    }
</style>
<section class="container">
    <h1>Manage Quiz</h1>
    <b><p>{{ $q->questionnaire_name }}</p></b>
    <hr>
    <div class="row">
        <div class="col-md-9">
            <div class="tab-content" id="v-pills-tabContent">
                <div class="tab-pane fade show active" id="basic-info" role="tabpanel" aria-labelledby="v-pills-home-tab">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad, inventore.
                </div>
                <div class="tab-pane fade" id="questions" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                    <h5>Questions</h5>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Question</th>
                                <th>Question Type</th>
                                <th>Choices</th>
                                <th>Controls</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($q->question as $qe)
                            <tr>
                                <td>{{ $qe->question_name }}</td>
                                <td>
                                    @if($qe->question_type == 1)
                                        Identification
                                    @elseif($qe->question_type == 2)
                                        Multiple choice
                                    @elseif($qe->question_type == 3)
                                        True or False 
                                    @else
                                        <b>Invalid Type</b>
                                    @endif
                                </td>
                                <td>
                                    @php
                                        $a = explode(';', $qe->choices);
                                        foreach ($a as $ch){
                                            echo $ch . '<br>'; 
                                        }
                                    @endphp
                                </td>
                                <td>
                                    @if($qe->question_type == 1)
                                        <button class="btn btn-primary btn-sm"
                                            data-qid="{{ $qe->question_id }}" 
                                            data-question="{{ $qe->question_name }}" 
                                            data-question-type="{{ $qe->question_type }}"
                                            data-correct-ans="{{ $qe->answer }}"
                                            data-points="{{ $qe->points }}"
                                            data-toggle="modal" data-target="#editQuestion">Edit
                                        </button>
                                    @elseif($qe->question_type == 2)
                                        <button class="btn btn-primary btn-sm"
                                            data-qid="{{ $qe->question_id }}" 
                                            data-question="{{ $qe->question_name }}" 
                                            data-question-type="{{ $qe->question_type }}"
                                            data-choices="{{ $qe->choices }}"
                                            data-correct-ans="{{ $qe->answer }}"
                                            data-points="{{ $qe->points }}"
                                            data-toggle="modal" data-target="#editQuestion">Edit
                                        </button>
                                    @elseif($qe->question_type == 3)
                                        <button class="btn btn-primary btn-sm"
                                            data-qid="{{ $qe->question_id }}" 
                                            data-question="{{ $qe->question_name }}" 
                                            data-question-type="{{ $qe->question_type }}"
                                            data-correct-ans="{{ $qe->answer }}"
                                            data-points="{{ $qe->points }}"
                                            data-toggle="modal" data-target="#editQuestion">Edit
                                        </button>
                                    @endif
                                    <button class="btn btn-primary btn-sm btn-danger" 
                                        data-qid="{{ $qe->question_id }}" 
                                        data-toggle="modal" 
                                        data-target="#editQuestion">Delete
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <button class="btn btn-primary btn-sm">Add new question</button>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist">
                <a class="nav-link active" id="basic-info-tab" data-toggle="pill" href="#basic-info" role="tab" aria-controls="v-pills-home"
                    aria-expanded="true">Basic Information</a>
                <a class="nav-link" id="questions-tab" data-toggle="pill" href="#questions" role="tab" aria-controls="v-pills-profile" aria-expanded="true">Questions</a>
            </div>
        </div>


    </div>

</section>

<!-- Modal -->
<div class="modal fade" id="editQuestion" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form action="javascript:submitEditedQuestion" class="form">
                    <div class="form-group">
                        <label for="">Question</label>
                        <textarea id="question" id="" cols="30" rows="3" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Type</label>
                        <select name="" id="opt" class="form-control" required>
                            <option value="1">Identification</option>
                            <option value="2">Multiple Choice</option>
                            <option value="3">True or False</option>
                        </select>
                    </div>
                    <div id="f-multiple-choice" style="display: none;">
                        <div class="form-group form-inline">
                            <input type="text" id="mc0" name="mc[]" class="form-control col-5 mr-auto" placeholder="Choice 1">
                            <input type="text" id="mc1" name="mc[]" class="form-control col-5 ml-auto" placeholder="Choice 2">
                        </div>
                        <div class="form-group form-inline">
                            <input type="text" id="mc2" name="mc[]" class="form-control col-5 mr-auto" placeholder="Choice 3">
                            <input type="text" id="mc3" name="mc[]" class="form-control col-5 ml-auto" placeholder="Choice 4">
                        </div>
                    </div>

                    <div class="form-group" id="cf-identify" style="display: none">
                        <label for="">Correct answer</label>
                        <input type="text" class="form-control" id="c-identify" name="c-identify" placeholder="Correct answer here...">
                    </div>

                    <div class="form-group" id="cf-tf" style="display: none">
                        <label for="">Correct choice</label>
                        <select id="c-tf" class="form-control" name="c-tf">
                            <option value="1">True</option>
                            <option value="0">False</option>
                        </select>
                    </div>

                    <div class="form-group" id="cf-mc" style="display: none">
                        <label for="">Correct choice</label>
                        <select name="c-mc" id="c-mc" class="form-control">
                            <option value="1">Choice 1</option>
                            <option value="2">Choice 2</option>
                            <option value="3">Choice 3</option>
                            <option value="4">Choice 4</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<script>
    $("#opt").change(function () {
            $("#f-multiple-choice").css("display", "none");//Multiple Choice
            $("#cf-mc").css("display", "none");//correct choice
            $("#cf-tf").css("display", "none");//True or False
            $("#cf-identify").css("display", "none");//Identification

            if ($("#opt").val() == 1) {//Identification
                // console.log("Identify");
                $("#cf-identify").css("display", "inline");//Identification
            } else if ($("#opt").val() == 2) {//Multiple choice
                // console.log("Multiple Choice");
                $("#f-multiple-choice").css("display", "inline");//Multiple Choice
                $("#cf-mc").css("display", "inline");//correct choice
            }
            else if ($("#opt").val() == 3) {//True or false
                // console.log("True or False");
                $("#cf-tf").css("display", "inline");//True or False
            }
        });

    $('#editQuestion').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var qid = button.data('qid')
        var question = button.data('question')
        var qtype = button.data('question-type')
        var choices = button.data('choices')
        var ans = button.data('correct-ans')

        var modal = $(this)
        modal.find('#question').val(question)
        modal.find('#opt').val(qtype)
        $("#opt").trigger("change")

        if ($("#opt").val() == 1){//Identification
            console.log("Identify")
            modal.find("#c-identify").val(ans)
        }else if ($("#opt").val() == 2){//Multiple Choice
            console.log("MC")
            var ch = choices.split(";");
            $("#mc0").val(ch[0])
            $("#mc1").val(ch[1])
            $("#mc2").val(ch[2])
            $("#mc3").val(ch[3])
        }else if ($("#opt").val() == 3){//True or False
            console.log(ans)
            modal.find("#c-tf").val(ans)
        }
    });

    // $('#UpdateProfile').click(function () {
    //     var modal = $(this)
    //     var g = $('#g-name').val()
    //     var f = $('#f-name').val()
    //     var mi = $('#mi-name').val()
    //     var ne = $('#ne-name').val()
    //     var sid = $('#usrid').val()
    //     var act = $('#act').val()

    //     $.ajax({
    //         url: '/student/update',
    //         type: 'POST',
    //         data: {
    //             g,
    //             f,
    //             mi,
    //             ne,
    //             sid,
    //             act
    //         },
    //         success: function (result) {
    //             location.reload(true);
    //         }
    //     });
    // });

</script>

@endsection