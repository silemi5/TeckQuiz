<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    protected $table = "classses";


    //quiz creator
    public function user()
    {
        return $this->belongsTo("App\User", "usr_id", "instructor_id");
    }

    //student class
    public function studentclass()
    {
        return $this->hasMany("App\StudentClass", "class_id", "class_id");
    }

    
}
