<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use Illuminate\Support\Facades\DB;

use App\Classe;
use App\Question;
use App\Questionnaire;
use App\QuizEvent;
use App\StudentClass;
use App\Subject;

class QuizController extends Controller
{
    public function RedirectToAppropriatePanel()
    {
        $id = Auth::user()->id;
        if (Auth::user()->permissions == 1)
        {
            $id = Auth::user()->id;
            $quiz_event = $id;
            //Returns the view while also passing 'variable'
            return view('quiz-admin-panel',compact('quiz_event'));
            //return $quiz_event;
        }
        else
        {
            return view('quiz-student-panel');
        }
    }
}
