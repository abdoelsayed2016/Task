<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Mark;
use App\Registeration;
use App\Semester;
use App\Student;
use Illuminate\Http\Request;

class RegisterationController extends Controller
{
    public function index()
    {
        $registerations = Registeration::all();
        return view('admin.registerations.index', compact('registerations'));

    }//end of index

    public function create()
    {
        $semesters = Semester::all();
        $students = Student::all();
        return view('admin.registerations.create', compact('semesters', 'students'));

    }//end of create

    public function store(Request $request)
    {

        $Registeration = Registeration::where('student_id', $request->student_id)->where('semester_id', $request->semester_id)->first();
        if ($Registeration) {
            \Session::flash('message', "Student Register Before in same Semester");

            return back()->withInput($request->input());

        } else {
            $Registeration = new Registeration();
            $Registeration->student_id = $request->student_id;
            $Registeration->semester_id = $request->semester_id;
            $Registeration->save();
        }


        return redirect()->route('registerations.index');

    }//end of store

    public function edit(Registeration $registeration)
    {
        $semesters = Semester::all();
        $students = Student::all();

        return view('admin.registerations.edit', compact('semesters', 'students', 'registeration'));

    }//end of edit

    public function update(Request $request, Registeration $registeration)
    {

        if ($request->student_id != $registeration->student_id || $request->semester_id != $registeration->semester_id) {
            $Registeration = Registeration::where('student_id', $request->student_id)->where('semester_id', $request->semester_id)->first();
            if ($Registeration) {
                \Session::flash('message', "Student Register Before in same Semester");

                return back()->withInput($request->input());
            } else {
                $registeration->student_id = $request->student_id;
                $registeration->semester_id = $request->semester_id;
                $registeration->save();
            }
        }
        return redirect()->route('registerations.index');

    }//end of update

    public function destroy(Registeration $registeration)
    {

        $marks=$registeration->marks;
        foreach ($marks as $mark)
        {
            $mark->delete();
        }
        $registeration->delete();
        return redirect()->route('registerations.index');

    }//end of destroy

    public function marks(Registeration $registeration)
    {
        $subjects = $registeration->semester->subjects;

        return view('admin.registerations.marks', compact('registeration', 'subjects'));
    }

    public function postMarks(Request $request,Registeration $registeration )
    {
//        dd($registeration);
        foreach ($request->subject as $k=>$v)
        {
            $mark=Mark::where('registerations',$registeration->id)->where('subject_id',$v)->first();
            if($mark)
            {
                $mark->registerations=$registeration->id;
                $mark->subject_id=$v;
                $mark->mark=$request->degree[$k];
                $mark->save();
            }else
            {
                $mark=new Mark();
                $mark->registerations=$registeration->id;
                $mark->subject_id=$v;
                $mark->mark=$request->degree[$k];
                $mark->save();
            }

        }
        return back();
    }

}
