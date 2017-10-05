<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use App\Classe;
use App\Question;
use App\Questionnaire;
use App\QuizEvent;
use App\StudentClass;
use App\StudentScore;
use App\Subject;
use App\UserProfile;
use App\StudentAnswer;

use Illuminate\Support\Facades\DB;

class QuizController extends Controller
{
    public function Home(){
        if (Subject::count() == 0 ){
            return redirect('setup');
        }else{
            return view('home');
        }
    }

    public function InitialSetup(){
        return view('initial-setup');
    }

    public function RedirectToAppropriatePanel(){    
        //TODO: Disable adding of class if no subject
        //TODO: initial setup
        $id = Auth::user()->usr_id;//gets the id of the user
        if (Auth::user()->permissions == 1){//The user is a teacher
            $classes = Classe::with('subject')
                            ->where('instructor_id', $id)
                            ->where('class_active', true)
                            ->get();
                            
            $quiz_events = QuizEvent::with([
                    'classe' => function($q) use($id){
                        $q->where('instructor_id', $id);
                    },
                    'classe.subject'])
                    ->where('quiz_event_status', 0)
                    ->orWhere('quiz_event_status',1)
                    ->get()
                    ->where('classe', '!=', null);

            $finished_quiz_events = QuizEvent::with([
                    'classe' => function($q) use($id){
                        $q->where('instructor_id', $id);
                    },
                    'classe.subject'])
                    ->where('quiz_event_status', 2)
                    ->get()
                    ->where('classe', '!=', '');
            
            return view('quiz-admin-panel', compact('classes', 'quiz_events', 'finished_quiz_events', 'subjects'));
        }
        else{//The user is a student
            $upcoming_quiz = QuizEvent::with([
                    'classe',
                    'classe.student_class' => function ($q) use($id){
                        $q->where('student_id', $id);
                    },
                    'classe.subject'])
                    ->where('quiz_event_status', 0)
                    ->get();    
                            
            // $pending_quiz = DB::table('quiz_events')//Gets pending quiz (quiz_event_status = 1)
            //             ->select('quiz_event_name', 'subject_desc', 'quiz_events.quiz_event_id')
            //             ->join('classes', 'quiz_events.class_id', '=', 'classes.class_id')
            //             ->join('subjects', 'subjects.subject_id', '=', 'classes.subject_id')
            //             ->join('student_classes', 'student_classes.class_id', '=', 'quiz_events.class_id')
            //             ->leftJoin('quiz_student_score', 'student_classes.student_id', '=', 'quiz_student_score.student_id')
            //             ->where('student_classes.student_id', $id)
            //             ->where('quiz_event_status', 1)
            //             ->whereNull('score')
            //             ->get();

            
            $pending_quiz = QuizEvent::with([
                'classe',
                'classe.subject',
                'classe.student_class' => function ($q) use($id){
                    $q->where('student_id', $id);
                },
                'classe.student_class.student_score'])
                ->where('quiz_event_status', 1)
                ->get();

            $finished_quiz = QuizEvent::with([
                    'classe',
                    'classe.subject',
                    'classe.student_class' => function ($q) use($id){
                        $q->where('student_id', $id);
                    },
                    'classe.student_class.student_score'])
                    ->where('quiz_event_status', 2)
                    ->get();

            return view('quiz-student-panel', compact('pending_quiz', 'upcoming_quiz', 'finished_quiz'));
        }
    }

    public function NewQuizEventForm(){
        $quiz = [
                "name" => $_POST['quiz_name'],
                "num" => $_POST['questions'],
                "class_id" => $_POST['class_id'],
                "questionnaire" => $_POST['questionnaire']
            ];
        if ($quiz["questionnaire"] == 2){
            $quiz = [
                "name" => $_POST['quiz_name'],
                "num" => $_POST['questions'],
                "class_id" => $_POST['class_id'],
                "questionnaire" => $_POST['questionnaire']
            ];
            $questionnaires = Questionnaire::all();
            return view('create.quiz-event', compact('quiz', 'questionnaires'));
        }else{
            return view('create.quiz-event', compact('quiz'));
        }
        
    }

    public function CreateQuizEvent(){
        $qid = -1;
        if($_POST['q_type'] == 1){
            $quiz_name = $_POST['quiz_name'];
            $class_id = $_POST['class_id'];
            $questions = $_POST['question'];
            $question_type = $_POST['question_type'];

            //Multiple choices
            $mc = $_POST['mc'];
            $c_mc = $_POST['c-mc'];

            //Correct True or False
            $c_tf = $_POST['c-tf'];

            //Correct Identification
            $c_identify = $_POST['c-identify'];


            DB::table('questionnaires')->insert([//Puts a questionnaire entry
                ["questionnaire_name" => "$quiz_name", "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ]);


            $questionnaire_id = DB::table('questionnaires')->count();
            $n_mc = 0;
            $n_mc = 0;
            $n_tf = 0;
            $n_identify = 0;
            

            for($x = 0; $x < count($questions); $x++){
                $answer = "";
                $choices = "";

                if($question_type[$x] == 1){//Identification
                    $choices = "";
                    $answer = $c_identify[$n_identify];
                    $n_identify++;
                }
                else if($question_type[$x] == 2){//Multiple Choice
                    $choices = $mc[$x][0] . ";" . $mc[$x][1] . ";" . $mc[$x][2] . ";" . $mc[$x][3];
                    $answer = $c_mc[$n_mc];
                    $n_mc++;
                }
                else if($question_type[$x] == 3){//True or False
                    $choices = "";
                    $answer = $c_tf[$n_tf];
                    $n_tf++;
                }   

                DB::table('questions')->insert([
                    [
                        "questionnaire_id" => $questionnaire_id,
                        "question_name" => "$questions[$x]",
                        "question_type" => $question_type[$x],
                        "choices" => "$choices",
                        "answer" => "$answer"
                    ]
                ]);
            }

            $qid = $questionnaire_id;
        }elseif($_POST['q_type'] == 2){
            $qid = $_POST['q_id'];
        }
        
        
        DB::table('quiz_events')->insert([
            [
                "quiz_event_name" => "$quiz_name",
                "questionnaire_id" => $qid,
                "class_id" => $class_id,
                "quiz_event_status" => 0,
                "created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now()
            ]
        ]);
        return redirect('panel');
    }

    public function ChangeQuizEventStatus(){
        $quiz_event_id = $_POST['quiz_event_id'];
        $q_status = $_POST['quiz_status'];

        try{
            $q_e = QuizEvent::find($quiz_event_id);
            $q_e->quiz_event_status = $q_status;
            //$q_e->updated_at = \Carbon\Carbon::now();
            $q_e->save();

            return json_encode(["status" => 0]);
        }catch(Exception $e){
            return json_encode(["status" => 1, "message" => "$e"]);
        }
    }

     public function TakeQuiz($quiz_id){
        $id = Auth::user()->usr_id;

        $user_profile = UserProfile::find($id);

        $QuizTaken = DB::table('quiz_student_score')
                        ->where('student_id', $id)
                        ->where('quiz_event_id', $quiz_id)
                        ->get();

        if($QuizTaken->count() > 0){
            return abort(403, 'Quiz already taken');
        }

        $verify_quiz = DB::table('quiz_events')
                        ->join('student_classes', 'student_classes.class_id', '=', 'quiz_events.class_id')
                        ->where('student_id', $id)
                        ->where('quiz_event_id', $quiz_id)
                        ->where('quiz_event_status', 1)
                        ->get();

        // $verify_quiz = QuizEvent::with('student_class', 'classe')
        //                 ->get()
        //                 ->where('quiz_event_id', $quiz_id);
                        //return $verify_quiz;

        if ($verify_quiz->count() < 1){
            return abort(403, 'Not enrolled for this class to take the quiz.');
        }elseif($verify_quiz->where('quiz_event_status', 1)->count() < 1){
            abort(403, 'Quiz not yet started or already ended.');
        }else{
                // $quiz = DB::table('quiz_events')
                //                 ->select('quiz_event_name', 'quiz_events.quiz_event_id', 'course_sec', 'score')
                //                 ->join('classes', 'classes.class_id', '=', 'quiz_events.class_id')
                //                 ->leftJoin('quiz_student_score', 'quiz_events.quiz_event_id', '=', 'quiz_student_score.quiz_event_id')
                //                 ->where('quiz_events.quiz_event_id', '=' , $quiz_id)
                //                 ->whereNull('score')
                //                 ->first();
                $quiz = QuizEvent::find($quiz_id);

                $quiz_content = DB::table('questions')
                                ->select('question_id', 'question_name', 'choices', 'question_type')
                                ->join('questionnaires', 'questionnaires.questionnaire_id', '=', 'questions.questionnaire_id')
                                ->join('quiz_events', 'quiz_events.questionnaire_id', '=', 'questionnaires.questionnaire_id')
                                ->where('quiz_event_id', $quiz_id)
                                ->inRandomOrder()
                                ->get();

                $content = view('quiz.quiz-event', compact('quiz_content', 'quiz', 'user_profile'));

                return response($content)
                            ->header('Cache-Control', 'no-cache, must-revalidate')
                            ->header('Pragma', 'no-cache')
                            ->header('Expires', 'Sat, 01 Jan 2000 00:00:00 GMT');
        }
    }
    
    public function SubmitAnswers(){
        $question_ids = $_POST['question_id'];
        $answers = $_POST['answer'];
        $quiz_event_id = $_POST['quiz_event_id'];
        $student_id = Auth::user()->usr_id;

        $check_exisiting = StudentScore::where('student_id', $student_id)
                            ->where('quiz_event_id', $quiz_event_id)
                            ->count();
                            
        if ($check_exisiting > 0){
            abort(403, 'You already took the quiz.');
        }

        for($x = 1; $x <= count($question_ids); $x++){
            StudentAnswer::create([
                'student_id' => $student_id,
                'quiz_event_id' => $quiz_event_id,
                'question_id' => $question_ids[$x],
                'student_answer' => $answers[$x]
            ]);
        }

        $answers = StudentAnswer::with('question')
                    ->where('student_id', $student_id)
                    ->get();
        $score = 0;
        foreach($answers as $answer){
            if($answer->student_answer == $answer->question->answer)
                $score += $answer->question->points;
        }

        StudentScore::create([
            'student_id' => $student_id,
            'quiz_event_id' => $quiz_event_id,
            'score' => $score,
            'recorded_on' => \Carbon\Carbon::now()
        ]);
     
        return redirect('/quiz/results/' . $quiz_event_id);

    }

    public function ViewClass($class_id){
        if (Auth::user()->permissions == 0){
            abort(403, 'Unauthorized access');
        }
        $quiz_events = DB::table('quiz_events')
                            ->join('classes', 'quiz_events.class_id', '=', 'classes.class_id')
                            ->join('subjects', 'subjects.subject_id', '=', 'classes.subject_id')
                            ->where('classes.class_id', $class_id)
                            ->get();

        $quiz_class = DB::table('classes')
                    ->join('subjects', 'classes.subject_id', '=', 'subjects.subject_id')
                    ->where('instructor_id', Auth::user()->usr_id)
                    ->where('classes.class_id', $class_id)
                    ->first();

        $students = DB::table('student_classes')
                    ->join('user_profiles', 'student_classes.student_id', '=', 'user_profiles.usr_id')
                    ->where('class_id', $class_id)
                    ->orderBy('family_name', 'asc')
                    ->get();
                    
        return view('manage.classes', compact('students', 'quiz_class', 'quiz_events'));
    }

    public function UpdateStudentInfo(){
        $n = [
                "g" => $_POST['g'],
                "f" => $_POST['f'],
                "mi" => $_POST['mi'],
                "ne" => $_POST['ne'],
                "sid" => $_POST['sid'],
        ];

        try{
            DB::table('user_profiles')
            ->where('usr_id', $n['sid'])
            ->update([
                'given_name' => $n['g'],
                'family_name' => $n['f'],
                'middle_name' => $n['mi'],
                'ext_name' => $n['ne']
            ]);

            return json_encode(["status" => 0]);
        }catch(Exception $e){
            return json_encode(["status" => 1, "message" => "$e"]);
        }
    }

    public function ListClass($class_id){
        //
    }

    public function ManageQuizEvent($quiz_id){
        $id = Auth::user()->usr_id;
        
        $quiz_details = QuizEvent::with([
                    'classe' => function($q) use($id){
                        $q->where('instructor_id', $id);
                    },
                    'classe.subject',
                    'questionnaire'])
                    ->where('quiz_event_id', $quiz_id)
                    ->first();

        return view('manage.quiz', compact('quiz_details'));
    }

    public function QuizResults($quiz_id){
        if(Auth::user()->permissions == 1){
            $results = QuizEvent::with('classe.student_class.student_score', 'classe.student_class.user_profile')
                    ->where('quiz_event_id', $quiz_id)
                    ->first();
            return view('manage.quiz-results', compact('results'));
        }else{
            $results = StudentScore::with('quiz_event', 'user_profile')
                        ->where('student_id', Auth::user()->usr_id)
                        ->first();
            return view('quiz.quiz-results', compact('results'));
           // return $results;
        }
        
        //return $results;

        
    }

    public function ManageQuestionnaire($qid){
        $q = Questionnaire::with('question')
                        ->where('questionnaire_id', $qid)
                        ->first();
        // return $q;
        return view('manage.questionnaires', compact('q'));
    }
}
