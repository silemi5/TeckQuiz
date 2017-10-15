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
        return view('home');
    }

    public function RedirectToAppropriatePanel(){    
        //TODO: Disable adding of class if no subject
        //TODO: initial setup
        $id = Auth::user()->usr_id;//gets the id of the user
        if (Auth::user()->permissions == 0){//The user is the administrator
            $subjects = Subject::all();
            $classes = Classe::with('subject')
                            ->where('class_active', true)
                            ->get();
                            
            $quiz_events = QuizEvent::with([
                    'classe',
                    'classe.subject'])
                    ->where('quiz_event_status', 0)
                    ->orWhere('quiz_event_status',1)
                    ->get()
                    ->where('classe', '!=', null);

            $finished_quiz_events = QuizEvent::with([
                    'classe',
                    'classe.subject'])
                    ->where('quiz_event_status', 2)
                    ->get()
                    ->where('classe', '!=', '');
            
            return view('quiz-admin-panel', compact('classes', 'quiz_events', 'finished_quiz_events', 'subjects'));
        }
        else if (Auth::user()->permissions == 1){//The user is a teacher
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
            
            return view('quiz-teacher-panel', compact('classes', 'quiz_events', 'finished_quiz_events', 'subjects'));
        }
        else if (Auth::user()->permissions == 2){//The user is a student
            $upcoming_quiz = QuizEvent::with([
                    'classe',
                    'classe.student_class' => function ($q) use($id){
                        $q->where('student_id', $id);
                    },
                    'classe.subject'])
                    ->where('quiz_event_status', 0)
                    ->get();
            
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
/* DISABLED
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
*/
}
