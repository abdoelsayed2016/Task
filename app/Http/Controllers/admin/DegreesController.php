<?php

namespace App\Http\Controllers\admin;

use App\Registeration;
use App\Semester;
use App\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DegreesController extends Controller
{
    public function index()
    {
        $students=Student::all();
        return view('admin.degrees.index',compact('students'));
    }
    public function semesters(Request $request)
    {
        $id= $request->id;
        $Registerations=Registeration::where('student_id',$id)->get()->pluck('semester_id');
        $semesters=Semester::whereIn('id',$Registerations)->get();
        return response()->json($semesters, 200);

    }
    public function marks(Request $request)
    {
        $semester= $request->id;
        $student=$request->student;
        $registeration=Registeration::where('student_id',$student)->where('semester_id',$semester)->first();
//        echo $semester. " ".$student;
//        echo $registeration->id;
        $marks=$registeration->marks;
//        dd($marks);
        $arr=[];
        foreach ($marks as $mark)
        {
            $arr[]=['subject' =>$mark->subject->name,'mark'=>$mark->mark];

        }
        return response()->json($arr, 200);

    }

}
