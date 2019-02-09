<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Student;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentsController extends Controller
{
    public function index(Request $request)
    {
        $students = Student::all();

        if ($request->wantsJson()) {
            return response()->json(['students' => $students], 200);

        } else {
            return view('admin.students.index', compact('students'));

        }
        ////

    }//end of index

    public function create()
    {
        return view('admin.students.create');

    }//end of create

    public function store(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if ($user) {
            if ($request->wantsJson()) {
                return response()->json(['status' => 'User exit before'], 200);
            } else {
                \Session::flash('message', "User exits");

                return back()->withInput($request->input());
            }
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = 2;
        $user->save();

        $student = new Student();
        $student->snn = $request->snn;
        $student->user_id = $user->id;
        $student->save();

        if ($request->wantsJson()) {
            return response()->json(['status' => 'User saved'], 200);

        } else {
            return redirect()->route('students.index');

        }

    }//end of store

    public function edit(Student $student)
    {
        return view('admin.students.edit', compact('student'));

    }//end of edit

    public function update(Request $request, Student $student)
    {
        $user = $student->user;
        if ($request->email != $user->email) {
            $user1 = User::where('email', $request->email)->first();
            if ($user1) {
                if ($request->wantsJson()) {
                    return response()->json(['status' => 'Email already exits'], 200);
                }else
                {
                    \Session::flash('message', "Email already exits");
                    return back()->withInput($request->input());
                }
            }
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = 2;
        $user->save();
//        $student=new Student();
        $student->snn = $request->snn;
        $student->user_id = $user->id;
        $student->save();

        if ($request->wantsJson()) {
            return response()->json(['status' => 'User Edited'], 200);

        } else {
            return redirect()->route('students.index');

        }


    }//end of update

    public function destroy(Request$request,Student $student)
    {
        $registerations = $student->registerations;
        foreach ($registerations as $reg) {
            $marks = $reg->marks;
            foreach ($marks as $mark) {
                $mark->delete();
            }
            $reg->delete();
        }

        $user = $student->user;
        $user->delete();

        $student->delete();

        if ($request->wantsJson()) {
            return response()->json(['status' => 'User deleted '], 200);
        } else {
            return redirect()->route('students.index');
        }

    }//end of destroy
}
