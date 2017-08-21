<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $table = "subjects";
    protected $primaryKey = "subject_id";

    public function classe()
    {
        return $this->belongsTo("App\Classe", "subject_id", "subject_id");
    }
}
