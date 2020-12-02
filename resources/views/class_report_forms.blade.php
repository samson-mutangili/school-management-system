@extends('layouts.dashboard')

@section('content')

<?php 
$i = 1;

?>

<div class="row">
    <div class="col-md-12">
        <h4 class="page-head-line">Report forms</h4>

    </div>
</div>



@if (Session::get('no_exam_sessions') != null)

<div class="panel panel-default w-auto">
    <div class="panel-heading">
      NO active exam session
    </div>
      @csrf
       <div class="panel-body">
        <div style="margin-top: 10px;">
            @if ( Session::get('no_exam_sessions') != null)
    
            <div class="alert alert-danger alert-dismissible">
                    <p style="color: red;"><i class="fa fa-exclamation-triangle"></i> {{Session::get('no_exam_sessions')}}</p>
            </div>
    
            @endif
        </div>
       </div>
</div>


@else

<div class="panel panel-default w-auto">
    <div class="panel-heading">
        Report forms for {{$class_name}}, {{$year}}, Term {{$term}} {{$exam_type}} exams
    </div>
      @csrf
       <div class="panel-body">

            <div style="margin-top: 10px;">
                    @if ( Session::get('no_students_available') != null)
            
                    <div class="alert alert-danger alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Not accessible</strong> : {{ Session::get('no_students_available')}}
                    </div>
            
                    @endif
                </div>

                <div style="margin-top: 10px;">
                        @if ( Session::get('invalid_student') != null)
                
                        <div class="alert alert-danger alert-dismissible">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>Failed</strong> : {{ Session::get('invalid_student')}}
                        </div>
                
                        @endif
                    </div>

                    <div style="margin-top: 10px;">
                            @if ( Session::get('invalid_class_stream') != null)
                    
                            <div class="alert alert-danger alert-dismissible">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>Failed</strong> : {{ Session::get('invalid_class_stream')}}
                            </div>
                    
                            @endif
                        </div>

                        <div style="margin-top: 10px;">
                                @if ( Session::get('No_active_exam_session') != null)
                        
                                <div class="alert alert-danger alert-dismissible">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        <strong>Failed</strong> : {{ Session::get('No_active_exam_session')}}
                                </div>
                        
                                @endif
                            </div>

                            <div style="margin-top: 10px;">
                                @if ( Session::get('result_slip_not_ready') != null)
                        
                                <div class="alert alert-danger alert-dismissible">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        <strong>Failed</strong> : {{ Session::get('result_slip_not_ready')}}
                                </div>
                        
                                @endif
                            </div>
                <table class="table table-hover table-responsive-sm table-responsive-md" id="report_forms_table">
                        <thead class="active">
                                <th>S/NO</th>
                                <th>Name</th>
                                <th>Admission number</th>
                                <th>Class</th>
                                <th>Gender</th>
                                <th>Action</th>
                        </thead>

                        <tbody>
                            @foreach ($students as $student )
                            <?php $id = $student->id; ?>
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{$student->first_name}} {{$student->middle_name}} {{$student->last_name}} </td>
                                    <td>{{$student->admission_number}}</td>
                                    <td>{{$student->class}}</td>
                                    <td>{{$student->gender}}</td>
                                    <td>
                                        <form action="/view_student_report_form" method="POST">
                                            @csrf
                                            <input type="hidden" name="student_id" value="{{$student->id}}"/>
                                            <input type="hidden" name="class_name" value="{{$class_name}}"/>
                                        <button type="submit" name="submit" value="{{$student->id}}" style="margin-bottom: 5px;" class="btn btn-sm btn-outline-primary">View</button>
                                        
                                        <a href="/report_form/{{$student->id}},{{$class_name}}" target="_blank" style="margin-bottom: 5px;" class="btn btn-sm btn-outline-success">Download</a> 
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody> 

                </table>

</div>
</div>

@endif

@endsection