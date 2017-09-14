<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    protected $table = "classes";
    protected $primaryKey = "class_id";
    public $timestamps = false;

    protected $fillable = [
        'instructor_id',
        'course_sec',
        'subject_id',
        'class_active'
    ];
}
