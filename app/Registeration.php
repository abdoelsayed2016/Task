<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Registeration extends Model
{
    public function semester()
    {
        return $this->belongsTo('App\Semester','semester_id');
    }
    public function student()
    {
        return $this->belongsTo('App\Student','student_id');
    }
    public function marks()
    {
        return $this->hasMany('App\Mark','registerations');

    }
}
