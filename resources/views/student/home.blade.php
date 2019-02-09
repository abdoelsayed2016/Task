@extends('layouts.master')
@section('bread')
    <section class="content-header">
        <ul class="breadcrumb1">
            <li><a href="{{route('student.home')}}">Home</a></li>
            <li>Dashboard</li>
        </ul>
    </section>
@stop
@section('content')
    <div class="">
        <div class="col-lg-11 col-lg-offset-3 text-center"><h1>Welcome </h1></div>
        <div class="col-lg-11 col-lg-offset-3 text-center">
            <h3>Name:{{auth()->user()->name}} ||
            Email:{{auth()->user()->email}} ||
            SNN:{{auth()->user()->student->snn}}</h3>
        </div>
        <div class="col-lg-11 col-lg-offset-3 text-center">

            <div   class="form-group">
                <label for="name">Semester</label>
                <select id="semester" name="semester_id" onchange="degree(this.value)" class="form-control">
                    <option value="">Select Semester</option>
                    @foreach($registerations as $r)
{{--                        {{$r}}--}}
                        <option value="{{$r->semester->id}}">{{$r->semester->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <table id="table" class="table table-bordered table-hover">

        </table>
    </div>
@stop
@section('script')

    <script>
        function degree(id) {

            student="{{auth()->user()->student->id}}"
            $.ajax({
                url: "{{route('student.degrees.marks')}}",
                type: "post",
                dataType:"json",
                data: {"_token":"{{csrf_token()}}",id:id,student:student} ,
                success: function (response) {
                    text=response
                    var json = response;
                    $("#table").empty();
                    $('#table').append('<tr><th>Subject</th><th>Degree</th></tr><br>');
                    for (var i=0;i<json.length;++i)
                    {
                        $('#table').append('<tr><th>'+json[i].subject+'</th><th>'+json[i].mark+'</th></tr><br>');
                    }

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }


            });
        }
    </script>
@stop
