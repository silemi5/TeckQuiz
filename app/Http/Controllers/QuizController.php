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
            $classes = DB::table('classes')
                        ->join('subjects', 'subjects.subject_id', '=', 'classes.subject_id')
                        ->where('classes.instructor_id', $id)
                        ->where('class_active', true)
                        ->get();

            $quiz_events = DB::table('quiz_events')
                            ->join('classes', 'quiz_events.class_id', '=', 'classes.class_id')
                            ->join('subjects', 'subjects.subject_id', '=', 'classes.subject_id')
                            ->where('classes.instructor_id', $id)
                            ->where('quiz_event_status', 0)
                            ->get();

            return view('quiz-admin-panel', compact('classes'), compact('quiz_events'));
        }
        else
        {
            return view('quiz-student-panel');
        }
    }
}
