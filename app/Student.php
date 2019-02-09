<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
    public function registerations()
    {
        return $this->hasMany('App\Registeration','student_id');
    }
}
