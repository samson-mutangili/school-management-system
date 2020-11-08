@extends('layouts.dashboard')

@section('content')

<div class="row">
    <div class="col-md-12">
        <h1 class="page-head-line">Students out of session</h1>
    </div>
</div>
<?php $i = 1;

?>
 

<div class="panel panel-primary w-auto">
    <div class="panel-heading">
      All students out of session
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
                @if ( Session::get('status_updated_successfully') != null)
            
                <div class="alert alert-info alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Info</strong> : {{ Session::get('status_updated_successfully')}}
                </div>
            
                @endif
        </div>   

         <div>
                    @if ( Session::get('status_update_failed') != null)
                
                    <div class="alert alert-warning alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Failed</strong> : {{ Session::get('status_update_failed')}}
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
       
            <table class="table table-hover table-responsive-sm table-responsive-md responsive-lg table-responsive-xl " id="students_deatils_table">
                    <thead class="active">
                        <th width="5%">#NO</th>
                        <th>Picture</th>
                        <th>ADM No.</th>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Date since out of session</th>
                    </thead>

                    <tbody>

                        @if (!$students->isEmpty())
                            @foreach ($students as $student)
                                <tr data-href='/students/Outofsession/{{$student->student_id}}'>
                                    <td>{{$i++}}</td>
                                    @if ($student->profile_pic != null)
                                    
                                    <td><img class="img-profile rounded-circle"  style="width: 40px; height: 40px;" src="{{URL::asset('images/'.$student->profile_pic)}}" alt="Profile picture"> </td>

                                    @else
                                    <td><img class="img-profile rounded-circle"  style="width: 40px; height: 40px;" src="{{URL::asset('images/default_profile_pic.png')}} " alt="profile_picture"></td>

                                    @endif
                                    <td>{{$student->admission_number}}</td>
                                    <td>{{$student->first_name}}  {{$student->middle_name}}  {{$student->last_name}}</td>
                                    <td>{{$student->gender}}</td>
                                    <td>{{$student->date_from}}</td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
            </table>
       </div>
</div>

                
    
@endsection