<?php

namespace App\Http\Controllers\admin;

use App\Semester;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SemestersController extends Controller
{
    public function index(Request $request)
    {
        $semesters = Semester::all();

        if($request->wantsJson()){
            return response()->json(['semesters' => $semesters],200);

        }else
        {
            return view('admin.semesters.index', compact('semesters'));

        }

        ////

    }//end of index

    public function create()
    {
        return view('admin.semesters.create');

    }//end of create

    public function store(Request $request)
    {

        $semester=new Semester();
        $semester->name=$request->name;
        $semester->save();
        if($request->wantsJson()){
            return response()->json(['status' => 'semester save sucessful'],200);

        }else
        {
            return redirect()->route('semesters.index');

        }


    }//end of store

    public function edit(Semester $semester)
    {
        return view('admin.semesters.edit', compact('semester'));

    }//end of edit

    public function update(Request $request, Semester $semester)
    {
//        dd($request->all());

        $semester->name=$request->name;
        $semester->save();
        if($request->wantsJson()){
            return response()->json(['status' => 'semester edit sucessful'],200);

        }else
        {
            return redirect()->route('semesters.index');

        }

    }//end of update

    public function destroy(Request $request,Semester $semester)
    {

        $subjects=$semester->subjects;
        foreach ($subjects as $subject)
        {
            $subject->delete();
        }
        $registerations=$semester->registerations;
        foreach ($registerations as $reg)
        {
            $marks=$reg->marks;
            foreach ($marks as $mark)
            {
                $mark->delete();
            }
            $reg->delete();
        }
        $semester->delete();
        if($request->wantsJson()){
            return response()->json(['status' => 'semester delete sucessful'],200);

        }else
        {
            return redirect()->route('semesters.index');

        }

    }//end of destroy
}
