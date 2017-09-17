<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentScore extends Model
{
    protected $table = "quiz_student_score";
    protected $primaryKey = null;
    public $timestamps = false;

    protected $fillable = [
        'student_id',
        'quiz_event_id',
        'score',
        'recorded_on'
    ];
}
