@extends('layouts.master')
@section('bread')
    <section class="content-header">
        <ul class="breadcrumb1">
            <li><a href="{{route('admin.home')}}">Home</a></li>
            <li>Student</li>
        </ul>
    </section>
@stop
@section('content')
    <h2>Students</h2>
    <hr>
    {{--<div class="row">--}}
        {{--<div class="form-group col-md-12">--}}
            {{--<p>This is a responsive sidebar template with dropdown menu based on bootstrap 4 framework.</p>--}}
            {{--<p> You can find the complete code on <a href="https://github.com/azouaoui-med/pro-sidebar-template"--}}
                                                     {{--target="_blank">--}}
                    {{--Github</a>, it contains more themes and background image option</p>--}}
        {{--</div>--}}
        <table class="table table-bordered  table-hover">
            <thead>

            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>SNN</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>

            @foreach($students as $k=>$student)
                <tr>
                    <th>{{$k+1}}</th>
                    <th>{{$student->user->name}}</th>
                    <th>{{$student->user->email}}</th>
                    <th>{{$student->snn}}</th>
                    <th>
                        <a href="{{route('students.show',$student->id)}}" class="btn btn-primary">Show</a>
                        <a href="{{route('students.edit',$student->id)}}" class="btn btn-success">Edit</a>
                        <a href="{{route('students.destroy',$student->id)}}" class="btn btn-danger">Delete</a>

                    </th>
                </tr>
            @endforeach
            </tbody>
        </table>
    {{--</div>--}}
@stop
@section('script')
@stop
