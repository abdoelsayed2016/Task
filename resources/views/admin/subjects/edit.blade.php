@extends('layouts.master')
@section('bread')
    <section class="content-header">
        <ul class="breadcrumb1">
            <li><a href="{{route('admin.home')}}">Home</a></li>
            <li><a href="{{route('subjects.index')}}">Subjects</a></li>
            <li>Edit {{$subject->name}}</li>
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
            <form action="{{ route('subjects.update',$subject->id) }}" method="post">

                {{ csrf_field() }}

                {{ method_field('PUT') }}

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $subject->name}}">
                </div>

                <div class="form-group">
                    <label for="name">Semester</label>
                    <select name="semester_id" class="form-control">
                        @foreach($semesters as $semester)
                            <option value="{{$semester->id}}" @if($semester->id == $subject->semester_id) selected @endif> {{$semester->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <button class="btn btn-primary"><span class="fa fa-plus"></span> Edit Subject</button>
                </div>

            </form><!-- end of form -->

        </div><!-- end of panel body -->

    </div>
@stop
@section('script')
@stop
