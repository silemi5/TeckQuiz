<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use Illuminate\Support\Facades\DB;

//use App\Classe;
// use App\Question;
// use App\Questionnaire;
// use App\QuizEvent;
// use App\StudentClass;
// use App\Subject;

class QuizController extends Controller
{
    public function RedirectToAppropriatePanel(){
        $id = Auth::user()->usr_id;//gets the id of the user
        if (Auth::user()->permissions == 1){//The user is a teacher
            $classes = DB::table('classes')
                        ->join('subjects', 'subjects.subject_id', '=', 'classes.subject_id')
                        ->where('classes.instructor_id', $id)
                        ->where('class_active', true)
                        ->get();

            $quiz_events = DB::table('quiz_events')
                            ->join('classes', 'quiz_events.class_id', '=', 'classes.class_id')
                            ->join('subjects', 'subjects.subject_id', '=', 'classes.subject_id')
                            ->where('classes.instructor_id', $id)
                            ->where('quiz_event_status', 0)//upcoming
                            ->orWhere('quiz_event_status', 1)//pending
                            ->get();

            return view('quiz-admin-panel', compact('classes'), compact('quiz_events'));
        }
        else{//The user is a student
            $upcoming_quiz = DB::table('quiz_events')
                            ->join('classes', 'quiz_events.class_id', '=', 'classes.class_id')
                            ->join('subjects', 'subjects.subject_id', '=', 'classes.subject_id')
                            ->join('student_classes', 'student_classes.class_id', '=', 'quiz_events.class_id')
                            ->where('student_id', $id)
                            ->where('quiz_event_status', 0)
                            ->get();
            $pending_quiz = DB::table('quiz_events')
                            ->join('classes', 'quiz_events.class_id', '=', 'classes.class_id')
                            ->join('subjects', 'subjects.subject_id', '=', 'classes.subject_id')
                            ->join('student_classes', 'student_classes.class_id', '=', 'quiz_events.class_id')
                            ->where('student_id', $id)
                            ->where('quiz_event_status', 1)
                            ->get();
            $finished_quiz = DB::table('quiz_events')
                            ->join('classes', 'quiz_events.class_id', '=', 'classes.class_id')
                            ->join('subjects', 'subjects.subject_id', '=', 'classes.subject_id')
                            ->join('student_classes', 'student_classes.class_id', '=', 'quiz_events.class_id')
                            ->where('student_id', $id)
                            ->where('quiz_event_status', 2)
                            ->get();
            //return $quiz_events;
            return view('quiz-student-panel', compact('pending_quiz'), compact('upcoming_quiz'), compact('finished_quiz'));
        }
    }

    public function TakeQuiz($quiz_id){
        if (Auth::user()->permissions == 1){
            return "You're a teacher!";
        }
        $id = Auth::user()->usr_id;
        $verify_quiz = DB::table('quiz_events')
                        ->join('student_classes', 'student_classes.class_id', '=', 'quiz_events.class_id')
                        ->where('student_id', $id)
                        ->where('quiz_event_id', $quiz_id)
                        ->where('quiz_event_status', 1)
                        ->get();

        if ($verify_quiz->count() < 1){//Student can't access the quiz if it is not enabled.
            return abort(403, 'Unauthorized access');
        }
        else{
            $quiz = DB::table('quiz_events')
                            ->select('quiz_event_name', 'quiz_event_id')
                            ->where('quiz_event_id', $quiz_id)
                            ->first();
            // return var_dump($quiz_name);               
            $quiz_content = DB::table('questions')
                            ->select('question_id', 'question_name', 'choices', 'question_type')
                            ->join('questionnaires', 'questionnaires.questionnaire_id', '=', 'questions.questionnaire_id')
                            ->join('quiz_events', 'quiz_events.questionnaire_id', '=', 'questionnaires.questionnaire_id')
                            ->where('quiz_event_id', $quiz_id)
                            ->inRandomOrder()
                            ->get();
            //return $quiz_content;
            return view('quiz.quiz-event', compact('quiz_content'), compact('quiz'));
        }
    }

    public function NewQuizEvent(){
        $quiz = [
            "name" => $_POST['quiz_name'],
            "num" => $_POST['questions'],
            "class_id" => $_POST['class_id'],
            "questionnaire" => $_POST['questionnaire']
        ];
        return view('new.new-quiz', compact('quiz'));
    }

    public function AddNewQuizEvent(){
        $quiz_name = $_POST['quiz_name'];
        $class_id = $_POST['class_id'];

        $questions = $_POST['question'];
        $question_type = $_POST['question_type'];

        //Multiple choices
        $mc1 = $_POST['mc1'];
        $mc2 = $_POST['mc2'];
        $mc3 = $_POST['mc3'];
        $mc4 = $_POST['mc4'];
        $c_mc = $_POST['c-mc'];

        $c_tf = $_POST['c-tf'];

        $c_identify = $_POST['c-identify'];

        DB::table('questionnaires')->insert([
            ["questionnaire_name" => "$quiz_name"],
        ]);


        $questionnaire_id = DB::table('questionnaires')->count();

        for($x = 0; $x < count($questions); $x++){
            $n_mc = 0;
            $n_mc = 0;
            $n_tf = 0;
            $n_identify = 0;

            if($question_type[$x] == 1){//Identification
                $choices = "$c_identify[$n_identify]";
                $n_identify++;
            }
            else if($question_type[$x] == 2){//Multiple Choice
                $choices = "$mc1[$n_mc];$mc2[$n_mc];$mc3[$n_mc];$mc4[$n_mc]";
                $n_mc++;
            }
            else if($question_type[$x] == 3){//True or False
                $choices = $c_tf[$n_tf];
                $n_tf++;
            }

            DB::table('questions')->insert([
                [
                    "questionnaire_id" => $questionnaire_id,
                    "question_name" => "$questions[$x]",
                    "question_type" => $question_type[$x],
                    "choices" => "$choices"
                ]
            ]);
        }

        DB::table('quiz_events')->insert([
            [
                "quiz_event_name" => "$quiz_name",
                "questionnaire_id" => $questionnaire_id,
                "class_id" => $class_id,
                "quiz_event_status" => false
            ]
        ]);
        return redirect('quiz');
    }

    public function StartQuizEvent(){
        $quiz_event_id = $_POST['quiz_event_id'];
        try{
            DB::table('quiz_events')
            ->where('quiz_event_id', $quiz_event_id)
            ->update(['quiz_event_status' => 1]);

            return json_encode(["status" => 0]);
        }catch(Exception $e){
            return json_encode(["status" => 1, "message" => "$e"]);
        }
    }
}
