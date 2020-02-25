<style>
input[type="radio"]{
  margin: 0 10px 0 10px;
}

    </style>

@extends('layouts.dashboard')

@section('content')


	<div>
        <form action="/add_new_student" method = "POST" name="student_form">
                @csrf
<div class="container">
	<div class="row">
		
			<div class="col-lg-2 col-md-2 col-sm-2 col-xs-1"></div>
			
			<div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
			<div class="jumbotron-fluid">
                  <h1 class="text-center">Register new student</h1>	
                     
                <div class="tab"><h2 class="text-center" style="text-decoration: underline;">Student personal details:</h2>
                  <div class="row">
                        <div class="col-xm-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                              <div class="form-group" id="first_name_div">
                                      <label class="control-table" for="first_name">First name</label>
                                      <input type="text" name="first_name" id="first_name" class="form-control" placeholder="Enter first name">
                                      <div id="first_name_error"></div>
                              </div>	
                        </div>
  
                        <div class="col-xm-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                              <div class="form-group" id="middle_name_div">
                                      <label class="control-table" for="middle_name">Enter middle name</label>
                                      <input type="text" name="middle_name" id="middle_name" class="form-control" placeholder="Enter middle name">
                                      <div id="middle_name_error"></div>
                              </div>	
                        </div>
  
                        <div class="col-xm-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                              <div class="form-group" id="last_name_div">
                                      <label class="control-table" for="last_name">Last name</label>
                                      <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Enter last name">
                                      <div id="last_name_error"></div>
                              </div>	
                        </div>

                        <div class="col-xm-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                <div class="form-group" id="admission_number_div">
                                        <label class="control-table" for="admission_number">Admission number</label>
                                        <input type="number" name="admission_number" id="admission_number" class="form-control" placeholder="Admission number">
                                        <div id="admission_number_error"></div>
                                </div>
                            
                        </div>

                        <div class="col-xm-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                <div class="form-group" id="gender_div">
                                        <label for="gender">Gender</label>
                                        <select id="gender" name="gender" class="form-control">
                                            <option>Male</option>
                                             <option>female</option>
                                        </select>
                                        <div id="gender_error"></div>
                                    </div>
                            
                        </div>

                        <div class="col-xm-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                <div class="form-group" id="date_of_birth_div">
                                        <label for="date_of_birth">Date of birth</label>
                                        <input type="date" id="date_of_birth" class="form-control" name="date_of_birth" >
                                        <div id="date_of_birth_error"></div>
                                    </div>
                            
                        </div>

                        <div class="col-xm-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                <div class="form-group" id="birth_cert_no_div">
                                        <label for="birth_cert_no">Birth certificate number</label>
                                        <input type="number" id="birth_cert_no" class="form-control" name="birth_cert_no" >
                                        <div id="birth_cert_no_error"></div>
                                </div>
                            
                        </div>

                        <div class="col-xm-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                <div class="form-group" id="kcpe_index_number_div">
                                        <label for="kcpe_index_number">KCPE index number</label>
                                        <input type="number" id="kcpe_index_number" class="form-control" name="kcpe_index_number" >
                                        <div id="kcpe_index_number_error"></div>
                                </div>
                    
                        </div>

                        <div class="col-xm-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                <div class="form-group" id="residence_div">
                                        <label for="residence">Place of residence</label>
                                        <input type="text" id="residence" class="form-control" name="residence" >
                                        <div id="residence_error"></div>
                                </div>
                    
                        </div>

                        <div class="col-xm-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                <div class="form-group" id="religion_div">
                                        <label for="religion">Religion</label>
                                        <select id="religion" name="religion" class="form-control">
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
                                            <option>Kenyan</option>
                                             <option>Ugandan</option>
                                             <option>Tanzania</option>
                                             <option>Somalian</option>
                                        </select>
                                        <div id="nationality_error"></div>
                                    </div>
                
                        </div>

                        <div class="col-xm-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                <div class="form-group" id="student_class_div">
                                        <label for="student_class">Class</label>
                                        <select id="student_class" name="student_class" class="form-control">
                                             <option value="" ></option>
                                             <option value="1E">1 East</option>
                                             <option value="1W">1 west</option>
                                             <option value="2E">2 East</option>
                                             <option value="2W">2 West</option>
                                             <option value="3E">3 East</option>
                                             <option value="3W">3 west</option>
                                             <option value="4E">4 East</option>
                                             <option value="4W">4 West</option>
                                        </select>
                                        <div id="student_class_error"></div>
                                    </div>
                
                        </div>
  
                    </div>
                  </div>
            
			<div style="align: center;" class="pull-right">
			<input type="submit" class="btn btn-success" value="Submit" onclick="return validateStudent()"></input>
			
			</div>
			</div>
			<div class="col-md-3"></div>
		</div>
	</div>
</form>
	</div>

    
@endsection