<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Class extends Model
{
    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function subject()
    {
    	return $this->belongsTo(Subject::class);
    }

    public function quizevent()
    {
    	return $this->belongsTo(QuizEvent::class);
    }
}

