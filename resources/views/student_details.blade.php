@extends('layouts.dashboard')

@section('content')

<div class="row">
    <div class="col-md-12">
        <h1 class="page-head-line">Students</h1>
    </div>
</div>
<?php $i = 1;

?>
 

<div class="panel panel-default w-auto">
    <div class="panel-heading">
      Form {{$className}} students
    </div>
       <div class="panel-body">

            <div>
                    @if ( Session::get('student_cleared_successfully') != null)
                
                    <div class="alert alert-success alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Success</strong> : {{ Session::get('student_cleared_successfully')}}
                    </div>
                
                    @endif
            </div>   

            <div>
                    @if ( Session::get('student_clearance_failed') != null)
                
                    <div class="alert alert-danger alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Failed</strong> : {{ Session::get('student_clearance_failed')}}
                    </div>
                
                    @endif
            </div>   

            <div>
                    @if ( Session::get('student_added_successfully') != null)
                
                    <div class="alert alert-success alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Success</strong> : {{ Session::get('student_added_successfully')}}
                    </div>
                
                    @endif
            </div>  
       
            <table class="table table-hover table-responsive-sm table-responsive-md " id="students_deatils_table">
                    <thead class="active">
                        <th width="5%">#NO</th>
                        <th>ADM No.</th>
                        <th>Name</th>
                        <th>Class</th>
                        <th>Gender</th>
                    </thead>

                    <tbody>

                        @if (!$students->isEmpty())
                            @foreach ($students as $student)
                                <tr data-href='/studentDetails/{{$className}},{{$student->id}}'>
                                    <td>{{$i++}}</td>
                                    <td>{{$student->admission_number}}</td>
                                    <td>{{$student->first_name}}  {{$student->middle_name}}  {{$student->last_name}}</td>
                                    <td>{{$student->stream}}</td>
                                    <td>{{$student->gender}}</td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
            </table>
       </div>
</div>

                
    
@endsection