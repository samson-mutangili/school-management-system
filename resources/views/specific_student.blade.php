@extends('layouts.dashboard')

@section('content')

<div class="row">
        <div class="col-md-12">
            <h1 class="page-head-line">Student details</h1>
        </div>
</div>
<?php $i = 1;
?>

@if (!$student_details->isEmpty())
    @foreach ($student_details as $student)
    <?php $student_id = $student->id;
    $className = $student->stream; ?>
    <div class="panel panel-default w-auto" >
        <div class="panel-heading">
          Student personal details
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
        
        <div class="panel-body">
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
                                                <td> : {{$student->stream}}</td>
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
                                                            <td @if($student->status == 'active') style="color: green;" @endif> : {{$student->status}}</td>
                                                        </tr>
                                                
                                        </tbody>
                                    </table>
                    
                        </div>
                        </div>

                    <a href="/students/edit/{{$student->id}}" >Edit student details</a>
                </div>
                       
                    </div>
        </div>
    </div>
   
    @endforeach
    
@endif

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

<div style="margin-top: 15px;" class="row">
    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4" style="margin-bottom: 15px;">
            <button name="promote" id="promote" data-toggle="modal" data-target="#promote{{$student_id}}"  class="btn btn-outline-primary">Promote to next class</button>
    </div>

    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4" style="margin-bottom: 15px;">
            <button name="clear_btn" id="{{$student_id}}" data-toggle="modal" data-target="#clear_student{{$student_id}}"  class="btn btn-outline-danger">Student clearance</button>
    </div>
    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4" style="margin-bottom: 15px;">
        <button name="send_mail" id="sendMail{{$student_id}}" data-toggle="modal" data-target="#sendMailModal{{$student_id}}"  class="btn btn-outline-success">Send email to parent(s)</button>
    </div>


</div>
<!-- modal dialog form for promoting student to next class -->
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-lg-12 col-xl-12">
            <div class="modal" id="promote{{$student_id}}" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title pull-left" >Promote student to next class</h4>
                            <button class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <?php
                                //get the current year
                                $year = date("Y"); 
                            ?>
                            
                                        <form action="/students/promote" method = "POST" name="promote_to_next_class">
                                            @csrf
                                            <input type="hidden" name="student_id" value="{{$student_id}}"/>
                                            <input type="hidden" name="class_name" value="{{$className}}"/>

                                            @if ($className == "1E" || $className == "1W")
                                                 <input type="hidden" name="current_class" value="Form 1"/>
                                            @endif

                                            @if ($className == "2E" || $className == "2W")
                                                 <input type="hidden" name="current_class" value="Form 2"/>
                                            @endif

                                            @if ($className == "3E" || $className == "3W")
                                                <input type="hidden" name="current_class" value="Form 3"/>
                                            @endif

                                            @if ($className == "4E" || $className == "4W")
                                                 <input type="hidden" name="current_class" value="Form 4"/>
                                            @endif
                                         
                                            <div class="row">
                                                    <div class="col-xm-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                                            <div class="form-group" id="year_div">
                                                                    <label class="control-table" for="year">Year</label>
                                                                    <input type="number" name="year" id="year" class="form-control" placeholder="Enter year" value="<?php echo $year; ?>" readonly>
                                                                    <div id="year_error"></div>
                                                            </div>	
                                                      </div>
                                                
                                                      <div class="col-xm-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                                            <div class="form-group" id="trial_div">
                                                                    <label class="control-table" for="trial">Trial</label>
                                                                        <select id="trial" name="trial" class="form-control">
                                                                            <option>1</option>
                                                                            <option>2</option>
                                                                        </select>
                                                                        <div id="trial_error"></div>
                                                            </div>	
                                                      </div>

                                                      <div class="col-xm-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                                            <div class="form-group" id="next_class_div">
                                                                    <label class="control-table" for="postal_code">Next class</label>
                                                                    <select id="next_class" name="next_class" class="form-control" onchange="change_stream(this.id, 'class_stream')" required>
                                                                        <option></option>
                                                                        @if ($className == "1E" || $className == "1W")
                                                                            <option>Form 2</option>
                                                                            <option>Form 1</option>
                                                                        @endif

                                                                        @if ($className == "2E" || $className == "2W")
                                                                            <option>Form 3</option>
                                                                            <option>Form 2</option>
                                                                        @endif

                                                                        @if ($className == "3E" || $className == "3W")
                                                                            <option>Form 4</option>
                                                                            <option>Form 3</option>
                                                                        @endif

                                                                        @if ($className == "4E" || $className == "4W")
                                                                            <option>Form 4</option>
                                                                        @endif
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
                                                <button type="submit" class="btn btn-success" value="Update">Update</button>
                                                </div>
                                    </form>
                                    
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- modal dialog form for archiving student -->
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-lg-12 col-xl-12">
            <div class="modal" id="archive{{$student_id}}" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title pull-left" style="color:red;">Archive student details</h4>
                            <button class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            
                                        <form action="/students/archive" method = "POST" name="archive_dialog">
                                            @csrf
                                            <input type="hidden" name="student_id" value="{{$student_id}}"/>
                                            <input type="hidden" name="class_name" value="{{$className}}"/>
                                         
                                                <p>All student details in active classes will be disabled.
                                                    Are you sure you want to archive student details? 
                                                </p>
                                                <div style="align: center;" class="pull-right">
                                                 <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-danger" value="Update">Archive</button>
                                                </div>
                                    </form>
                                    
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- modal dialog form for archiving student -->
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
                                            <input type="hidden" name="class_name" value="{{$className}}"/>
                                         
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



<!-- modal dialog form for archiving student -->
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
                                            <input type="hidden" name="class_name" value="{{$className}}"/>
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

<div style="margin-top: 15px;" >

        <ul class="nav nav-tabs" style=" background-color: lightgrey; padding: 5px; border-radius: 3px;">
       <li class="active" style="margin-left: 20px; margin-right: 30px; margin-top: 5px; margin-bottom: 5px;"><a data-toggle="tab" href="#address">Address</a></li>
       <li style="margin-left: 20px; margin-right: 30px; margin-top: 5px; margin-bottom: 5px;"><a data-toggle="tab" href="#parents_details">Parents details</a></li>
       <li style="margin-left: 20px; margin-right: 30px; margin-top: 5px; margin-bottom: 5px;"><a data-toggle="tab" href="#result_slips">Result slips</a></li>
       <li style="margin-left: 20px; margin-right: 30px; margin-top: 5px; margin-bottom: 5px;"><a data-toggle="tab" href="#disciplinary_cases">Disciplinary cases</a></li>
       <li style="margin-left: 20px; margin-right: 30px; margin-top: 5px; margin-bottom: 5px;"><a data-toggle="tab" href="#student_classes">Student classes</a></li>

</ul>
<br>
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

     <div>
        @if ( Session::get('address_update_failed') != null)
    
        <div class="alert alert-danger alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Failed</strong> : {{ Session::get('address_update_failed')}}
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

     <div class="tab-content">
       <div id="address" class="tab-pane fade in active">
            
            <div class="panel panel-default w-auto" >
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
                                <button name="edit" id="{{$address->id}}" data-toggle="modal" data-target="#edit_modal{{$address->id}}" style="width: 7em;" class="btn btn-outline-primary">Edit</button>

                                <div class="container">
                                        <div class="row">
                                            <div class="col-xs-12 col-lg-12 col-xl-12">
                                                <div class="modal" id="edit_modal{{$address->id}}" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title pull-left">Edit address details</h4>
                                                                <button class="close" data-dismiss="modal">&times;</button>
                                                            </div>
                                                            <div class="modal-body">
                                                                
                                                                            <form action="/edit_address" method = "POST" name="address_form">
                                                                                @csrf
                                                                                <input type="hidden" name="student_id" value="{{$student_id}}"/>
                                                                                <input type="hidden" name="class_name" value="{{$className}}"/>
                                                                                <input type="hidden" name="address_id" value="{{$address->id}}"/>
                                                                             
                                                                                          <div class="row">
                                                                                                <div class="col-xm-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                                                                                      <div class="form-group" id="postal_code_div">
                                                                                                              <label class="control-table" for="postal_code">Postal code</label>
                                                                                                              <input type="number" name="postal_code" id="postal_code" class="form-control" placeholder="Enter postal code" value="{{ $address->postal_code }}">
                                                                                                              <div id="postal_code_error"></div>
                                                                                                      </div>	
                                                                                                </div>
                                                                          
                                                                                                <div class="col-xm-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                                                                                      <div class="form-group" id="postal_address_div">
                                                                                                              <label class="control-table" for="postal_address">Postal address</label>
                                                                                                              <input type="number" name="postal_address" id="postal_address" class="form-control" placeholder="Enter postal address" value="{{ $address->postal_address }}">
                                                                                                              <div id="postal_address_error"></div>
                                                                                                      </div>	
                                                                                                </div>
                                                                          
                                                                                                <div class="col-xm-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                                                                                      <div class="form-group" id="street_div">
                                                                                                              <label class="control-table" for="street">Street</label>
                                                                                                              <input type="text" name="street" id="street" class="form-control" placeholder="Enter street name" value="{{ $address->street }}">
                                                                                                              <div id="street_error"></div>
                                                                                                      </div>	
                                                                                                </div>
                                                                        
                                                                                                <div class="col-xm-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                                                                                        <div class="form-group" id="town_div">
                                                                                                                <label class="control-table" for="town">Town</label>
                                                                                                                <input type="text" name="town" id="town" class="form-control" placeholder="Enter town name" value="{{ $address->town }}">
                                                                                                                <div id="town_error"></div>
                                                                                                        </div>
                                                                                                    
                                                                                                </div>
                                                                                                
                                                                                                <div class="col-xm-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                                                                                        <div class="form-group" id="country_div">
                                                                                                                <label for="country">Country</label>
                                                                                                                <select id="country" name="country" class="form-control">
                                                                                                                    <option @if ($address->country == 'Kenya') selected @endif>Kenya</option>
                                                                                                                     <option @if ($address->country == 'Uganda') selected @endif>Uganda</option>
                                                                                                                     <option @if ($address->country == 'Tanzania') selected @endif>Tanzania</option>
                                                                                                                     <option @if ($address->country == 'Somalia') selected @endif>Somalia</option>
                                                                                                                </select>
                                                                                                                <div id="country_error"></div>
                                                                                                            </div>
                                                                                                    
                                                                                                </div>
                                                                                               
                                                                                            </div>
                                                                                    
                                                                                    <div style="align: center;" class="pull-right">
                                                                                     <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                                                                    <button type="submit" class="btn btn-success" value="Update">Update</button>
                                                                                    </div>
                                                                        </form>
                                                                        
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            @endforeach
                        @endif
                        
                    </div>
            </div>
       </div>
       
        <div id="parents_details" class="tab-pane fade">
                      
            <div class="panel panel-default w-auto" >
                    <div class="panel-heading">
                      Student parent(s)
                    </div>                    
                    <div class="panel-body">

                        @if (!$student_parents->isEmpty())
                            @foreach ($student_parents as $parent)
                                <fieldset style="border: 2px solid #333; border-radius: 10px; padding: 5px; margin: 10px 0px; " >
                                        <legend style="width: auto;">{{$parent->relation}} details</legend>
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
                                            <button name="edit" id="{{$parent->id}}" data-toggle="modal" data-target="#edit_modal{{$parent->id}}" style="width: 7em;" class="btn btn-outline-primary">Edit</button>
                                        </fieldset>

                                        <div class="container">
                                            <div class="row">
                                                <div class="col-xs-12 col-lg-12 col-xl-12">
                                                    <div class="modal" id="edit_modal{{$parent->id}}" tabindex="-1">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title pull-left">Edit {{$parent->relation}} details</h4>
                                                                    <button class="close" data-dismiss="modal">&times;</button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    
                                                                                <form action="/edit_parent_details" method = "POST" name="address_form">
                                                                                    @csrf
                                                                                    <input type="hidden" name="relation" value="{{$parent->relation}}"/>
                                                                                    <input type="hidden" name="student_id" value="{{$student_id}}"/>
                                                                                    <input type="hidden" name="class_name" value="{{$className}}"/>
                                                                                    <input type="hidden" name="parent_id" value="{{$parent->id}}"/>
                                                                                 
                                                                                              <div class="row">
                                                                                                    <div class="col-xm-12 col-sm-6 col-md-6 col-lg-4 col-xl-4">
                                                                                                          <div class="form-group" id="first_name_div">
                                                                                                                  <label class="control-table" for="first_name">First name</label>
                                                                                                                  <input type="text" name="first_name" id="first_name" class="form-control" placeholder="Enter first name" value="{{ $parent->first_name }}">
                                                                                                                  <div id="first_name_error"></div>
                                                                                                          </div>	
                                                                                                    </div>
                                                                              
                                                                                                    <div class="col-xm-12 col-sm-6 col-md-6 col-lg-4 col-xl-4">
                                                                                                          <div class="form-group" id="middle_name_div">
                                                                                                                  <label class="control-table" for="middle_name">Middle name</label>
                                                                                                                  <input type="text" name="middle_name" id="middle_name" class="form-control" placeholder="Enter middle name" value="{{ $parent->middle_name }}">
                                                                                                                  <div id="middle_name_error"></div>
                                                                                                          </div>	
                                                                                                    </div>
                                                                              
                                                                                                    <div class="col-xm-12 col-sm-6 col-md-6 col-lg-4 col-xl-4">
                                                                                                          <div class="form-group" id="last_name_div">
                                                                                                                  <label class="control-table" for="street">Last name</label>
                                                                                                                  <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Enter last name" value="{{ $parent->last_name }}">
                                                                                                                  <div id="last_name_error"></div>
                                                                                                          </div>	
                                                                                                    </div>
                                                                            
                                                                                                    <div class="col-xm-12 col-sm-6 col-md-6 col-lg-4 col-xl-4">
                                                                                                            <div class="form-group" id="id_no_div">
                                                                                                                    <label class="control-table" for="id_no">ID number</label>
                                                                                                                    <input type="number" name="id_no" id="id_no" class="form-control" placeholder="Enter ID number" value="{{ $parent->id_no }}">
                                                                                                                    <div id="id_no_error"></div>
                                                                                                            </div>
                                                                                                        
                                                                                                    </div>

                                                                                                    <div class="col-xm-12 col-sm-6 col-md-6 col-lg-8 col-xl-8">
                                                                                                            <div class="form-group" id="email_div">
                                                                                                                    <label class="control-table" for="phone_no">Email address</label>
                                                                                                                    <input type="email" name="email" id="email" class="form-control" placeholder="Enter email address" value="{{ $parent->email }}">
                                                                                                                    <div id="email_error"></div>
                                                                                                            </div>
                                                                                                        
                                                                                                    </div>

                                                                                                    <div class="col-xm-12 col-sm-6 col-md-6 col-lg-4 col-xl-4">
                                                                                                            <div class="form-group" id="phone_no_div">
                                                                                                                    <label class="control-table" for="phone_no">Phone number</label>
                                                                                                                    <input type="number" name="phone_no" id="phone_no" class="form-control" placeholder="Enter phone number" value="{{ $parent->phone_no }}">
                                                                                                                    <div id="phone_no_error"></div>
                                                                                                            </div>
                                                                                                        
                                                                                                    </div>

                                                                                                    <div class="col-xm-12 col-sm-6 col-md-6 col-lg-4 col-xl-4">
                                                                                                            <div class="form-group" id="occupation_div">
                                                                                                                    <label class="control-table" for="occupation">Occupation</label>
                                                                                                                    <input type="text" name="occupation" id="occupation" class="form-control" placeholder="Enter occupation" value="{{ $parent->occupation }}">
                                                                                                                    <div id="occupation_error"></div>
                                                                                                            </div>
                                                                                                        
                                                                                                    </div>

                                                                                                    <div class="col-xm-12 col-sm-6 col-md-6 col-lg-4 col-xl-4">
                                                                                                        <div class="form-group" id="gender_div">
                                                                                                                <label for="gender">Gender</label>
                                                                                                                <select id="gender" name="gender" class="form-control">
                                                                                                                    <option @if ($parent->gender == 'female') selected @endif>Female</option>
                                                                                                                     <option @if ($parent->gender == 'male') selected @endif>Male</option>
                                                                                                                </select>
                                                                                                                <div id="gender_error"></div>
                                                                                                            </div>
                                                                                                    
                                                                                                   </div>
                                                                    
                                                                                                   
                                                                                                </div>
                                                                                        
                                                                                        <div style="align: center;" class="pull-right">
                                                                                         <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                                                                        <button type="submit" class="btn btn-success" value="Update">Update</button>
                                                                                        </div>
                                                                            </form>
                                                                            
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                            @endforeach
                        @endif
                    </div>
            </div>                              
       </div>

       <div id="result_slips" class="tab-pane fade">
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

              <div class="panel panel-default w-auto" >
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

       <div id="disciplinary_cases" class="tab-pane fade">
                      
        <div class="panel panel-default w-auto" >
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
   <div id="student_classes" class="tab-pane fade">
    <?php $i=1; 
    
      
    ?>

    <div class="panel panel-default w-auto" >
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
                                <td>{{$classes_status->trial}}</td>
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






    
@endsection