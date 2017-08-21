<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    protected $table = "classes";
    protected $primaryKey = "class_id";

    //quiz creator
    public function user()
    {
        return $this->belongsTo("App\User", "instructor_id", "usr_id");
    }

    //student class
    public function studentclass()
    {
        return $this->hasMany("App\StudentClass", "class_id", "class_id");
    }
    
    public function subject()
    {
        return $this->hasMany("App\Subject", "subject_id", "subject_id");
    }

    // public function quizevent()
    // {
        
    // }
}
