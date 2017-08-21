<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentClass extends Model
{
    protected $table = "student_classes";
    protected $primaryKey = null;

    public function user()
    {
        $this->hasMany("App\User", "user_id", "student_id");
    }

    public function classe()
    {
        $this->hasOne("App\Classe", "class_id", "class_id");
    }
}
