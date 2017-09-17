<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentClass extends Model
{
    protected $table = "student_classes";
    protected $primaryKey = null;
    public $timestamps = false;

    protected $fillable = [
        'class_id',
        'student_id'
    ];
    
    public function classe(){
        return $this->belongsTo('App\Classe', 'class_id', 'class_id');
    }

    public function student_score(){
        return $this->hasOne('App\StudentScore', 'student_id', 'student_id');
    }
}
