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
}
