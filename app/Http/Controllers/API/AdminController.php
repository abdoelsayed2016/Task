<?php

namespace App\Http\Controllers\API;

use App\Semester;
use App\Student;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function students(){
        $users=User::where('role',2)->get();
        return response()->json(['students' => $users],200);

    }
    public function grades(Semester $semester){
        $registerations=$semester->registerations;
        $arr=[];
        foreach ($registerations as $reg)
        {
            $subject=[];
            $marks=$reg->marks;
            foreach ($marks as $mark)
            {
                $subject[]=['subject'=>$mark->subject->name,'mark'=>$mark->mark];
            }
            $arr[]=[
                'student'=>$reg->student->user->name,
                'subject'=>$subject
            ];

        }
        return response()->json(['data' => $arr],200);


    }

}
