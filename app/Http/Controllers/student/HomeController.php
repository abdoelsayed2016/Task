<?php

namespace App\Http\Controllers\student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index() {
        $registerations=auth()->user()->student->registerations;
//        dd($registerations);
        return view( 'student.home',compact('registerations') ) ;
    }
}
