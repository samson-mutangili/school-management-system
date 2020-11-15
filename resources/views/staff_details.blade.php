@extends('layouts.dashboard')

@section('content')

<div class="row">
        <div class="col-md-12">
            <h4 class="page-head-line">Non teaching staff details</h4>
                <a href="/nonTeachingStaffDetails"><i class="fa fa-arrow-left"></i>Back</a>
        </div>
    </div>
    
    
    <div class="panel panel-default w-auto">
        <div class="panel-heading">
         Personal details
        </div>
          @csrf
           <div class="panel-body">
            
  

<div style="margin-left: 10px; margin-top: 10px;">


@if ( Session::get('update_successfully') != null)

        <div class="alert alert-success alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Success</strong> : {{ Session::get('update_successfully')}}
    </div>

@endif

<div>
        @if ( Session::get('update_failed') != null)
    
        <div class="alert alert-danger alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Failed</strong> : {{ Session::get('update_failed')}}
        </div>
    
        @endif
</div>  

<div>
        @if ( Session::get('email_conflict') != null)
    
        <div class="alert alert-danger alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Failed</strong> : {{ Session::get('email_conflict')}}
        </div>
    
        @endif
</div>  

<div>
        @if ( Session::get('id_no_conflict') != null)
    
        <div class="alert alert-danger alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Failed</strong> : {{ Session::get('id_no_conflict')}}
        </div>
    
        @endif
</div>  

<div>
        @if ( Session::get('emp_no_conflict') != null)
    
        <div class="alert alert-danger alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Failed</strong> : {{ Session::get('emp_no_conflict')}}
        </div>
    
        @endif
</div>  


@foreach ($staff_details as $staff )


    <table cellspacing="7" cellpadding="7">
       
        <tbody>
            <tr>
                <td align="left">Name</td>
                <td>: {{ $staff->first_name}} {{$staff->middle_name}} {{$staff->last_name}}</td>
            </tr>

            <tr>
                <td align="left"> Phone number</td>
                <td>: {{$staff->phone_no}}</td>
            </tr>

            <tr>
                    <td align="left"> Email address</td>
                    <td>: {{$staff->email}}</td>
            </tr>
            
            <tr>
                    <td align="left"> ID Number</td>
                    <td>: {{$staff->id_no}}</td>
            </tr>


            <tr>
                    <td align="left"> Employee number</td>
                    <td>: {{$staff->emp_no}}</td>
            </tr>  
            
            
            <tr>
                    <td align="left"> Job category</td>
                    <td>: {{$staff->category}}</td>
            </tr>

            <tr>
                    <td align="left"> Gender</td>
                    <td>: {{$staff->gender}}</td>
            </tr>

            <tr>
                    <td align="left"> Religion</td>
                    <td>: {{$staff->religion}}</td>
            </tr>


            <tr>
                    <td align="left"> Nationality</td>
                    <td>: {{$staff->nationality}}</td>
            </tr>  
            
            
            <tr>
                    <td align="left"> Salary</td>
                    <td>: {{$staff->salary}}</td>
            </tr>

            <tr>
                    <td align="left"> Date of hire</td>
                    <td>: {{$staff->hired_date}}</td>
            </tr>

        </tbody>
    </table>
 
<button name="edit" id="{{$staff->id}}" data-toggle="modal" data-target="#edit_modal{{$staff->id}}" style="margin-top: 20px; width: 7em;" class="btn btn-success">Edit</button>

<button name="edit" id="{{$staff->id}}" data-toggle="modal" data-target="#archive_modal{{$staff->id}}" style="margin-top: 20px; width: 7em; margin-left: 30px;"  class="btn btn-danger">Archive</button>


<div class="container">
		<div class="row">
			<div class="col-xs-12 col-lg-12 col-xl-12">
				<div class="modal" id="edit_modal{{$staff->id}}" tabindex="-1">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title pull-left">Edit staff details</h4>
								<button class="close" data-dismiss="modal">&times;</button>
							</div>
							<div class="modal-body">
								<form action="/edit_staff" method = "POST" name="not_teaching_staff_form">
                                @csrf
                                <input type="hidden" name="id" value='{{$staff->id}}'/>
								<div class="row">
                                        <div class="col-xm-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                              <div class="form-group" id="first_name_div">
                                                      <label class="control-table" for="first_name">First name</label>
                                                      <input type="text" name="first_name" id="first_name" class="form-control" placeholder="Enter first name" value="{{$staff->first_name }}">
                                                      <div id="first_name_error"></div>
                                              </div>	
                                        </div>
                  
                                        <div class="col-xm-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                              <div class="form-group" id="middle_name_div">
                                                      <label class="control-table" for="middle_name">Middle name</label>
                                                      <input type="text" name="middle_name" id="middle_name" class="form-control" placeholder="Enter middle name" value="{{$staff->middle_name }}">
                                                      <div id="middle_name_error"></div>
                                              </div>	
                                        </div>
                  
                                        <div class="col-xm-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                              <div class="form-group" id="last_name_div">
                                                      <label class="control-table" for="last_name">Last name</label>
                                                      <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Enter last name" value="{{$staff->last_name }}">
                                                      <div id="last_name_error"></div>
                                              </div>	
                                        </div>
                
                                        <div class="col-xm-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                                <div class="form-group" id="phone_no_div">
                                                        <label class="control-table" for="phone_no">Phone number</label>
                                                        <input type="number" name="phone_no" id="phone_no" class="form-control" placeholder="Enter phone number" value="{{$staff->phone_no }}">
                                                        <div id="phone_no_error"></div>
                                                </div>
                                            
                                        </div>
        
                                        <div class="col-xm-12 col-sm-12 col-md-6 col-lg-8 col-xl-8">
                                                <div class="form-group" id="email_div">
                                                        <label class="control-table" for="email">Email address</label>
                                                        <input type="email" name="email" id="email" class="form-control" placeholder="Enter email address" value="{{$staff->email }}">
                                                        <div id="email_error"></div>
                                                </div>
                                            
                                        </div>
        
                                        <div class="col-xm-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                                <div class="form-group" id="id_no_div">
                                                        <label for="id_no">ID number</label>
                                                        <input type="number" id="id_no" class="form-control" name="id_no" value="{{$staff->id_no }}">
                                                        <div id="id_no_error"></div>
                                                </div>
                                    
                                        </div>
        
                                        <div class="col-xm-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                                <div class="form-group" id="emp_no_div">
                                                        <label for="emp_no">Employee number</label>
                                                        <input type="text" id="emp_no" class="form-control" name="emp_no" value="{{$staff->emp_no }}" >
                                                        <div id="emp_no_error"></div>
                                                </div>
                                    
                                        </div>
        
                                        <div class="col-xm-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                                <div class="form-group" id="category_div">
                                                        <label for="category">Category</label>
                                                        <select id="category" name="category" class="form-control" onchange="populate(this.id,'subject_2')">
                                                            <option selected value="{{$staff->category}}">{{$staff->category}}</option>
                                                            <option value="bursar">Bursar</option>
                                                             <option value="secretary">Secretary</option>
                                                             <option value="cook">Cook</option>
                                                             <option value="Cleaning">Cleaning</option>
                                                             <option value="security">Security</option>
                                                        </select>
                                                        <div id="category_error"></div>
                                                    </div>
                                            
                                        </div>  
                
                                        <div class="col-xm-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                                <div class="form-group" id="gender_div">
                                                        <label for="gender">Gender</label>
                                                        <select id="gender" name="gender" class="form-control">
                                                            <option  selected value="{{$staff->gender}}">{{$staff->gender}}</option>
                                                            <option value="male">Male</option>
                                                             <option value="female">Female</option>
                                                        </select>
                                                        <div id="gender_error"></div>
                                                    </div>
                                            
                                        </div>                                
                
                                        <div class="col-xm-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                                <div class="form-group" id="religion_div">
                                                        <label for="religion">Religion</label>
                                                        <select id="religion" name="religion" class="form-control">
                                                            <option selected value="{{$staff->religion}}">{{$staff->religion}}<option>
                                                            <option>Christian</option>
                                                             <option>Islam</option>
                                                             <option>Other</option>
                                                        </select>
                                                        <div id="religion_error"></div>
                                                    </div>
                                        </div>
                
                                        <div class="col-xm-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                                <div class="form-group" id="nationality_div">
                                                        <label for="nationality">Nationality</label>
                                                        <select id="nationality" name="nationality" class="form-control">
                                                            <option selected value="{{$staff->nationality}}">{{$staff->nationality}}</option>
                                                            <option>Kenyan</option>
                                                             <option>Ugandan</option>
                                                             <option>Tanzania</option>
                                                             <option>Somalian</option>
                                                        </select>
                                                        <div id="nationality_error"></div>
                                                    </div>
                                
                                        </div>
        
                                        <div class="col-xm-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                                <div class="form-group" id="salary_div">
                                                        <label for="salary">Salary</label>
                                                        <input type="number" id="salary" class="form-control" name="salary" value="{{$staff->salary}}" >
                                                        <div id="salary_error"></div>
                                                </div>
                                    
                                        </div>
                  
                                    </div>
                            
							
								<div class="modal-footer">
											<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
											<input type="submit" class="btn btn-success" onclick="return validateNonTeachingStaff()" value="Update"></input>
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
				<div class="modal" id="archive_modal{{$staff->id}}" tabindex="-1">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title pull-left" style="color: red;">Archive non teaching staff</h4>
								<button class="close" data-dismiss="modal">&times;</button>
							</div>
							<div class="modal-body">
								<form action="/archive_staff" method = "POST">
                                @csrf
                                <input type="hidden" name="id" value='{{$staff->id}}'/>
								<div class="row">
                                    <p>Are you sure the staff has left the job inorder to archive the staff details??</p>                                     
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
           </div>

    </div>
	
@endsection