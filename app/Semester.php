<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    public function subjects()
    {
        return $this->hasMany('App\Subject','semester_id');
    }
    public function registerations()
    {
        return $this->hasMany('App\Registeration','semester_id');
    }
}
