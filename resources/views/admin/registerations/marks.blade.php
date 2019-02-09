@extends('layouts.master')
@section('bread')
    <section class="content-header">
        <ul class="breadcrumb1">
            <li><a href="{{route('admin.home')}}">Home</a></li>
            <li><a href="{{route('registerations.index')}}">Registerations</a></li>
            <li>Mark</li>

        </ul>
    </section>
@stop
@section('content')
    <h2>Marks for : {{$registeration->student->user->name}} for Semester : {{$registeration->student->user->name}} </h2>
    <hr>

    <form action="{{route('registerations.post.marks',$registeration->id)}}" method="post">
        {{ csrf_field() }}

        <table class="table table-bordered  table-hover">
        <thead>

        <tr>
            <th>Student Name</th>
            <th>Degree </th>
        </tr>
        </thead>
        <tbody>

        @foreach($subjects as $k=>$subject)
            <tr>
                <th>{{$subject->name}}</th>
                <th><input type="hidden" value="{{$subject->id}}" name="subject[]">
                    <input type="text" name="degree[]" class="form-control" value="@if(!$registeration->marks->isEmpty()){{ $registeration->marks()->where('subject_id',$subject->id)->first()->mark }} @endif">
                </th>
            </tr>
        @endforeach
        <tr>
            <th></th>
            <th><input type="submit"  class="btn btn-primary" value="Submit"></th>
        </tr>
        </tbody>
    </table>
    </form>
    {{--</div>--}}
@stop
@section('script')
@stop
