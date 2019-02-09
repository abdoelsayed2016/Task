@extends('layouts.master')
@section('bread')
    <section class="content-header">
        <ul class="breadcrumb1">
            <li><a href="{{route('admin.home')}}">Home</a></li>
            <li>Dashboard</li>
        </ul>
    </section>
@stop
@section('content')
    <div class="">
        <div class="col-lg-11 col-lg-offset-3 text-center"><h1>Welcome To Admin Page</h1></div>
    </div>

@stop
@section('script')
@stop
