<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Questionnaire extends Model
{
    public function question()
    {
    	return $this->belongsTo(Question::class);
    }

    public function quizevent()
    {
    	return $this->belongsTo(QuizEvent::class);
    }
}
