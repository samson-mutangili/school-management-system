@extends('layouts.dashboard')

@section('content')

<div class="row">
    <div class="col-md-12">
        <h1 class="page-head-line">All Students</h1>
    </div>
</div>
<?php $i = 1;

use Illuminate\Support\Facades\DB;

function getStudentParents($student_id){

    $student_parents = DB::table('student_parent')
                        ->join('parents', 'student_parent.parent_id', 'parents.id')
                        ->where('student_parent.student_id', $student_id)
                        ->get();

    return $student_parents;

}


?>
 

<div class="panel panel-primary w-auto">
    <div class="panel-heading">
      List of all students
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

            <fieldset style="border: 2px solid black; border-radius: 10px; padding: 5px; margin: 10px 0px; margin-bottom: 20px; " >
                <legend style="width: auto; color:black;">Filter students</legend>


            <form action="/students/filter" method="post" class="form-horizontal" name="report_filter_form">
        
                
                @csrf
        <input type="hidden" name="current_date" value="{{date('Y-m-d')}}" />
                <div class="row">
        
                    
        
                    <div class="col-md-4 col-lg-3 col-xl-3">
                            <div class="form-group row" id="date_to_div">
                             
                                    <label class="col-lg-3  col-xl-3 col-md-4  control-label" style="valign: center;" for="class_name">Class</label>
                            
                                 <div class="col-lg-9 col-xl-9 col-md-8">
                                    <select class="form-control" name="class_name" id="class_name" required onchange="matchStreams(this.id, 'streams')">
                                        <option value=""></option>
                                        <option>Form 1</option>
                                        <option>Form 2</option>
                                        <option>Form 3</option>
                                        <option>Form 4</option>
                                    </select>   
                                 </div>
                          </div>
        
                    </div>

                    <div class="col-md-4 col-lg-3 col-xl-3">
                        <div class="form-group row" id="date_to_div">
                         
                                <label class="col-lg-4  col-xl-4 col-md-4  control-label" style="valign: center;" for="date_to">Stream</label>
                        
                             <div class="col-lg-8 col-xl-8 col-md-8">
                                <select class="form-control" name="streams" id="streams" required>
                                    
                                </select>  
                             </div>
                      </div>
    
                </div>
                

            <div class="col-md-4 col-lg-3 col-xl-3">
                <div class="form-group row" >
                 
                    <div class="form-check-inline ">
                        <label class="form-check-label col-md-12 col-lg-12 col-xl-12">
                          <input type="checkbox" class="form-check-input " value="include parents" name="include_parents"  >Include parents details
                        </label>
                      </div>
              </div>

        </div>
        
                    <div class="col-md-3 col-lg-2 col-xl-2">
                        <button type="submit" name="submit" class="btn btn-outline-primary" >Submit</button>
        
                    </div>
        
                </div>
        
                
          
        
            </form>

            </fieldset>

           @if ($message == "")
           
           <table class="table table-hover table-responsive-sm table-responsive-md responsive-lg table-responsive-xl " id="students_deatils_table">
                   <thead class="active">
                       <th width="5%">#NO</th>
                       <th>Picture</th>
                       <th>ADM No.</th>
                       <th>Name</th>
                       <th>Gender</th>
                       <th>Status</th>
                   </thead>

                   <tbody>

                       @if (!$students->isEmpty())
                           @foreach ($students as $student)
                               <tr data-href='/studentDetails/{{$student->id}}'>
                                   <td>{{$i++}}</td>
                                   @if ($student->profile_pic != null)
                                   
                                   <td><img class="img-profile rounded-circle"  style="width: 40px; height: 40px;" src="{{URL::asset('images/'.$student->profile_pic)}}" alt="Profile picture"> </td>

                                   @else
                                   <td><img class="img-profile rounded-circle"  style="width: 40px; height: 40px;" src="{{URL::asset('images/default_profile_pic.png')}} " alt="profile_picture"></td>

                                   @endif
                                   <td>{{$student->admission_number}}</td>
                                   <td>{{$student->first_name}}  {{$student->middle_name}}  {{$student->last_name}}</td>
                                  
                                   <td>{{$student->gender}}</td>
                                   @if ($student->status == "active")
                                       <td style="color: green;">{{$student->status}}</td>
                                   @else
                                    <td style="color: red;">{{$student->status}}</td>
                                   @endif
                                   
                               </tr>
                           @endforeach
                       @endif
                   </tbody>
           </table>
           @elseif($message != "" && $parents_included == "no")
           @if ($message != "")
        <a href="/students/filtered/{{$class_name}},{{$streams}},{{$parents_included}}"  target="_blank" style="float: right; margin-bottom: 10px;"><i class="fa fa-download"></i>Download list</a>
               <p style="font-size: 18px; color: green; text-decoration: underline;">{{$message}}</p>
              
           @endif
      
           <table class="table table-hover table-responsive-sm table-responsive-md responsive-lg table-responsive-xl " id="students_deatils_table">
                   <thead class="active">
                       <th width="5%">#NO</th>
                       <th>Picture</th>
                       <th>ADM No.</th>
                       <th>Name</th>
                       
                       @if ($streams != "")
                           <th>Class stream</th>
                       @endif
                       <th>Gender</th>
                       <th>Status</th>
                   </thead>

                   <tbody>

                       @if (!$students->isEmpty())
                           @foreach ($students as $student)
                               <tr data-href='/studentDetails/{{$student->id}}'>
                                   <td>{{$i++}}</td>
                                   @if ($student->profile_pic != null)
                                   
                                   <td><img class="img-profile rounded-circle"  style="width: 40px; height: 40px;" src="{{URL::asset('images/'.$student->profile_pic)}}" alt="Profile picture"> </td>

                                   @else
                                   <td><img class="img-profile rounded-circle"  style="width: 40px; height: 40px;" src="{{URL::asset('images/default_profile_pic.png')}} " alt="profile_picture"></td>

                                   @endif
                                   <td>{{$student->admission_number}}</td>
                                   <td>{{$student->first_name}}  {{$student->middle_name}}  {{$student->last_name}}</td>
                                  @if ($streams != "")
                                      <td>{{$student->stream}}</td>
                                  @endif
                                   <td>{{$student->gender}}</td>
                                   @if ($student->status == "active")
                                       <td style="color: green;">{{$student->status}}</td>
                                   @else
                                    <td style="color: red;">{{$student->status}}</td>
                                   @endif
                                   
                               </tr>
                           @endforeach
                       @endif
                   </tbody>
           </table>


           @elseif($parents_included == "yes")

           @if ($message != "")
           <a href="/students/filtered/{{$class_name}},{{$streams}},{{$parents_included}}" target="_blank" style="float: right; margin-bottom: 10px;"><i class="fa fa-download"></i>Download list</a>
               <p style="font-size: 18px; color: green; text-decoration: underline;">{{$message}}</p>
              
           @endif
      
           <table class="table table-hover table-responsive-sm table-responsive-md responsive-lg table-responsive-xl " id="students_deatils_table">
                   <thead class="active">
                       <th width="5%">#NO</th>
                       <th>ADM No.</th>
                       <th>Student name</th>
                       <th>Class</th>
                       <th>Parent name</th>
                       <th>Relationship</th>
                       <th>Parent phone number</th>
                   </thead>

                   <tbody>

                       @if (!$students->isEmpty())
                           @foreach ($students as $student)
                               <tr>
                                   <td>{{$i++}}</td>
                                   <td>{{$student->admission_number}}</td>
                                   <td>{{$student->first_name}}  {{$student->last_name}}</td>
                                  
                                   <td>{{$student->stream}}</td>

                                   
                                   @if (!getStudentParents($student->student_id)->isEmpty())
                                       <td>
                                        @foreach (getStudentParents($student->student_id) as $parent)
                                           {{$parent->first_name}} {{$parent->last_name}} <br>
                                        @endforeach
                                       </td>

                                       <td>
                                        @foreach (getStudentParents($student->student_id) as $parent)
                                            @if ($parent->relationship == null)
                                                -- <br>
                                            @else
                                              {{$parent->relationship}}<br>
                                            @endif
                                          
                                        @endforeach
                                       </td>

                                       <td>
                                        @foreach (getStudentParents($student->student_id) as $parent)
                                           {{$parent->phone_no}}<br>
                                        @endforeach
                                       </td>

                                       <td>
                                      
                                   @else
                                       <td>--</td>
                                       <td>--</td>
                                       <td>--</td>
                                   @endif

                                 
                               </tr>
                           @endforeach
                       @endif
                   </tbody>
           </table>

           @endif
       </div>
</div>

                
    
@endsection