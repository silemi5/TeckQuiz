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
            $subjects = Subject::all();
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
     
        return redirect('/quiz/' . $quiz_event_id);

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
        }
    }

    public function ManageQuestionnaire($qid){
        $q = Questionnaire::with('question')
                        ->where('questionnaire_id', $qid)
                        ->first();
        // return $q;
        return view('manage.questionnaires', compact('q'));
    }
    
    public function ManageSubjects(){
        $subjects = Subject::with('classe')->get();
        //return $subjects;
        return view('manage.subjects', compact('subjects'));
    }
}
