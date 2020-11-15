@extends('layouts.dashboard')

@section('content')

<div class="row">
        <div class="col-md-12">
            <h1 class="page-head-line">Alumni student details</h1>
        </div>
</div>
<?php $i = 1;
?>

@if (!$student_details->isEmpty())
    @foreach ($student_details as $student)
    <?php $student_id = $student->id;
    // $className = $student->stream; ?>
    <div class="panel panel-default w-auto" >
        <div class="panel-heading">
          Student personal details
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
                        <div class="col-md-6 col-lg-4 col-xl-4 ">
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
                                                    <tr>
                                                        <td align="left">Date left</td>
                                                        <td> : {{$student->date_left}}</td>
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
                                                            <td @if($student->status == 'active') style="color: green;" @elseif($student->status == 'cleared') style="color:red;" @endif> : {{$student->status}}</td>
                                                        </tr>
                                                
                                        </tbody>
                                    </table>
                    
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

   <div id="student_classes" class="tab-pane fade">
    <?php $i=1; 
    
      
    ?>

    <div class="panel panel-default w-auto" >
      <div class="panel-heading">
        The classes students was enrolled
      </div>                    
      <div class="panel-body">
          <table class="table table-responsive-md table-responsive-sm table-responsive-lg table-responsive-xl" id="student_classes_table">
              <thead>
                  <th>#No</th>
                  <th>Year</th>
                  <th>Class</th>
                  <th>Stream</th>
                  <th>Trial</th>
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