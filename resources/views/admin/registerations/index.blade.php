@extends('layouts.master')
@section('bread')
    <section class="content-header">
        <ul class="breadcrumb1">
            <li><a href="{{route('admin.home')}}">Home</a></li>
            <li>Registerations</li>
        </ul>
    </section>
@stop
@section('content')
    <h2>Registerations</h2>
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
                <th>Student Name</th>
                <th>Semester Name</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>

            @foreach($registerations as $k=>$registeration)
                <tr>
                    <th>{{$k+1}}</th>
                    <th>{{$registeration->semester->name}}</th>
                    <th>{{$registeration->student->user->name}}</th>
                    <th>
                        <a href="{{route('registerations.marks',$registeration->id)}}" class="btn btn-primary">Marks</a>
                        <a href="{{route('registerations.edit',$registeration->id)}}" class="btn btn-success">Edit</a>
                        <a href="{{route('registerations.destroy',$registeration->id)}}" class="btn btn-danger">Delete</a>

                    </th>
                </tr>
            @endforeach
            </tbody>
        </table>
    {{--</div>--}}
@stop
@section('script')
@stop
