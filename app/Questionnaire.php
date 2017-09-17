<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Questionnaire extends Model
{
    protected $table = "questionnaires";
    protected $primaryKey = "questionnaire_id";
    // public $timestamps = false;

    protected $fillable = [
        'questionnaire_name'
}
