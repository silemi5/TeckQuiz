<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classe;
use App\Questionnaire;
use App\Question;
use App\QuizEvent;
use App\StudentScore;

use Auth;

class QuizEventController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Show the form for creating a new quiz event.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $classes = Classe::all();
        return view('create.quiz-event', compact('classes'));
    }

    /**
     * Store a newly created quiz event in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $quiz_name = $request->input('q_name');
        $class_code = $request->input('class_id');

        $questions = $request->input('question'); //Question
        $types = $request->input('qt'); //Question types

        $i = $request->input('i'); //Correct answer for identification
        $mc = $request->input('mc'); //Choices for multiple choice
        $c_mc = $request->input('c-mc'); //Correct choice
        $tf = $request->input('tf'); //Correct answer for true or false

        $p = $request->input('points'); //Question point

        Questionnaire::create([
            'questionnaire_name' => $quiz_name,
        ]);

        $q_id = Questionnaire::count(); //Questionnaire id.

        for($x = 0; $x < count($questions); $x++){
            $question = $questions[$x];
            $choices = ""; //For multiple choice use.
            $answer = null; //Obviously.
            $points = $p[$x];

            if($types[$x] == 0){
                //ERROR
            }else if ($types[$x] == 1){//Identification
                $answer = $i[$x];
            }else if($types[$x] == 2){//Multiple choice
                $choices = $mc[$x][0] . ";" . $mc[$x][1] . ";" . $mc[$x][2] . ";" . $mc[$x][3];
                $answer = $c_mc[$x];
            }else if($types[$x] == 3){//True or False
                $answer = $tf[$x];
            }

            if(trim($question) == "" || is_null($question))
                continue;

            Question::create([
                'questionnaire_id' => $q_id,
                'question_name' => $question,
                'question_type' => $types[$x],
                'choices' => $choices,
                'answer' => $answer,
                'points' => $points
            ]);
        }

        QuizEvent::create([
            'quiz_event_name' => $quiz_name,
            'questionnaire_id' => $q_id,
            'class_id' => $class_code,
            'quiz_event_status' => 0,
        ]);

        return redirect('/panel');
    }

    /**
     * Displays the specified quiz event.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        if(Auth::user()->permissions < 2){
            $usr_id = Auth::user()->usr_id;
        
            $quiz_details = QuizEvent::with([
                        'classe',
                        'classe.subject',
                        'questionnaire'])
                        ->where('quiz_event_id', $id)
                        ->first();

            $results = QuizEvent::with([
                    'classe.student_class.student_score' => function ($q) use($id){
                        $q->where('quiz_event_id', $id);
                    },
                    'classe.student_class.user_profile'])
                    ->where('quiz_event_id', $id)
                    ->first();

            $qtn_id = QuizEvent::find($id)->questionnaire_id;
            $sum = Question::where('questionnaire_id', $qtn_id)->sum('points');

            return view('manage.quiz', compact('quiz_details', 'results', 'sum'));
        }else{
            $results = StudentScore::with('quiz_event', 'user_profile')
                        ->where('student_id', Auth::user()->usr_id)
                        ->first();

            $qtn_id = QuizEvent::find($id)->questionnaire_id;
            $sum = Question::where('questionnaire_id', $qtn_id)->sum('points');

            return view('quiz.results', compact('results', 'sum'));
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        $quiz = QuizEvent::find($id);
        $quiz->quiz_event_status = $request->input('quiz_status');
        $quiz->save();
        //return "ID: $id" . "\n" . $request->input('quiz_status');
    }
}
