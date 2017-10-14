<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Question;

class QuestionController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $question = new Question;
        $question->questionnaire_id = $request->input('q_id');
        $question->question_name = $request->input('q_name');
        $question->question_type = $request->input('q_type');
        $question->choices = $request->input('choices');
        $question->answer = $request->input('q_ans');
        $question->save();
        return "DONE";
        // return $request->input('questionnaire_id');
    }

    /**
     * Updates the specified question in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        $question = Question::find($id);
        $question->question_name = $request->input('q_name');
        $question->question_type = $request->input('q_type');
        $question->choices = $request->input('choices');
        $question->answer = $request->input('q_ans');
        $question->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        Question::destroy($id);
    }
}
