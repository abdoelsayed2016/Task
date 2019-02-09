@extends('layouts.master')
@section('bread')
    <section class="content-header">
        <ul class="breadcrumb1">
            <li><a href="{{route('admin.home')}}">Home</a></li>
            <li><a href="{{route('registerations.index')}}">Registerations</a></li>
            <li>Create</li>
        </ul>
    </section>
@stop
@section('content')
    @if (\Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif
    <h2>Create Registerations</h2>
    <hr>
    <div class="panel panel-default">



        <div class="panel-body">
            <form action="{{ route('registerations.store') }}" method="post">

                {{ csrf_field() }}

                {{ method_field('POST') }}

                <div class="form-group">
                    <label for="name">Semester</label>
                    <select name="semester_id" class="form-control">
                        @foreach($semesters as $semester)
                            <option value="{{$semester->id}}" @if($semester->id == old('semester_id')) selected @endif> {{$semester->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="name">Student</label>
                    <select name="student_id" class="form-control">
                        @foreach($students as $student)
                            <option value="{{$student->id}}" @if($student->id == old('student_id')) selected @endif> {{$student->user->name}}</option>
                        @endforeach
                    </select>
                </div>




                <div class="form-group">
                    <button class="btn btn-primary"><span class="fa fa-plus"></span> Register</button>
                </div>

            </form><!-- end of form -->

        </div><!-- end of panel body -->

    </div>
@stop
@section('script')
@stop
