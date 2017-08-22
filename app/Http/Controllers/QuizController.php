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
    public function RedirectToAppropriatePanel(){
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
        if (Auth::user()->permissions == 1)
        {
            return "You're a teacher!";
        }
        $id = Auth::user()->usr_id;
        $verify_quiz = DB::table('quiz_events')
                        ->join('student_classes', 'student_classes.class_id', '=', 'quiz_events.class_id')
                        ->where('student_id', $id)
                        ->where('quiz_event_id', $quiz_id)
                        ->where('quiz_event_status', 1)
                        ->get();
        if ($verify_quiz->count() != 1)
        {
            return abort(403, 'Unauthorized access');
        }
        else
        {
            $quiz_content = DB::table('questions')
                            ->select('question_id', 'question_name', 'choices', 'question_type')
                            ->join('questionnaires', 'questionnaires.questionnaire_id', '=', 'questions.questionnaire_id')
                            ->join('quiz_events', 'quiz_events.questionnaire_id', '=', 'questionnaires.questionnaire_id')
                            ->where('quiz_event_id', $quiz_id)
                            ->get();
            return $quiz_content->shuffle();
            //return view('quiz.quiz-event', compact('quiz_id'));
        }
    }


}
