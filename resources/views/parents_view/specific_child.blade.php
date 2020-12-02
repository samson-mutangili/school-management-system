@extends('layouts.dashboard')

@section('content')

<div class="row">
        <div class="col-md-12">
            <h1 class="page-head-line">Child details</h1>
        </div>
</div>
<?php $i = 1;
use Illuminate\Support\Facades\DB;

$parent_id = Session::get('parent_id');

//get the student details
$name = "";
$adm_no;
$phone_no = "";


$parent_details = DB::table('parents')
                    ->where('id', $parent_id)
                    ->get();

if(!$parent_details->isEmpty()){
    foreach ($parent_details as $parent) {
        $phone_no = $parent->phone_no;
    }
}
?>

<ul class="nav nav-tabs">
        <li class="nav-item">
                <a class="nav-link @if(Session::get('error_occured') == null && Session::get('transaction_successful') == null && Session::get('time_out') == null && Session::get('cancelled_by_user') == null && Session::get('invalid_password') == null && Session::get('general_error') == null ) active @endif" data-toggle="tab" href="#bio_data">Bio data</a>
              </li>
    <li class="nav-item">
      <a class="nav-link @if(Session::get('error_occured') != null || Session::get('transaction_successful') != null || Session::get('time_out') != null || Session::get('cancelled_by_user') != null || Session::get('invalid_password') != null || Session::get('general_error') != null ) active @endif " data-toggle="tab" href="#address">Address</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#result_slips">Result slips</a>
    </li>
    <li class="nav-item">
        <a class="nav-link " data-toggle="tab" href="#disciplinary_cases">Disciplinary cases</a>
        </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#student_classes">Student classes</a>
    </li>
    <li class="nav-item">
        <a class="nav-link " data-toggle="tab" href="#pay_fees">Pay Fees</a>
        </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#fee_statements">Fees statements</a>
    </li>
         
  </ul>



  <div style="margin-top: 15px;">
        <div style="margin-top: 15px;">
                @if ( Session::get('student_update_successful') != null)
            
                <div class="alert alert-success alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Success</strong> : {{ Session::get('student_update_successful')}}
                </div>
            
                @endif
        </div>  

            <div style="margin-top: 15px;">
                    @if ( Session::get('student_update_failed') != null)
                
                    <div class="alert alert-danger alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Failed</strong> : {{ Session::get('student_update_failed')}}
                    </div>
                
                    @endif
            </div> 
            
            <!-- show error messages for student clearance -->
            <div style="margin-top: 15px;">
                @if ( Session::get('uncleared_cases') != null)
            
                <div class="alert alert-danger alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Failed</strong> : {{ Session::get('uncleared_cases')}}
                </div>
            
                @endif
            </div> 

        <div>
                @if ( Session::get('address_empty_fields') != null)
            
                <div class="alert alert-danger alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Failed</strong> : {{ Session::get('address_empty_fields')}}
                </div>
            
                @endif
            </div>   
        
            <div>
                @if ( Session::get('postal_code_error') != null)
            
                <div class="alert alert-danger alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Failed</strong> : {{ Session::get('postal_code_error')}}
                </div>
            
                @endif
            </div>  
        
            <div>
                @if ( Session::get('postal_address_error') != null)
            
                <div class="alert alert-danger alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Failed</strong> : {{ Session::get('postal_address_error')}}
                </div>
            
                @endif
            </div>  
        
             <div>
                @if ( Session::get('address_update_successful') != null)
            
                <div class="alert alert-success alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Success</strong> : {{ Session::get('address_update_successful')}}
                </div>
            
                @endif
            </div>  
        

            <div style="margin-top: 15px;">
                    @if ( Session::get('same_class') != null)
                
                    <div class="alert alert-danger alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Failed</strong> : {{ Session::get('same_class')}}
                    </div>
                
                    @endif
                </div>  
            
                     <div style="margin-top: 15px;">
                        @if ( Session::get('not_promoted') != null)
                    
                        <div class="alert alert-danger alert-dismissible">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>Failed</strong> : {{ Session::get('not_promoted')}}
                        </div>
                    
                        @endif
                    </div> 
                    <div style="margin-top: 15px;">
                        @if ( Session::get('promoted') != null)
                    
                        <div class="alert alert-success alert-dismissible">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>Success</strong> : {{ Session::get('promoted')}}
                        </div>
                    
                        @endif
                    </div>   
             <div>
                @if ( Session::get('address_update_failed') != null)
            
                <div class="alert alert-danger alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Failed</strong> : {{ Session::get('address_update_failed')}}
                </div>
            
                @endif
            </div>  

            <div style="margin-top: 15px;">
                @if ( Session::get('edit_id_no_conflict2') != null)
            
                <div class="alert alert-danger alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Failed</strong> : {{ Session::get('edit_id_no_conflict2')}}
                </div>
            
                @endif
        </div> 
        
        <div style="margin-top: 15px;">
            @if ( Session::get('edit_email_conflict2') != null)
        
            <div class="alert alert-danger alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Failed</strong> : {{ Session::get('edit_email_conflict2')}}
            </div>
        
            @endif
        </div> 
        
            <!-- parents update feedback messages -->
            <div>
                @if ( Session::get('parent_empty_fields') != null)
            
                <div class="alert alert-danger alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Failed</strong> : {{ Session::get('parent_empty_fields')}}
                </div>
            
                @endif
            </div>  
        
            <div>
                @if ( Session::get('parent_updated') != null)
            
                <div class="alert alert-success alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Success</strong> : {{ Session::get('parent_updated')}}
                </div>
            
                @endif
            </div>  
        
            <div>
                @if ( Session::get('parent_not_updated') != null)
            
                <div class="alert alert-danger alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Failed</strong> : {{ Session::get('parent_not_updated')}}
                </div>
            
                @endif
            </div>  

            <div style="margin-top: 15px;">
                    @if ( Session::get('message_saved') != null)
                
                    <div class="alert alert-success alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Success</strong> : {{ Session::get('message_saved')}}
                    </div>
                
                    @endif
            </div>  

            <div style="margin-top: 15px;">
                @if ( Session::get('student_resumed') != null)
            
                <div class="alert alert-success alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Success</strong> : {{ Session::get('student_resumed')}}
                </div>
            
                @endif
        </div>  
        
                <div style="margin-top: 15px;">
                        @if ( Session::get('no_parent') != null)
                    
                        <div class="alert alert-danger alert-dismissible">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>Failed</strong> : {{ Session::get('no_parent')}}
                        </div>
                    
                        @endif
                </div> 
                <div style="margin-top: 15px;">
                    @if ( Session::get('message_send_not_saved') != null)
                
                    <div class="alert alert-success alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Success</strong> : {{ Session::get('message_send_not_saved')}}
                    </div>
                
                    @endif
            </div>  
        
                <div style="margin-top: 15px;">
                        @if ( Session::get('no_internet') != null)
                    
                        <div class="alert alert-danger alert-dismissible">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>Failed</strong> : {{ Session::get('no_internet')}}
                        </div>
                    
                        @endif
                </div>
                
                          <div>
                                                @if ( Session::get('error_occured') != null)
                                            
                                                <div class="alert alert-danger alert-dismissible">
                                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                        <strong>Failed</strong> : {{ Session::get('error_occured')}}
                                                </div>
                                            
                                                @endif
                                 </div>    
                                
                                 <div>
                                                @if ( Session::get('transaction_successful') != null)
                                            
                                                <div class="alert alert-success alert-dismissible">
                                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                        <strong>Success</strong> : {{ Session::get('transaction_successful')}}
                                                </div>
                                            
                                                @endif
                                </div>  
                
        
        
                                <div>
                                                @if ( Session::get('time_out') != null)
                                            
                                                <div class="alert alert-danger alert-dismissible">
                                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                        <strong>Failed</strong> : {{ Session::get('time_out')}}
                                                </div>
                                            
                                                @endif
                                </div>   
        
                        
                                <div>
                                                @if ( Session::get('cancelled_by_user') != null)
                                            
                                                <div class="alert alert-danger alert-dismissible">
                                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                        <strong>Failed</strong> : {{ Session::get('cancelled_by_user')}}
                                                </div>
                                            
                                                @endif
                                 </div>  
                                 <div>
                                                @if ( Session::get('invalid_password') != null)
                                            
                                                <div class="alert alert-danger alert-dismissible">
                                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                        <strong>Failed</strong> : {{ Session::get('invalid_password')}}
                                                </div>
                                            
                                                @endif
                                 </div>  

                                  <div>
                                                @if ( Session::get('general_error') != null)
                                            
                                                <div class="alert alert-danger alert-dismissible">
                                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                        <strong>Failed</strong> : {{ Session::get('general_error')}}
                                                </div>
                                            
                                                @endif
                                 </div> 

                                   <div>
                                                @if ( Session::get('transaction_initiated') != null)
                                            
                                                <div class="alert alert-success alert-dismissible">
                                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                        <strong>Success</strong> : {{ Session::get('transaction_initiated')}}
                                                </div>
                                            
                                                @endif
                                 </div>   

        <div class="tab-content">
                <div id="bio_data" class="tab-pane container active">

                        @if (!$student_details->isEmpty())

                        <?php

                            $class_stream = "--";
                            // get the student class
                            if(!$student_classes->isEmpty()){
                                foreach ($student_classes as $class) {
                                    if($class->status == "active"){
                                        $class_stream = $class->stream;
                                    }
                                }
                            }

                        ?>

                        @foreach ($student_details as $student)
                        <?php $student_id = $student->id;
                            $name = $student->first_name.' '.$student->middle_name.' '.$student->last_name;
                            $adm_no = $student->admission_number;
                        ?>
                        <div class="panel panel-primary w-auto" >
                            <div class="panel-heading">
                              Student personal details
                            </div>  
                            
                            
                            
                            <div class="panel-body">
                                     
                                    <div class="row">
                    
                                            <div class="col-xm-12 col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                                    @if ($student->profile_pic != null)
                                                      <img class="img-profile rounded-circle" style="width: 170px; height: 170px;" src="{{URL::asset('images/'.$student->profile_pic)}}" alt="profile picture" />
                                                    @else
                                                    <img class="img-profile rounded-circle" style="width: 170px; height: 170px;" src="{{URL::asset('images/default_profile_pic.png')}}" alt="profile picture" />
                    
                                                    @endif
                                                   
                                                   {{-- <div class="input-group">
                                                           <div class="custom-file">
                                                                   <input type="file" name="profile_pic" class="custom-file-input">
                                                                   <label class="custom-file-label">Update pic</label>
                                                           </div>
                                                   </div> --}}
                                            </div>
                    
                                            <div class="col-xm-12 col-sm-6 col-md-8 col-lg-9 col-xl-9">
                    
                                                <div class="row">
                                            <div class="col-md-6 col-lg-6 col-xl-6 ">
                                                    <table>
                                                            <tbody>
                                                                <tr>
                                                                    <td align="left">Admission number  </td> 
                                                                    <td> : {{$student->admission_number}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="left">Class</td>
                                                                    <td> : {{$class_stream}}</td>
                                                                </tr>
                    
                                                                
                                                                    <tr>
                                                                        <td align="left">Date of admission  </td> 
                                                                        <td> : {{$student->date_of_admission}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td align="left">Date of birth</td>
                                                                        <td> : {{$student->DOB}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                            <td align="left">Religion</td>
                                                                            <td> : {{$student->religion}}</td>
                                                                        </tr>
                                                               
                                                            </tbody>
                                                        </table>
                                            </div>
                                            <div class="col-md-6 col-lg-6 col-xl-6 ">
                                                    <table>
                                                            <tbody>
                                                                <tr>
                                                                    <td align="left">Name</td>
                                                                    <td> : {{$student->first_name}} {{$student->middle_name}} {{$student->last_name}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="left">Gender   </td>
                                                                    <td> : {{$student->gender}}</td>
                                                                </tr>
                    
                                                                        <tr>
                                                                            <td align="left">Birth cert no  </td> 
                                                                            <td> : {{$student->birth_cert_no}}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td align="left">KCPE index no</td>
                                                                            <td> : {{$student->kcpe_index_no}}</td>
                                                                        </tr>
                                                                        <tr>
                                                                                <td align="left">Status</td>
                                                                                <td @if($student->status == 'active') style="color: green;" @else style="color: red;" @endif> : {{$student->status}}</td>
                                                                            </tr>
                                                                    
                                                            </tbody>
                                                        </table>
                                        
                                            </div>
                                            </div>
                    
                                        
                                    </div>
                                           
                                        </div>
                            </div>
                        </div>
                       
                        @endforeach
                        
                    @endif
                     
                    
                    
        
                </div>

                <div id="address" class="tab-pane container fade">
            
                        <div class="panel panel-primary w-auto" >
                                <div class="panel-heading">
                                  Student address details
                                </div>                    
                                <div class="panel-body">
                                    @if (!$student_address->isEmpty())
                                        @foreach ($student_address as $address)
                                            <table>
                                                <tbody>
                                                    <tr>
                                                        <td align="left">Postal code</td>
                                                        <td> : {{$address->postal_code}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td align="left">Postal address</td>
                                                        <td> : {{$address->postal_address}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td align="left">Street</td>
                                                        <td> : {{$address->street}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td align="left">Town</td>
                                                        <td> : {{$address->town}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td align="left">Country</td>
                                                        <td> : {{$address->country}}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <br>
                                           
                                        @endforeach
                                    @endif
                                    
                                </div>
                        </div>
                   </div>
                   
                    
                   <div id="result_slips" class="tab-pane container fade">
                          <?php $i=1; 
                          
                            function getClass($stream){
                                
                                $class_form = "";
            
                                if($stream == "1E" || $stream == "1W"){
                                    $class_form = "Form 1";
                                } else if ($stream == "2E" || $stream == "2W"){
                                    $class_form = "Form 2";
                                } else if ($stream == "3E" || $stream == "3W"){
                                    $class_form = "Form 3";
                                } else if ($stream == "4E" || $stream == "4W"){
                                    $class_form = "Form 4";
                                }
            
                                return $class_form;
                            }
                          ?>
            
                          <div class="panel panel-primary w-auto" >
                            <div class="panel-heading">
                              Student result slips
                            </div>                    
                            <div class="panel-body">
                                <table class="" id="child_result_slips">
                                    <thead>
                                        <th>#No</th>
                                        <th>Year</th>
                                        <th>Class</th>
                                        <th>Stream</th>
                                        <th>Term</th>
                                        <th>Exam type</th>
                                        <th>Action</th>
                                    </thead>
            
                                    <tbody>
                                        
                                        @if (!$student_result_slips->isEmpty())
                                            @foreach ($student_result_slips as $result_slip)
                                                <tr>
                                                    <td>{{$i++}}</td>
                                                    <td>{{$result_slip->year}}</td>
                                                    <td><?php echo getClass($result_slip->class_name); ?></td>
                                                    <td>{{$result_slip->class_name}}</td>
                                                    <td>{{$result_slip->term}}</td>
                                                    <td>{{$result_slip->exam_type}}</td>
                                                    <td>
                                                        <a href="/studentDetails/resultSlips/{{$result_slip->year}}/{{$result_slip->term}}/{{$result_slip->exam_type}}/{{$result_slip->student_id}},{{$result_slip->class_name}}" target="blank" >
                                                            <button class="btn btn-outline-primary btn-sm">Download</button>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            
                                        @endif
                                    </tbody>
            
                                </table>
                            </div>
                          </div>
            
                   </div>
            
                   <div id="disciplinary_cases" class="tab-pane container fade">
                                  
                    <div class="panel panel-primary w-auto" >
                            <div class="panel-heading">
                              Student disciplinary cases
                            </div>                    
                            <div class="panel-body">
                                    @if (!$student_disciplinary_cases->isEmpty())
                                        <?php $j=1;?>
                                    <table class="table table-hover table-responsive-sm table-responsive-md " id="student_disciplinary_cases_table">
                                        <thead class="active">
                                            <th width="5%">#NO</th>
                                            <th>Case category.</th>
                                            <th>Case Description</th>
                                            <th>Date reported</th>
                                            <th>Teacher who reported</th>
                                            <th>Action taken</th>
                                            <th>Date action taken</th>
                                            <th>status</th>
                                        </thead>
                    
                                        <tbody>
                                            @foreach ($student_disciplinary_cases as $disciplinary_case)
                                                <tr>
                                                    <td>{{$j++}}</td>
                                                    <td>{{$disciplinary_case->case_category}}</td>
                                                    <td>{{$disciplinary_case->case_description}}</td>
                                                    <td>{{$disciplinary_case->date_reported}}</td>
                                                    <td>{{$disciplinary_case->first_name}} {{$disciplinary_case->last_name}}</td>
                                                    @if ($disciplinary_case->action_taked != null)
                                                      <td>{{$disciplinary_case->action_taked}}</td>
                                                    @else
                                                        <td>--</td>
                                                    @endif
            
                                                     @if ($disciplinary_case->date_action_taken!= null)
                                                      <td>{{$disciplinary_case->date_action_taken}}</td>
                                                    @else
                                                        <td>--</td>
                                                    @endif
                                                    @if ($disciplinary_case->case_status == 'cleared')
                                                        <td style="color:green;">{{$disciplinary_case->case_status}}</td>
                                                    @elseif($disciplinary_case->case_status == 'uncleared')
                                                         <td style="color:red;">{{$disciplinary_case->case_status}}</td>
                                                    @else
                                                        <td>{{$disciplinary_case->case_status}}</td>
                                                    @endif
            
                                                    
                                                </tr>
                                            @endforeach
                                        </tbody>
            
                                    </table>
                    
                                    @else
                                        <p>The student has no history of disciplinary cases</p>
                                    @endif
                            </div>
                    </div>                              
               </div>
            
            
            <!-- tab for showing student classes -->
               <div id="student_classes" class="tab-pane container fade">
                <?php $i=1; 
                
                  
                ?>
            
                <div class="panel panel-primary w-auto" >
                  <div class="panel-heading">
                    The classes students has been enrolled
                  </div>                    
                  <div class="panel-body">
                      <table class="table table-responsive-md table-responsive-sm table-responsive-lg table-responsive-xl" id="student_classes_table">
                          <thead>
                              <th>#No</th>
                              <th>Year</th>
                              <th>Class</th>
                              <th>Stream</th>
                              <th>Trial</th>
                              <th>Status</th>
                          </thead>
            
                          <tbody>
                              
                              @if (!$student_classes->isEmpty())
                                  @foreach ($student_classes as $classes_attended)
                                      <tr>
                                          <td>{{$i++}}</td>
                                          <td>{{$classes_attended->year}}</td>
                                          <td>{{$classes_attended->class_name}}</td>
                                          <td>{{$classes_attended->stream}}</td>
                                          <td>{{$classes_attended->trial}}</td>
                                          @if($classes_attended->status == "active")
                                            <td style="color: green;">{{$classes_attended->status}}</td>
                                          @else
                                            <td>{{$classes_attended->status}}</td>
                                          @endif
                                      </tr>
                                  @endforeach
                                  
                              @endif
                          </tbody>
            
                      </table>
                  </div>
                </div>
            
            </div>
            
            
            <!-- tab for paying fees-->
            <div id="pay_fees" class="tab-pane container @if(Session::get('error_occured') != null || Session::get('transaction_successful') != null || Session::get('time_out') != null || Session::get('cancelled_by_user') != null || Session::get('invalid_password') != null || Session::get('general_error') != null ) active @endif fade">
                <?php $i=1; 
                
                  
                ?>

                       


             <div class="row">
                        
    
                <div class="col-sm-10 offset-sm-1  col-md-10 0ffset-md-1  col-lg-10   col-xl-8 offset-xl-2">
                    
                               
                        <div class="panel panel-primary w-auto">
                             <div class="panel-heading">
                               Pay fees
                             </div>
                             
                             <form action="/api/school/stk/push" method="post" class="form-horizontal" name="pay_fees_form">
                                @csrf
                                <div class="panel-body">
                             
                             
                             
                                        <div class="row">
                                            <input type="hidden" name="student_id" value="{{$student_id}}" />
                                            <input type="hidden" name="parent_id" value="{{Session::get('parent_id')}}" />
                             <div class="form-group col-md-12 col-lg-12 col-xl-12" id="name_div">
                                 
                                        <label class="control-label" for="name">Name</label>
                                
                                     <div >
                                     <input type="text" readonly class="form-control" id="name" name="name" value="{{$name}}" />
                                         
                                     </div>
                              </div>
                                 
                                 
                                 <div class="form-group col-md-12 col-lg-12 col-xl-12" id="adm_no_div">
                                     <label class="control-label" for="adm_no"> Admission number</label>
                                     <div>
                                     <input type="number" class="form-control" readonly id="adm_no" name="adm_no" value="{{$adm_no}}" />

                                     </div>
                                 </div>

                                 <div class="form-group col-md-12 col-lg-12 col-xl-12" id="phone_no_div">
                                                <label class="control-label" for="phone_no"> Phone number</label>
                                                
                                                <input type="number" class="form-control"  id="phone_no" name="phone_no" value="{{$phone_no}}" />

                                                <div id="phone_no_error"></div>
                                 </div>

                                 <div class="form-group form-group col-md-12 col-lg-12 col-xl-12 " id="amount_div" >
                                 
                                        <label class=" control-label" for="amount">Amount</label>
                                
                                     
                                     <input type="number" class="form-control"  id="amount" name="amount"  />
                                         
                                     <div id="amount_error"></div>
                                </div>


                                
                             
                             <div class="form-group form-group col-md-6 col-lg-6 col-xl-6">
                                     <div class="">
                                         <button type="submit" name="save" class="btn btn-primary "  onclick="return validateFeePayInputs()">Pay </button>
                                     </div>
                                 </div>
                              
                                </div>
                             </div>
                             </form>
                             
                             
                              
                                
                              </div>
                                 
                             </div>
                                 </div>
            </div>


  

 <!-- tab for  fees statements-->
 <div id="fee_statements" class="tab-pane container fade">

    <?php $i = 1; ?>
    <div class="panel panel-primary w-auto">
    <div class="panel-heading">
      Student Fee statement
    </div>
       <div class="panel-body">

        <div style="margin-bottom: 30px;">
            
            <a href="/finance_department/download_fee_statement/{{$student_id}}" class="btn btn-outline-primary" target="_blank" style="float: right;">Download</a>
        </div>
        <div style="margin-top: 50px;">
            <table width="100%">
                <tr>
                    <th width="15%"></th>
                    <th></th>
                </tr>
                @foreach ($student_details as $student)
                    <tr>
                        <td> ADM NO.  </td>
                        <td>    : {{$student->admission_number}}</td>
                        
                    </tr>
                    <tr>
                            <td>Name </td>
                            <td>    : {{$student->first_name}} {{$student->middle_name}} {{$student->last_name}} </td>

                    </tr>

                    <tr>
                            <td>Date </td>
                                <td>    :  <?php echo date("d-m-Y"); ?></td>

                    </tr>
                @endforeach

                
            </table>

<br>
            <p style="text-decoration: underline; ">Fee transactions through the bank</p>
            <table width="100%" style="border-collapse: collapse; border:0px;">
                    <tr>
                        <th style="border-bottom: 1px solid; border-top: 1px solid;  padding: 5px;" align="left" width="5%">#NO</th>
                        <th style="border-bottom: 1px solid; border-top: 1px solid; padding: 5px;"  align="left"  >Bank Branch</th>
                        <th style="border-bottom: 1px solid; border-top: 1px solid; padding: 5px;"  align="left"width="30%">Reference number</th>
                        <th style="border-bottom: 1px solid; border-top: 1px solid; padding: 5px;" align="left" width="20%" >Date paid</th>
                        <th style="border-bottom: 1px solid; border-top: 1px solid; padding: 5px;" align="left" width="15%" >Amount</th>

                        
                    </tr>

                    @foreach ($fee_transactions as $fee_transaction )
                        <tr>
                                <td style=" padding: 5px;"><?php echo $i++; ?></td>
                                <td style=" padding: 5px;">{{$fee_transaction->branch}}</td>
                                 <td style=" padding: 5px;">{{$fee_transaction->transaction_no}}</td>
                                 <td style=" padding: 5px;">{{$fee_transaction->date_paid}}</td>
                                <td style=" padding: 5px;" >{{$fee_transaction->amount}}</td>
                        </tr>
                    @endforeach
                    
                    <tr>
                            <td style="border-bottom: 1px solid; padding: 5px;"></td>
                            <td style="border-bottom: 1px solid; padding: 5px;"></td>
                             <td style="border-bottom: 1px solid; padding: 5px;"></td>
                             <td style="border-bottom: 1px solid; padding: 5px;"></td>
                            <td style="border-bottom: 1px solid; padding: 5px;"></td>
                    </tr>

                    <tr>
                        <td style=" padding: 5px;"></td>
                        <td style=" padding: 5px;"></td>
                        <td style=" padding: 5px;"></td>
                        <td style=" padding: 5px;">Total</td>
                        <td style=" padding: 5px;">{{$bank_transactions_amount}}</td>
                    </tr>   

                


            </table>

            @if(!$mpesa_transactions->isEmpty())

                <?php $j = 1;?>
                <p style="text-decoration: underline;">Fee transactions though mpesa</p>
                <table width="100%" style="border-collapse: collapse; border:0px;">
                    <tr>
                        <th style="border-bottom: 1px solid; border-top: 1px solid;  padding: 5px;" align="left" width="5%">#NO</th>
                        <th style="border-bottom: 1px solid; border-top: 1px solid; padding: 5px;"  align="left"  >Phone Number</th>
                        <th style="border-bottom: 1px solid; border-top: 1px solid; padding: 5px;"  align="left"width="30%">Transaction code</th>
                        <th style="border-bottom: 1px solid; border-top: 1px solid; padding: 5px;" align="left" width="20%" >Date paid</th>
                        <th style="border-bottom: 1px solid; border-top: 1px solid; padding: 5px;" align="left" width="15%" >Amount</th>

                        
                    </tr>

                    @foreach ($mpesa_transactions as $mpesa_transaction )
                        <tr>
                                <td style=" padding: 5px;"><?php echo $j++; ?></td>
                                <td style=" padding: 5px;">{{$mpesa_transaction->phone_no}}</td>
                                 <td style=" padding: 5px;">{{$mpesa_transaction->transaction_code}}</td>
                                 <td style=" padding: 5px;">{{$mpesa_transaction->transaction_date}}</td>
                                <td style=" padding: 5px;" >{{$mpesa_transaction->amount}}</td>
                        </tr>
                    @endforeach

                     <tr>
                            <td style="border-bottom: 1px solid; padding: 5px;"></td>
                            <td style="border-bottom: 1px solid; padding: 5px;"></td>
                             <td style="border-bottom: 1px solid; padding: 5px;"></td>
                             <td style="border-bottom: 1px solid; padding: 5px;"></td>
                            <td style="border-bottom: 1px solid; padding: 5px;"></td>
                    </tr>

                    <tr>
                        <td style=" padding: 5px;"></td>
                        <td style=" padding: 5px;"></td>
                        <td style=" padding: 5px;"></td>
                        <td style=" padding: 5px;">Total</td>
                        <td style=" padding: 5px;">{{$mpesa_total}}</td>
                    </tr> 

                </table>

            @endif


            <table width="100%" style="border-collapse: collapse; border:0px;">
                <tr>
                    <th style="padding: 5px;" align="left" width="5%"></th>
                    <th style="padding: 5px;"  align="left"  ></th>
                    <th style="padding: 5px;"  align="left"width="30%"></th>
                    <th style="padding: 5px;" align="left" width="20%" ></th>
                    <th style="padding: 5px;" align="left" width="15%" ></th>

                    
                </tr>

                   @foreach ($student_fees as $student)
                        
                        <tr>
                                <td style=" padding: 5px;"></td>
                                <td style=" padding: 5px;"></td>
                                <td style=" padding: 5px;"></td>
                                <td style=" padding: 5px;">Total fees</td>
                                <td style=" padding: 5px;">{{$student->total_fees}}</td>
                        </tr>

                        <tr>
                            <td style=" padding: 5px;"></td>
                            <td style=" padding: 5px;"></td>
                            <td style=" padding: 5px;"></td>
                            <td style=" padding: 5px;">Total amount paid</td>
                            <td style=" padding: 5px;">{{$mpesa_total + $bank_transactions_amount}}</td>
                        </tr>

                        <tr>
                                <td style=" padding: 5px;"></td>
                                <td style=" padding: 5px;"></td>
                                <td style=" padding: 5px;"></td>
                                <td style=" padding: 5px;">Fees balance</td>
                                <td style=" padding: 5px;">{{$student->balance}}</td>
                        </tr>

                        <tr>
                                <td style=" padding: 5px;"></td>
                                <td style=" padding: 5px;"></td>
                                <td style=" padding: 5px;"></td>
                                <td style=" padding: 5px;">Overpay</td>
                                <td style=" padding: 5px;">{{$student->overpay}}</td>
                        </tr>
                   @endforeach

               

            </table>
        </div>
       </div>
    </div>
 </div>

       
</div>
</div>

         

  

       
<br>

    
      




    
@endsection