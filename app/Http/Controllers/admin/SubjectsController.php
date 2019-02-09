<?php

namespace App\Http\Controllers\admin;

use App\Mark;
use App\Semester;
use App\Subject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubjectsController extends Controller
{
    public function index(Request $request)
    {
        $subjects = Subject::all();

        if($request->wantsJson()){
            return response()->json(['subjects' => $subjects],200);

        }else
        {
            return view('admin.subjects.index', compact('subjects'));
        }

    }//end of index

    public function create()
    {
        $semesters=Semester::all();
        return view('admin.subjects.create',compact('semesters'));

    }//end of create

    public function store(Request $request)
    {

        $subject=new Subject();
        $subject->name=$request->name;
        $subject->semester_id=$request->semester_id;
        $subject->save();

        if($request->wantsJson()){
            return response()->json(['status' => 'subject created succesfull'],200);

        }else
        {
            return redirect()->route('subjects.index');
        }


    }//end of store

    public function edit(Subject $subject)
    {
        $semesters=Semester::all();

        return view('admin.subjects.edit', compact('semesters','subject'));

    }//end of edit

    public function update(Request $request, Subject $subject)
    {

        $subject->name=$request->name;
        $subject->semester_id=$request->semester_id;
        $subject->save();

        if($request->wantsJson()){
            return response()->json(['status' => 'subject edit succesfull'],200);

        }else
        {
            return redirect()->route('subjects.index');
        }

    }//end of update

    public function destroy(Request $request,Subject $subject)
    {


        Mark::where('subject_id',$subject->id)->delete();
        $subject->delete();

        if($request->wantsJson()){
            return response()->json(['status' => 'subject deleted succesfull'],200);

        }else
        {
            return redirect()->route('subjects.index');
        }

    }//end of destroy
}
