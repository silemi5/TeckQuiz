<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $table = "user_profiles";
    protected $primaryKey = "usr_id";
    public $timestamps = false;

    protected $fillable = [
        'given_name',
        'family_name',
        'middle_name',
        'ext_name'
    ];
}
