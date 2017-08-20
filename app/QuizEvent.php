<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuizEvent extends Model
{
    public function questionnaire()
    {
    	return $this->belongsTo(Questionnaire::class);
    }

    public function class()
    {
    	return $this->belongsTo(Class::class);
    }
}
