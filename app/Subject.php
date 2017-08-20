<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    public function class()
    {
    	return $this->belongsTo(Class::class);
    }
}
