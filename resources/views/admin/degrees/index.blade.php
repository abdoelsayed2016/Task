@extends('layouts.master')
@section('bread')
    <section class="content-header">
        <ul class="breadcrumb1">
            <li><a href="{{route('admin.home')}}">Home</a></li>
            <li>Degree</li>

        </ul>
    </section>
@stop
@section('content')
    <h2>Students Grades in Semester</h2>
    <hr>
    <div class="form-group">
        <label for="name">Student</label>
        <select name="student_id" id="student" onchange="semesters(this.value)" class="form-control">
            <option value="">Select Student</option>

            @foreach($students as $student)
                <option value="{{$student->id}}"> {{$student->user->name}}</option>
            @endforeach
        </select>
    </div>
    <div   class="form-group">
        <label for="name">Semester</label>
        <select id="semester" name="semester_id" onchange="degree(this.value)" class="form-control">
            <option value="">Select Semester</option>

        </select>
    </div>
    <table id="table" class="table table-bordered table-hover">

    </table>
    <div id="asd">
        <div id="editor"></div>
        <button id="cmd">generate PDF</button>
    </div>
    {{--</div>--}}
@stop
@section('script')


    <script>
        var text;
        function semesters(id){
            $.ajax({
                url: "{{route('degrees.semester')}}",
                type: "post",
                dataType:"json",
                data: {"_token":"{{csrf_token()}}",id:id} ,
                success: function (response) {
                    var json = response;
//                    alert(json)
                    //now json variable contains data in json format
                    //let's display a few items
                    $("#semester").empty();
                    $('#semester').append('<option value="">Select Semester</option>');
                    for (var i=0;i<json.length;++i)
                    {
                        $('#semester').append('<option value="'+json[i].id+'">'+json[i].name+'</option>');
                    }



                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }


            });
        }
        function degree(id) {

            student=$("#student").val()
            $.ajax({
                url: "{{route('degrees.marks')}}",
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
//                    $('#asd').append('<div id="editor"></div>');
//                    $('#asd').append('<button id="cmd">generate PDF</button>')
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }


            });
        }




    </script>
    <script>
        var doc = new jsPDF('p','pt','a4');
        var specialElementHandlers = {
            '#editor': function (element, renderer) {
                return true;
            }
        };

        $('#cmd').click(function () {
            c=40;
            doc.setFont('times')
            doc.setFontType('italic')
            doc.text(200, 20, 'Subject and Mark')
            for (var i=0;i<text.length;++i)
            {
                str=text[i].subject+':'+text[i].mark
                doc.text(20, c,str);
                c+=20
            }
            doc.save('web.pdf');
        });
    </script>
@stop
