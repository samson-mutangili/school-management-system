@extends('layouts.dashboard')

@section('content')

<div style="margin-left: 10px; margin-top: 10px;">

<h3 style="color: green; text-decoration: underline;">Teacher details</h3>

@if ( Session::get('updated_successfully') != null)

    <div class="alert alert-success">
            <strong>Success</strong> : {{ Session::get('updated_successfully')}}
    </div>

@endif

@foreach ($specific_teacher as $teacher )


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

<button name="edit" id="{{$teacher->id}}" data-toggle="modal" data-target="#archive_modal{{$teacher->id}}" style="margin-top: 20px; width: 7em; margin-left: 30px;"  class="btn btn-danger">Archive</button>


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

@endforeach

</div>

	
@endsection