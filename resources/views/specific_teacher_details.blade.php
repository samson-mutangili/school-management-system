@extends('layouts.dashboard')

@section('content')

<?php 
        $i =1;
?>

<div style="margin-left: 10px; margin-top: 10px;">
<?php 
    //get the year, term and exam type
    $year = date("Y");
            $month = date("m");

            $term;
            $exam_type;

            if($month >= 1 && $month <= 4){
                $term = "Term 1";
                if($month == 1){
                    $exam_type = "Opener";
                }
                else if($month == 2){
                    $exam_type = "Mid term";
                }
                else if($month == 3 || $month == 4){
                    $exam_type = "End term";
                }
            }
            else if($month >= 5 && $month <= 8){
                $term = "Term 2";
                if($month == 5){
                    $exam_type = "Opener";
                }
                else if($month == 6){
                    $exam_type = "Mid term";
                }
                else if($month == 7 || $month == 8){
                    $exam_type = "End term";
                }
            } 
            else if($month >= 9 && $month <= 12){
                $term = "Term 3";
                if($month == 9){
                    $exam_type = "Opener";
                }
                else if($month == 10){
                    $exam_type = "Mid term";
                }
                else if($month == 11 || $month == 12){
                    $exam_type = "End term";
                }
            }

?>


@foreach ($specific_teacher as $teacher )
<div class="row">
<div class="col-lg-5 col-md-5 col-sm-10 col-xs-10" style="border: 1px solid black; border-radius: 10px; margin-left: 10px; margin-bottom: 10px; padding: 10px 10px 10px 10px;">

<h3 style="color: green; text-decoration: underline;">Teacher personal details</h3>
@if ( Session::get('updated_successfully') != null)

    <div class="alert alert-success">
            <strong>Success</strong> : {{ Session::get('updated_successfully')}}
    </div>

@endif
    <table cellspacing="7" cellpadding="7">
       
        <tbody>
            <tr>
                <td align="left">Name</td>
                <td>: {{ $teacher->first_name}} {{$teacher->middle_name}} {{$teacher->last_name}}</td>
            </tr>

            <tr>
                <td align="left"> Phone number</td>
                <td>: {{$teacher->phone_no}}</td>
            </tr>

            <tr>
                    <td align="left"> Email address</td>
                    <td>: {{$teacher->email}}</td>
            </tr>
            
            <tr>
                    <td align="left"> ID Number</td>
                    <td>: {{$teacher->id_no}}</td>
            </tr>


            <tr>
                    <td align="left"> TSC number</td>
                    <td>: {{$teacher->tsc_no}}</td>
            </tr>  
            
            <tr>
                    <td align="left"> Gender</td>
                    <td>: {{$teacher->gender}}</td>
            </tr>

            <tr>
                    <td align="left"> Teaching subject 1</td>
                    <td>: {{$teacher->subject_1}}</td>
            </tr>

            <tr>
                    <td align="left"> Teaching subject 2</td>
                    <td>: {{$teacher->subject_2}}</td>
            </tr>

            <tr>
                    <td align="left"> Nationality</td>
                    <td>: {{$teacher->nationality}}</td>
            </tr>  
          
            <tr>
                    <td align="left"> Date of hire</td>
                    <td>: {{$teacher->date_hired}}</td>
            </tr>

        </tbody>
    </table>
 
<button name="edit" id="{{$teacher->id}}" data-toggle="modal" data-target="#edit_modal{{$teacher->id}}" style="margin-top: 20px; width: 7em;" class="btn btn-success">Edit</button>

<button name="archive" id="{{$teacher->id}}" data-toggle="modal" data-target="#archive_modal{{$teacher->id}}" style="margin-top: 20px; width: 7em; margin-left: 30px;"  class="btn btn-danger">Archive</button>


<div class="container">
		<div class="row">
			<div class="col-xs-12 col-lg-12 col-xl-12">
				<div class="modal" id="edit_modal{{$teacher->id}}" tabindex="-1">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title pull-left">Edit staff details</h4>
								<button class="close" data-dismiss="modal">&times;</button>
							</div>
							<div class="modal-body">
                                
                                            <form action="/edit_teacher" method = "POST" name="teacher_form">
                                                @csrf
                                                <input type="hidden" name="id" value="{{$teacher->id}}"/>
                                             
                                                          <div class="row">
                                                                <div class="col-xm-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                                                      <div class="form-group" id="teacher_first_name_div">
                                                                              <label class="control-table" for="teacher_first_name">First name</label>
                                                                              <input type="text" name="teacher_first_name" id="teacher_first_name" class="form-control" placeholder="Enter first name" value="{{ $teacher->first_name }}">
                                                                              <div id="teacher_first_name_error"></div>
                                                                      </div>	
                                                                </div>
                                          
                                                                <div class="col-xm-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                                                      <div class="form-group" id="teacher_middle_name_div">
                                                                              <label class="control-table" for="teacher_middle_name">Enter middle name</label>
                                                                              <input type="text" name="teacher_middle_name" id="teacher_middle_name" class="form-control" placeholder="Enter middle name" value="{{ $teacher->middle_name }}">
                                                                              <div id="teacher_middle_name_error"></div>
                                                                      </div>	
                                                                </div>
                                          
                                                                <div class="col-xm-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                                                      <div class="form-group" id="teacher_last_name_div">
                                                                              <label class="control-table" for="teacher_last_name">Last name</label>
                                                                              <input type="text" name="teacher_last_name" id="teacher_last_name" class="form-control" placeholder="Enter last name" value="{{ $teacher->last_name }}">
                                                                              <div id="teacher_last_name_error"></div>
                                                                      </div>	
                                                                </div>
                                        
                                                                <div class="col-xm-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                                                        <div class="form-group" id="teacher_phone_no_div">
                                                                                <label class="control-table" for="teacher_phone_no">Phone number</label>
                                                                                <input type="number" name="teacher_phone_no" id="teacher_phone_no" class="form-control" placeholder="Enter phone number" value="{{ $teacher->phone_no }}">
                                                                                <div id="teacher_phone_no_error"></div>
                                                                        </div>
                                                                    
                                                                </div>
                                
                                                                <div class="col-xm-12 col-sm-12 col-md-6 col-lg-8 col-xl-8">
                                                                        <div class="form-group" id="teacher_email_div">
                                                                                <label class="control-table" for="teacher_email">Email address</label>
                                                                                <input type="email" name="teacher_email" id="teacher_email" class="form-control" placeholder="Enter email address" value="{{ $teacher->email }}">
                                                                                <div id="teacher_email_error"></div>
                                                                        </div>
                                                                    
                                                                </div>
                                
                                                                <div class="col-xm-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                                                        <div class="form-group" id="tsc_no_div">
                                                                                <label for="tsc_no">TSC number</label>
                                                                                <input type="number" id="tsc_no" class="form-control" name="tsc_no" value="{{ $teacher->tsc_no }}" >
                                                                                <div id="tsc_no_error"></div>
                                                                        </div>
                                                                    
                                                                </div>
                                        
                                                                <div class="col-xm-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                                                        <div class="form-group" id="teacher_id_no_div">
                                                                                <label for="teacher_id_no">ID number</label>
                                                                                <input type="number" id="teacher_id_no" class="form-control" name="teacher_id_no" value="{{ $teacher->id_no }}">
                                                                                <div id="teacher_id_no_error"></div>
                                                                        </div>
                                                            
                                                                </div>
                                
                                                                <div class="col-xm-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                                                        <div class="form-group" id="subject_1_div">
                                                                                <label for="subject_1">Subject 1</label>
                                                                                <select id="subject_1" name="subject_1" class="form-control" onchange="populate(this.id,'subject_2')">
                                                                                    <option value=""></option>
                                                                                    <option selected value="{{ $teacher->subject_1 }}">{{ $teacher->subject_1 }}</option>
                                                                                    <option value="english">English</option>
                                                                                     <option value="kiswahili">Kiswahili</option>
                                                                                     <option value="mathematics">Mathematics</option>
                                                                                     <option value="chemistry">Chemistry</option>
                                                                                     <option value="biology">Biology</option>
                                                                                     <option value="physics">Physics</option>
                                                                                     <option value="geography">Geography</option>
                                                                                     <option value="history">History</option>
                                                                                     <option value="cre">Christian Religious Education</option>
                                                                                     <option value="agriculture">Agriculture</option>
                                                                                     <option value="business_studies">Business studies</option>
                                                                                </select>
                                                                                <div id="subject_1_error"></div>
                                                                            </div>
                                                                    
                                                                </div>  
                                
                                                                <div class="col-xm-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                                                        <div class="form-group" id="subject_2_div">
                                                                                <label for="subject_2">Subject 2</label>
                                                                                <select id="subject_2" name="subject_2" class="form-control">
                                                                                   <option selected value="{{ $teacher->subject_2 }}">{{ $teacher->subject_2 }}</option>
                                                                                </select>
                                                                                <div id="subject_2_error"></div>
                                                                            </div>
                                                                    
                                                                </div>  
                                        
                                                                <div class="col-xm-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                                                        <div class="form-group" id="teacher_gender_div">
                                                                                <label for="teacher_gender">Gender</label>
                                                                                <select id="teacher_gender" name="teacher_gender" class="form-control">
                                                                                    <option selected value="{{ $teacher->gender }}">{{ $teacher->gender }}</option>
                                                                                    <option>Male</option>
                                                                                     <option>Female</option>
                                                                                </select>
                                                                                <div id="teacher_gender_error"></div>
                                                                            </div>
                                                                    
                                                                </div>                                
                                        
                                                                <div class="col-xm-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                                                        <div class="form-group" id="teacher_religion_div">
                                                                                <label for="teacher_religion">Religion</label>
                                                                                <select id="teacher_religion" name="teacher_religion" class="form-control">
                                                                                    <option selected value="{{ $teacher->religion }}">{{ $teacher->religion }}</option>
                                                                                    <option>Christian</option>
                                                                                     <option>Islam</option>
                                                                                     <option>Other</option>
                                                                                </select>
                                                                                <div id="teacher_religion_error"></div>
                                                                            </div>
                                                                </div>
                                        
                                                                <div class="col-xm-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                                                        <div class="form-group" id="teacher_nationality_div">
                                                                                <label for="teacher_nationality">Nationality</label>
                                                                                <select id="teacher_nationality" name="teacher_nationality" class="form-control">
                                                                                    <option selected value="{{ $teacher->nationality }}">{{ $teacher->nationality }}</option>
                                                                                    <option>Kenyan</option>
                                                                                     <option>Ugandan</option>
                                                                                     <option>Tanzania</option>
                                                                                     <option>Somalian</option>
                                                                                </select>
                                                                                <div id="teacher_nationality_error"></div>
                                                                            </div>
                                                        
                                                                </div>
                                          
                                                            </div>
                                                    
                                                    <div style="align: center;" class="pull-right">
                                                    <input type="submit" class="btn btn-success" value="Submit" onclick="return validateTeacher()"></input>
                                                    </div>
                                        </form>
                                        
                                
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
    

    <div class="container">
            <div class="row">
                <div class="col-xs-12 col-lg-12 col-xl-12">
                    <div class="modal" id="archive_modal{{$teacher->id}}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title pull-left" style="color: red;">Archive Teacher details</h4>
                                    <button class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <form action="/archive_teacher" method = "POST">
                                    @csrf
                                    <input type="hidden" name="id" value='{{$teacher->id}}'/>
                                    <div class="row">
                                        <p>Are you sure {{ $teacher->first_name}} {{$teacher->last_name}} has stopped teaching in this school in order to archive the details??</p>                                     
                                    </div>
                                    <div class="modal-footer">
                                                <button type="button" class="btn btn-success" data-dismiss="modal">NO, Cancel</button>
                                                <input type="submit" class="btn btn-danger" value="Yes, Archive"></input>
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

<div class="col-lg-6 col-md-6 col-sm-10 col-xs-10" style=" border: 1px solid black; border-radius: 10px; margin-left: 10px; margin-bottom: 10px; padding: 10px 10px 10px 10px;">
         <h3 style="color: green; text-decoration: underline;">Roles and responsibilities</h3>

         <ul class="nav nav-tabs" style=" background-color: lightgray;">
        <li class="active" style="margin-left: 20px; margin-right: 30px;"><a data-toggle="tab" href="#special_roles">Special Roles</a></li>
        <li style="margin-left: 20px; margin-right: 30px;"><a data-toggle="tab" href="#responsibilities">Responsibilities</a></li>
        <li><a data-toggle="tab" href="#teaching_classes">Teaching classes</a></li>
</ul>

        <div style="margin-top: 10px;">
                        @if ( Session::get('role_added_successfully') != null)

                        <div class="alert alert-success">
                                <strong>Success</strong> : {{ Session::get('role_added_successfully')}}
                        </div>
                
                        @endif
        </div>

        <div style="margin-top: 10px;">
                        @if ( Session::get('responsibility_added_successfully') != null)

                        <div class="alert alert-success">
                                <strong>Success</strong> : {{ Session::get('responsibility_added_successfully')}}
                        </div>
                
                        @endif
        </div>

        <div style="margin-top: 10px;">
                        @if ( Session::get('special_role_removed') != null)

                        <div class="alert alert-success">
                                <strong>Success</strong> : {{ Session::get('special_role_removed')}}
                        </div>
                
                        @endif
        </div>

        <div style="margin-top: 10px;">
                        @if ( Session::get('responsibility_removed') != null)

                        <div class="alert alert-success">
                                <strong>Success</strong> : {{ Session::get('responsibility_removed')}}
                        </div>
                
                        @endif
        </div>

        <div style="margin-top: 10px;">
            @if ( Session::get('class_taken') != null)

            <div class="alert alert-danger">
                    <strong>Failed</strong> : {{ Session::get('class_taken')}}
            </div>
    
            @endif
        </div>

        <div style="margin-top: 10px;">
            @if ( Session::get('teaching_class_successful') != null)

            <div class="alert alert-success">
                    <strong>Success</strong> : {{ Session::get('teaching_class_successful')}}
            </div>

            @endif
        </div>

        <div style="margin-top: 10px;">
            @if ( Session::get('teacher_class_withdrawn') != null)

            <div class="alert alert-success">
                    <strong>Success</strong> : {{ Session::get('teacher_class_withdrawn')}}
            </div>

            @endif
        </div>


      <div class="tab-content">
        <div id="special_roles" class="tab-pane fade in active">
          <table class="table table-bordered  table-condensed" style="margin-top: 30px;">
                  <thead>
                          <th>S/NO</th>
                          <th>Roles</th>
                          <th>Action</th>
                  </thead>
                  <tbody>
                          @if ($roles_and_responsibilities != null)
                              
                         

                          @if ($roles_and_responsibilities->special_role != null)
                              
                          <tr>
                              <td><?php echo $i++ ?></td>
                              <td>{{ $roles_and_responsibilities->special_role}}</td>
                              <td><button id="{{$teacher->id}}" name="remove_button" data-toggle="modal" data-target="#role_modal{{$roles_and_responsibilities->teacher_id}}" class="btn btn-danger">Remove</button></td>
                          </tr>
                          @endif

                          @endif
                          

                          
                          
                  </tbody>
          </table>
          <?php 

                if($roles_and_responsibilities == null){
                        echo '<p>The teacher has no special roles. Click <a id="'.$teacher->id.'" href="#" data-toggle="modal" data-target="#add_role_modal'.$teacher->id.'">here</a> to add a special role.</p>';
                } else if($roles_and_responsibilities->special_role == null){
                        echo '<p>The teacher has no special roles. Click <a id="'.$teacher->id.'" href="#" data-toggle="modal" data-target="#add_role_modal'.$teacher->id.'">here</a> to add a special role.</p>';

                }

           ?>

           <div class="container">
                        <div class="row">
                            <div class="col-xs-12 col-lg-12 col-xl-12">
                                <div class="modal" id="role_modal{{$teacher->id}}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title pull-left" style="color: red;">Deny special roles to teacher</h4>
                                                <button class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="/denySpecialRole" method = "POST">
                                                @csrf
                                                <input type="hidden" name="id" value='{{$teacher->id}}'/>
                                                <div class="row">
                                                    <p>Are you sure you want to deny this special role to the teacher??</p>                                     
                                                </div>
                                                <div class="modal-footer">
                                                            <button type="button" class="btn btn-success" data-dismiss="modal">NO, Cancel</button>
                                                            <input type="submit" class="btn btn-danger" value="Yes, Remove"></input>
                                                </div>
                                                </form>	
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="container">
                                <div class="row">
                                    <div class="col-xs-12 col-lg-12 col-xl-12">
                                        <div class="modal" id="add_role_modal{{$teacher->id}}" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title pull-left">Assign role</h4>
                                                        <button class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="/add_role" method = "POST" name="role_form">
                                                        @csrf
                                                        <input type="hidden" name="id" value='{{$teacher->id}}'/>
                                                        <div class="row">
                                                                <?php
                                                                        

                                                                        $deputy_principal = null;
                                                                        $boarding_master = null;

                                                                        foreach($set_roles_and_responsiblities as $already_set_roles){
                                                                               
                                                                                if($already_set_roles->special_role == 'Deputy principal'){
                                                                                        $deputy_principal = "Deputy principal";
                                                                                }
                                                                                if($already_set_roles->special_role == 'Boarding master'){
                                                                                        $boarding_master = 'Boarding master';
                                                                                }
                                                                        }
                                                                ?>

                                                                 <div style="margin-left: 20px;" class="form-group" id="role_div">
                                                                         <label for="role">Select role</label>
                                                                         <select id="role" name="role" class="form-control" required>
                                                                                 <option value=""></option>
                                                                                 @if (Session::get('is_admin'))
                                                                                    <option value="Principal">Principal</option>
                                                                                 @endif  

                                                                                 @if ($deputy_principal == null)
                                                                                 <option value="Deputy principal">Deputy principal</option>
                                                                                 @endif

                                                                                 @if ($boarding_master == null)
                                                                                 <option value="Boarding master">Boarding master</option>
                                                                                 @endif    

                                                                                                                                                           
                                                                                
                                                                                <option value="Examination and student admission">Examination and student admission</option>
                                                                         </select>
                                                                    <div id="role_error"></div>
                                                                </div>
                                                                                               
                                                        </div>
                                                        <div class="modal-footer">
                                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">NO, Cancel</button>
                                                                    <input type="submit" class="btn btn-success" onclick="return validateRole()" value="Add"></input>
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
        <div id="responsibilities" class="tab-pane fade">
                        <table class="table table-bordered  table-condensed" style="margin-top: 30px;">
                                        <thead>
                                                <th>S/NO</th>
                                                <th>Responsibility</th>
                                                <th>Class</th>
                                                <th>Action</th>
                                        </thead>
                                        <tbody>
                                                @if ($roles_and_responsibilities != null)
                                                    
                                               
                      
                                                @if ($roles_and_responsibilities->responsibility != null)
                                                    
                                                <tr>
                                                    <td><?php $j=1; echo $j++ ?></td>
                                                    <td>{{ $roles_and_responsibilities->responsibility}}</td>
                                                    <th>{{ $roles_and_responsibilities->class_teacher }}</th>
                                                    <td><button id="{{$roles_and_responsibilities->teacher_id}}" name="remove_button" data-toggle="modal" data-target="#responsibility_modal{{$roles_and_responsibilities->teacher_id}}" class="btn btn-danger">Remove</button></td>
                                                </tr>
                                                @endif
                      
                                                @endif
                                                
                      
                                                
                                                
                                        </tbody>
                                </table>

                                <?php
                                
                                if($roles_and_responsibilities == null){
                                        echo '<p>The teacher is not in charge of any class. Click <a id="' .$teacher->id.'" href="#" data-toggle="modal" data-target="#add_responsibility_modal'.$teacher->id.'">here</a> to add the teacher as a class teacher.</p>';
                                } else if($roles_and_responsibilities->responsibility == null){
                                        echo '<p>The teacher is not in charge of any class. Click <a id="' .$teacher->id.'" href="#" data-toggle="modal" data-target="#add_responsibility_modal'.$teacher->id.'">here</a> to add the teacher as a class teacher.</p>'; 
                                }

                                ?>
                                 <div class="container">
                                                <div class="row">
                                                    <div class="col-xs-12 col-lg-12 col-xl-12">
                                                        <div class="modal" id="responsibility_modal{{$teacher->id}}" tabindex="-1">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title pull-left" style="color: red;">Deny class teacher responsibility</h4>
                                                                        <button class="close" data-dismiss="modal">&times;</button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form action="/denyResponsibility" method = "POST">
                                                                        @csrf
                                                                        <input type="hidden" name="id" value='{{$teacher->id}}'/>
                                                                        <div class="row">
                                                                            <p>Are you sure you want to deny this responsibility to the teacher??</p>                                     
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-success" data-dismiss="modal">NO, Cancel</button>
                                                                                    <input type="submit" class="btn btn-danger" value="Yes, Remove"></input>
                                                                        </div>
                                                                        </form>	
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="container">
                                                        <div class="row">
                                                            <div class="col-xs-12 col-lg-12 col-xl-12">
                                                                <div class="modal" id="add_responsibility_modal{{$teacher->id}}" tabindex="-1">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h4 class="modal-title pull-left">Assign Responsibility</h4>
                                                                                <button class="close" data-dismiss="modal">&times;</button>
                                                                            </div>
                                                                            <div class="modal-body">

                                                                                        <?php

                                                                                                $class_1E = null;
                                                                                                $class_1W = null;

                                                                                                $class_2E = null;
                                                                                                $class_2W = null;

                                                                                                $class_3E = null;
                                                                                                $class_3W = null;

                                                                                                $class_4E = null;
                                                                                                $class_4W = null;

                                                                                                foreach($set_roles_and_responsiblities as $already_set_roles){
                                                                               
                                                                                                if($already_set_roles->class_teacher == '1E'){
                                                                                                        $class_1E = "1E";
                                                                                                }
                                                                                                if($already_set_roles->class_teacher == '1W'){
                                                                                                        $class_1W = '1W';
                                                                                                }

                                                                                                if($already_set_roles->class_teacher == '2E'){
                                                                                                        $class_2E = "2E";
                                                                                                }
                                                                                                if($already_set_roles->class_teacher == '2W'){
                                                                                                        $class_2W = '2W';
                                                                                                }

                                                                                                if($already_set_roles->class_teacher == '3E'){
                                                                                                        $class_3E = "3E";
                                                                                                }
                                                                                                if($already_set_roles->class_teacher == '3W'){
                                                                                                        $class_3W = '3W';
                                                                                                }

                                                                                                if($already_set_roles->class_teacher == '4E'){
                                                                                                        $class_4E = "4E";
                                                                                                }
                                                                                                if($already_set_roles->class_teacher == '4W'){
                                                                                                        $class_4W = '4W';
                                                                                                }
                                                                                                }

                                                                                                echo 'the value is:'.$class_3E;

                                                                                                //if all classes have been assigned a class teacher, then echo a message to notify the user
                                                                                                if($class_1E != null && $class_1W != null && $class_2E != null && $class_2W != null && $class_3E != null && $class_3W != null && $class_4E != null && $class_4W != null){
                                                                                                        echo '<p style="color: red;">All the classes have their respective class teachers. Therefore, no more responsibilities can be assigned to the teacher.</p>';
                                                                                                }
                                                                                                
                                                                                        ?>
                                                                                <form action="/add_responsibility" method = "POST" name="responsibility_form">
                                                                                @csrf
                                                                                <input type="hidden" name="id" value='{{$teacher->id}}'/>
                                                                                <div class="row">
                        
                                                                                         <div style="margin-left: 20px;" class="form-group" id="responsibility_div">
                                                                                                 <label for="responsibility">Select Responsibility</label>
                                                                                                 <select id="responsibility" name="responsibility" class="form-control">
                                                                                                         <option value=""></option>
                                                                                                        <option value="Class teacher">Class teacher</option>
                                                                                                 </select>
                                                                                            <div id="responsibility_error"></div>
                                                                                        </div>

                                                                                        <div style="margin-left: 20px;" class="form-group" id="class_incharge_div">
                                                                                                        <label for="class_incharge">Select class incharge</label>
                                                                                                        <select id="class_incharge" name="class_incharge" class="form-control">
                                                                                                                <option value=""></option>
                                                                                                                @if ($class_1E == null)
                                                                                                                         <option value="1E">1 East</option>
                                                                                                                @endif

                                                                                                                @if ($class_1W == null)
                                                                                                                <option value="1W">1 west</option>
                                                                                                                @endif
                                                                                                                
                                                                                                                @if ($class_2E == null)
                                                                                                                <option value="2E">2 East</option>
                                                                                                                @endif

                                                                                                                @if ($class_2W == null)
                                                                                                                <option value="2W">2 West</option>
                                                                                                                @endif

                                                                                                                @if ($class_3E == null)
                                                                                                                <option value="3E">3 East</option>
                                                                                                                @endif

                                                                                                                @if ($class_3W == null)
                                                                                                                <option value="3W">3 west</option>
                                                                                                                @endif

                                                                                                                @if ($class_4E == null)
                                                                                                                <option value="4E">4 East</option>
                                                                                                                @endif

                                                                                                                @if ($class_4W == null)
                                                                                                                <option value="4W">4 West</option>
                                                                                                                @endif      
                                                                                                                
                                                                                                        </select>
                                                                                                   <div id="class_incharge_error"></div>
                                                                                        </div>
                                                                                                                       
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                            <button type="button" class="btn btn-danger" data-dismiss="modal">NO, Cancel</button>
                                                                                            <input type="submit" class="btn btn-success" onclick="return validateResponsibility()" value="Add"></input>
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

        <div id="teaching_classes" class="tab-pane fade">
                <table class="table table-bordered  table-condensed" style="margin-top: 30px;">
                        <thead>
                                <th>S/NO</th>
                                <th>Class</th>
                                <th>Subject</th>
                                <th>Action</th>
                        </thead>
                        <tbody>
                            <?php
                                 $j = 1;
                            ?>
                                @if (!$teacher_classes->isEmpty())

                                @foreach ($teacher_classes as $teaching_class)
                               
                                    @if ($teaching_class->subject1 != null)
                                    <tr>
                                        <td><?php  echo $j++ ?></td>
                                        <td>{{ $teaching_class->class_name}}</td>
                                        <td>{{ $teaching_class->subject1}}</td>
                                        <td><button id="{{$teaching_class->id}}_subject1" name="remove_button" data-toggle="modal" data-target="#remove_teaching_class_modal_subject1{{$teaching_class->id}}" class="btn btn-danger">Remove</button></td>
                                    </tr>
                                    @endif

                                    @if ($teaching_class->subject2 != null)
                                    <tr>
                                        <td><?php  echo $j++ ?></td>
                                        <td>{{ $teaching_class->class_name}}</td>
                                        <td>{{ $teaching_class->subject2}}</td>
                                        <td><button id="{{$teaching_class->id}}_subject2" name="remove_button" data-toggle="modal" data-target="#remove_teaching_class_modal_subject2{{$teaching_class->id}}" class="btn btn-danger">Remove</button></td>
                                    </tr>
                                    @endif

                                    <div class="container">
                                        <div class="row">
                                            <div class="col-xs-12 col-lg-12 col-xl-12">
                                                <div class="modal" id="remove_teaching_class_modal_subject1{{$teaching_class->id}}" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title pull-left" style="color: red;">Withdraw teaching class</h4>
                                                                <button class="close" data-dismiss="modal">&times;</button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="/removeTeachingClassSubject1" method = "POST">
                                                                @csrf
                                                                <input type="hidden" name="id" value='{{$teaching_class->id}}'/>
                                                                <input type="hidden" name="teacher_id" value="{{$teacher->id}}"/>
                                                                <div class="row">
                                                                    <p>Are you sure you want to withdraw this teacher from teaching this subject??</p>                                     
                                                                </div>
                                                                <div class="modal-footer">
                                                                            <button type="button" class="btn btn-success" data-dismiss="modal">NO, Cancel</button>
                                                                            <input type="submit" class="btn btn-danger" value="Yes, Remove"></input>
                                                                </div>
                                                                </form>	
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="container">
                                        <div class="row">
                                            <div class="col-xs-12 col-lg-12 col-xl-12">
                                                <div class="modal" id="remove_teaching_class_modal_subject2{{$teaching_class->id}}" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title pull-left" style="color: red;">Withdraw teaching class</h4>
                                                                <button class="close" data-dismiss="modal">&times;</button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="/removeTeachingClassSubject2" method = "POST">
                                                                @csrf
                                                                <input type="hidden" name="id" value='{{$teaching_class->id}}'/>
                                                                <input type="hidden" name="teacher_id" value="{{$teacher->id}}"/>
                                                                <div class="row">
                                                                    <p>Are you sure you want to withdraw this teacher from teaching this subject??</p>                                     
                                                                </div>
                                                                <div class="modal-footer">
                                                                            <button type="button" class="btn btn-success" data-dismiss="modal">NO, Cancel</button>
                                                                            <input type="submit" class="btn btn-danger" value="Yes, Remove"></input>
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
                                
      
                                
                                
                        </tbody>
                </table>

                @if ($teacher_classes->isEmpty())
                <p>The teacher has not been assigned any class to teach. Click <a id="{{$teacher->id}}" href="#" data-toggle="modal" data-target="#add_teachingClass_modal{{$teacher->id}}">here</a> to add a special role.</p>
                    
                @endif

                @if (!$teacher_classes->isEmpty())

                <button style="float:right;" type="button" id="{{$teacher->id}}" name="addButton" data-toggle="modal" data-target="#add_teachingClass_modal{{$teacher->id}}" class="btn btn-success">Add</button>
                    
                @endif
      
                 
      
      
                          <div class="container">
                                      <div class="row">
                                          <div class="col-xs-12 col-lg-12 col-xl-12">
                                              <div class="modal" id="add_teachingClass_modal{{$teacher->id}}" tabindex="-1">
                                                  <div class="modal-dialog">
                                                      <div class="modal-content">
                                                          <div class="modal-header">
                                                              <h4 class="modal-title pull-left">Assign teaching classes</h4>
                                                              <button class="close" data-dismiss="modal">&times;</button>
                                                          </div>
                                                          <div class="modal-body">
                                                              <form action="/addTeachingClass" method = "POST" name="teachingClasses_form">
                                                              @csrf
                                                              <input type="hidden" name="id" value='{{$teacher->id}}'/>
                                                              <div class="row">
                                                                     
      
                                                                       <div style="margin-left: 20px;" class="form-group" id="class_name_div">
                                                                               <label for="class_name">Select Class to teach</label>
                                                                               <select id="class_name" name="class_name" class="form-control">
                                                                                       <option value=""></option>
                                                                                       <option value="1E">1 East</option>
                                                                                       <option value="1W">1 west</option>
                                                                                       <option value="2E">2 East</option>
                                                                                       <option value="2W">2 West</option>
                                                                                       <option value="3E">3 East</option>
                                                                                       <option value="3W">3 west</option>
                                                                                       <option value="4E">4 East</option>
                                                                                       <option value="4W">4 West</option>
      
                                                                               </select>
                                                                          <div id="class_name_error"></div>
                                                                      </div>

                                                                      <div style="margin-left: 20px;" class="form-group" id="subject_div">
                                                                        <label for="subject">Select teaching subject</label>
                                                                        <select id="subject" name="subject" class="form-control">
                                                                                <option value=""></option>
                                                                                <option value="{{$teacher->subject_1}}">{{$teacher->subject_1}}</option>
                                                                                <option value="{{$teacher->subject_2}}">{{$teacher->subject_2}}</option>
                                                                        </select>
                                                                   <div id="subject_error"></div>

                                                               </div>
                                                               <span id="availability"><span>
                                                                                                     
                                                              </div>
                                                              <div class="modal-footer">
                                                                          <button type="button" class="btn btn-danger" data-dismiss="modal">NO, Cancel</button>
                                                                          <input type="submit" class="btn btn-success" onclick="return validateTeacherClasses()" value="Add"></input>
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
</div>

</div>
@endforeach

</div>

	
@endsection