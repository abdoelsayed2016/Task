@extends('layouts.master')
@section('bread')
    <section class="content-header">
        <ul class="breadcrumb1">
            <li><a href="{{route('admin.home')}}">Home</a></li>
            <li><a href="{{route('students.index')}}">Student</a></li>
            <li>Edit {{$student->user->name}}</li>
        </ul>
    </section>
@stop
@section('content')
    @if (\Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif
    <h2>Edit Student</h2>
    <hr>
    <div class="panel panel-default">



        <div class="panel-body">
            <form action="{{ route('students.update',$student->id) }}" method="post">

                {{ csrf_field() }}

                {{ method_field('PUT') }}

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $student->user->name}}">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" class="form-control" value="{{ $student->user->email }}">
                </div>
                <div class="form-group">
                    <label for="email">Password</label>
                    <input type="password" name="password" class="form-control" value="">
                </div>
                <div class="form-group">
                    <label for="email">SNN</label>
                    <input type="text" name="snn" class="form-control" value="{{  $student->snn }}">
                </div>

                <div class="form-group">
                    <button class="btn btn-primary"><span class="fa fa-plus"></span> Edit Student</button>
                </div>

            </form><!-- end of form -->

        </div><!-- end of panel body -->

    </div>
@stop
@section('script')
@stop
