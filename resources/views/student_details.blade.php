@extends('layouts.dashboard')

@section('content')

<div class="row">
    <div class="col-md-12">
        <h1 class="page-head-line">Students</h1>
    </div>
</div>
<?php $i = 1;

?>
 

<div class="panel panel-primary w-auto">
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
       

            <div>
                @if ( Session::get('update_failed') != null)
            
                <div class="alert alert-danger alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Failed</strong> : {{ Session::get('update_failed')}}
                </div>
            
                @endif
        </div>   

        <div>
                @if ( Session::get('update_successful') != null)
            
                <div class="alert alert-success alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Success</strong> : {{ Session::get('update_successful')}}
                </div>
            
                @endif
        </div>  
   
       <div style="text-align: right; margin-bottom: 15px;">
               <button class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#promoteAll">Promote all to next class</button>
       </div>



            <table class="table table-hover table-responsive-sm table-responsive-md responsive-lg table-responsive-xl " id="students_deatils_table">
                    <thead class="active">
                        <th width="5%">#NO</th>
                        <th>Picture</th>
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
                                    @if ($student->profile_pic != null)
                                    
                                    <td><img class="img-profile rounded-circle"  style="width: 40px; height: 40px;" src="{{URL::asset('images/'.$student->profile_pic)}}" alt="Profile picture"> </td>

                                    @else
                                    <td><img class="img-profile rounded-circle"  style="width: 40px; height: 40px;" src="{{URL::asset('images/default_profile_pic.png')}} " alt="profile_picture"></td>

                                    @endif
                                    <td>{{$student->admission_number}}</td>
                                    <td>{{$student->first_name}}  {{$student->middle_name}}  {{$student->last_name}}</td>
                                    <td>{{$student->stream}}</td>
                                    <td>{{$student->gender}}</td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
            </table>


             <!-- modal dialog form for removing student out of session -->
             <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-lg-12 col-xl-12">
                        <div class="modal" id="promoteAll" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title pull-left" >Promote all to next class</h4>
                                        <button class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        
                                                    <form action="/students/promote/all" method = "POST" >
                                                        @csrf
                                                        <?Php $nextClass = ""; $real_class = ""; $completed = false; $this_year = date("Y")-1; ?>
                                                        @if ($className == "1E")
                                                            <?Php $nextClass = "2E"; $real_class = "Form 2";?>
                                                        @elseif($className == "1W")
                                                                <?Php $nextClass = "2W"; $real_class = "Form 2";?>

                                                        @elseif($className == "2W")
                                                                <?Php $nextClass = "3W"; $real_class = "Form 3"; ?>
                                                        @elseif($className == "2E")
                                                                <?Php $nextClass = "3E"; $real_class = "Form 3";?>
                                                        @elseif($className == "3W")
                                                                <?Php $nextClass = "4W"; $real_class = "Form 4";?>
                                                        @elseif($className == "3E")
                                                                <?Php $nextClass = "4E"; $real_class = "Form 4"; ?>
                                                        @elseif($className == "4W" || $className == "4E")
                                                                <?Php $nextClass = "Completed"; $completed = true; ?>
                                                                
                                                        @endif

                                                        @if ($completed)
                                                                 <input type="hidden" name="completed" value="yeah"/>
                                                        @else
                                                                 <input type="hidden" name="completed" value="no"/>
                                                        @endif
                                                        
                                                        <input type="hidden" name="next_class" value="{{$nextClass}}"/>
                                                        <input type="hidden" name="real_class" value="{{$real_class}}"/>
                                                        <input type="hidden" name="students_year" value="{{$this_year}}"/>
                                                        <input type="hidden" name="previous_class" value="{{$className}}"/>

                                                        @if (!$completed)
                                                                <p>
                                                                        All students who entered in <b> Form {{$className}}</b> in <b>{{$this_year}}</b> will be promoted to <b>Form {{$nextClass}}</b>.
                                                                        Do you want to promote them to the next class?
                                                                </p>
                                                        @else
                                                                <p>
                                                                        Students who entered <b>Form {{$className}}</b> in the year <b>{{$this_year}}</b> have completed their four year program. All students will be marked as have <b> completed</b> school and their details
                                                                        can be found under alumni details. Do you wish to execute this operation?
                                                                </p>
                                                        @endif

                                                            
                                                            <div style="align: center;" class="pull-right">
                                                             <button type="button" class="btn btn-outline-warning" data-dismiss="modal">Cancel</button>
                                                            <button type="submit" class="btn btn-outline-primary" value="Update">Yes, continue</button>
                                                            </div>
                                                </form>
                                                
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
       </div>
</div>

                
    
@endsection