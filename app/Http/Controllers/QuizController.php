<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use Illuminate\Support\Facades\DB;

use App\Classe;
// use App\Question;
// use App\Questionnaire;
// use App\QuizEvent;
// use App\StudentClass;
// use App\Subject;

class QuizController extends Controller
{
    public function RedirectToAppropriatePanel()
    {
        $id = Auth::user()->usr_id;
        if (Auth::user()->permissions == 1)
        {
            // $quiz_events = QuizEvent::where('student_id', $id)->toSql();
            //Returns the view while also passing 'variable'
            //return view('quiz-admin-panel',compact('quiz_event'));
            // return $quiz_events;
            // $my_class = Classe::find(1)->users;
            // $output = Classe::where("instructor_id", $id);
            // var_dump($output);
            $classes = DB::table('classes')
                        ->join('student_classes', 'student_classes.class_id', '=', 'classes.class_id')
                        ->join('subjects', 'subjects.subject_id', '=', 'classes.subject_id')
                        ->where('classes.instructor_id', $id)
                        ->get();

            return view('quiz-admin-panel', compact('classes'));
        }
        else
        {
            return view('quiz-student-panel');
        }
    }
}
