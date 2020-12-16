@extends('layouts.dashboard')

@section('content')

@if (!$student_details->isEmpty())
    

<div class="row">
        <div class="col-md-12">
            <h1 class="page-head-line">Student details</h1>
        </div>
</div>
<?php $i = 1;
$student_id = "";
?>

<ul class="nav nav-tabs">
        <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#bio_data">Bio data</a>
              </li>
    <li class="nav-item">
      <a class="nav-link " data-toggle="tab" href="#address">Address</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#parents_details">Parents details</a>
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
                @if ( Session::get('failed_to_resume') != null)
            
                <div class="alert alert-danger alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Failed</strong> : {{ Session::get('failed_to_resume')}}
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

        <div class="tab-content">
                <div id="bio_data" class="tab-pane container active">

                        @if (!$student_details->isEmpty())
                        @foreach ($student_details as $student)
                        <?php $student_id = $student->student_id;
                        $className = "1E";
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
                                                                                <td  @if($student->status == 'active') style="color: green;" @else style="color: red;" @endif> : {{$student->status}}</td>
                                                                            </tr>
                                                                    
                                                            </tbody>
                                                        </table>
                                        
                                            </div>
                                            </div>
                    
                                        {{-- <a href="/students/edit/{{$student->id}}" >Edit student details</a> --}}
                                    </div>
                                           
                                        </div>
                            </div>
                        </div>
                       
                        @endforeach
                        
                    @endif
                      
                    
                    <div style="margin-top: 15px;" class="row">
                        <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4" style="margin-bottom: 15px;">
                            <button name="session" id="session{{$student_id}}" data-toggle="modal" data-target="#backToSession{{$student_id}}"  class="btn btn-outline-primary">Back to session?</button>
                        </div>
                       
                    
                        <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4" style="margin-bottom: 15px;">
                                <button name="clear_btn" id="{{$student_id}}" data-toggle="modal" data-target="#clear_student{{$student_id}}"  class="btn btn-outline-danger">Student clearance</button>
                        </div>
                        <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4" style="margin-bottom: 15px;">
                            <button name="send_mail" id="sendMail{{$student_id}}" data-toggle="modal" data-target="#sendMailModal{{$student_id}}"  class="btn btn-outline-success">Send email to parent(s)</button>
                        </div>
                    
                    
                    </div>

                  
                    
                    <!-- modal dialog form for return student to session -->
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12 col-lg-12 col-xl-12">
                                <div class="modal" id="backToSession{{$student_id}}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title pull-left" >Resume student to session</h4>
                                                <button class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <?php
                                                    //get the current year
                                                    $year = date("Y"); 
                                                ?>
                                                
                                                            <form action="/students/OutOfSession/resume" method = "POST" name="promote_to_next_class">
                                                                @csrf
                                                                <input type="hidden" name="student_id" value="{{$student_id}}"/>
                                                                <input type="hidden" name="out_of_session" value="yes"/>
                    
                                                                <p>When a student resumes back to session, he or she should be assigned a class. Please fill in the 
                                                                    form below to assign the student a class</p>

                                                             
                                                                <div class="row">
                                                                        <div class="col-xm-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                                                                <div class="form-group" id="year_div">
                                                                                        <label class="control-table" for="year">Year</label>
                                                                                        <input type="number" name="year" id="year" class="form-control" placeholder="Enter year" value="<?php echo $year; ?>" readonly>
                                                                                        <div id="year_error"></div>
                                                                                </div>	
                                                                          </div>
                                                                    
                                                                          <div class="col-xm-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                                                                <div class="form-group" id="trial_div">
                                                                                        <label class="control-table" for="trial">Trial</label>
                                                                                            <select id="trial" name="trial" class="form-control" required>
                                                                                                <option value="">Select trial</option>
                                                                                                <option>1</option>
                                                                                                <option>2</option>
                                                                                            </select>
                                                                                            <div id="trial_error"></div>
                                                                                </div>	
                                                                          </div>
                    
                                                                          <div class="col-xm-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                                                                <div class="form-group" id="next_class_div">
                                                                                        <label class="control-table" for="postal_code">Next class</label>
                                                                                        <select id="next_class" name="next_class" class="form-control" required onchange="change_stream(this.id, 'class_stream')" required>
                                                                                            <option value="">Select class</option>
                                                                                                <option>Form 1</option>
                                                                                                 <option>Form 2</option>
                                                                                                <option>Form 3</option>                                                                                            
                                                                                                <option>Form 4</option>
                                                                                            
                                                                                            </select>
                                                                                        <div id="next_class_error"></div>
                                                                                </div>	
                                                                          </div>
                    
                                                                          <div class="col-xm-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                                                                <div class="form-group" id="class_stream_div">
                                                                                        <label class="control-table" for="class_stream">Class stream</label>
                                                                                            <select id="class_stream" name="class_stream" class="form-control" required>
                                                                                                
                                                                                            </select>
                                                                                        <div id="class_stream_error"></div>
                                                                                </div>	
                                                                          </div>
                                              
                                                                    
                                                                </div>
                                                                    <div style="align: center;" class="pull-right">
                                                                     <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                                                    <button type="submit" class="btn btn-success" value="Update">Assign</button>
                                                                    </div>
                                                        </form>
                                                        
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- modal dialog form for clearing student -->
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12 col-lg-12 col-xl-12">
                                <div class="modal" id="clear_student{{$student_id}}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title pull-left" style="color:red;">Student clearance</h4>
                                                <button class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                
                                                            <form action="/students/clear_student" method = "POST" name="student_clearance_dialog">
                                                                @csrf
                                                                <input type="hidden" name="student_id" value="{{$student_id}}"/>
                                                                <input type="hidden" name="out_of_session" value="yes"/>
                                                             
                                                                    <p>All student details in active classes will be disabled. However, you can find the student details as an alumni.
                                                                        Are you sure you want to clear student? 
                                                                    </p>
                                                                    <div style="align: center;" class="pull-right">
                                                                     <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                                                    <button type="submit" class="btn btn-success" value="Clear student">Clear student</button>
                                                                    </div>
                                                        </form>
                                                        
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
                    
                    <!-- modal dialog form for sending email to student parent -->
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12 col-lg-12 col-xl-12">
                                <div class="modal" id="sendMailModal{{$student_id}}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title pull-left" >Send email to student parent(s)</h4>
                                                <button class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                
                                                            <form action="/students/sendMail" method = "POST" name="send_mail_dialog">
                                                                @csrf
                                                                <input type="hidden" name="student_id" value="{{$student_id}}"/>
                                                                <input type="hidden" name="out_of_session" value="yes"/>
                                                                <div class="row">
                                                                    <div class="col-xm-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                                                            <div class="form-group" id="subject_div">
                                                                                    <label class="control-table" for="subject">Subject</label>
                                                                                    <input type="text" name="subject" id="subject" class="form-control" placeholder="Enter email subject" required>
                                                                                    <div id="subject_error"></div>
                                                                            </div>	
                                                                      </div>
                    
                                                                      <div class="col-xm-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                                                        <div class="form-group" id="message_body_div">
                                                                                <label class="control-table" for="message_body">Message body</label>
                                                                                <textarea  name="message_body" id="message_body" class="form-control" placeholder="Enter the message to be sent here" rows="3" required></textarea>
                                                                                <div id="subject_error"></div>
                                                                        </div>	
                                                                  </div>
                                                                </div>
                                                                    <div style="align: center;" class="pull-right">
                                                                     <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                                                    <button type="submit" class="btn btn-success" value="Clear student">Send email</button>
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
                   
                    <div id="parents_details" class="tab-pane container fade">
                                  
                        <div class="panel panel-primary w-auto" >
                                <div class="panel-heading">
                                  Student parent(s)
                                </div>                    
                                <div class="panel-body">
            
                                    @if (!$student_parents->isEmpty())
                                        @foreach ($student_parents as $parent)
                                            <fieldset style="border: 2px solid #333; border-radius: 10px; padding: 5px; margin: 10px 0px; " >
                                                    <legend style="width: auto;">{{$parent->relationship}} details</legend>
                                                    <table>
                                                            <tbody>
                                                                <tr>
                                                                    <td align="left">Name</td>
                                                                    <td> : {{$parent->first_name}} {{$parent->middle_name}} {{$parent->last_name}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="left">Email address</td>
                                                                    <td> : {{$parent->email}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="left">National ID no</td>
                                                                    <td> : {{$parent->id_no}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="left">Phone number</td>
                                                                    <td> : {{$parent->phone_no}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="left">Gender</td>
                                                                    <td> : {{$parent->gender}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="left">Occupation</td>
                                                                    <td> : {{$parent->occupation}}</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <br>
                                                    </fieldset>
            
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
                                <table class="table table-responsive-md table-responsive-sm table-responsive-lg table-responsive-xl" id="result_slips_table">
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
                                                        <a href="/studentDetails/resultSlips/{{$result_slip->year}}/{{$result_slip->term}}/{{$result_slip->exam_type}}/{{$result_slip->student_id}},{{$result_slip->class_name}}" target="blank">
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
            
            


        </div>
  </div>


       

         

  

       
<br>

    
@else

<p style="color: red;">No student is out of session</p>
@endif




    
@endsection