<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuizEvent extends Model
{
    protected $table = "quiz_events";
    protected $primaryKey = "quiz_event_id";
    // public $timestamps = false;

    protected $fillable = [
        'quiz_event_name',
        'questionnaire_id',
        'class_id',
        'quiz_event_status'
    ];
}
