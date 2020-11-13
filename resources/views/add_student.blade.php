<style>
input[type="radio"]{
  margin: 0 10px 0 10px;
}

    </style>

@extends('layouts.dashboard')

@section('content')


<div class="row">
        <div class="col-md-12">
            <h4 class="page-head-line">Student registration</h4>
    
        </div>
    </div>
    
    <div class="panel panel-default w-auto">
        <div class="panel-heading">
         Student personal details
        </div>
          @csrf
           <div class="panel-body">
            

<div style="margin-top: 15px;">
        @if ( Session::get('no_student') != null)
    
        <div class="alert alert-danger alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Failed</strong> : {{ Session::get('no_student')}}
        </div>
    
        @endif
    </div>  

    <div style="margin-top: 15px;">
        @if ( Session::get('adm_conflict') != null)
    
        <div class="alert alert-danger alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Failed</strong> : {{ Session::get('adm_conflict')}}
        </div>
    
        @endif
    </div>  

    <div style="margin-top: 15px;">
        @if ( Session::get('birth_cert_no_conflict') != null)
    
        <div class="alert alert-danger alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Failed</strong> : {{ Session::get('birth_cert_no_conflict')}}
        </div>
    
        @endif
    </div>  

    <div style="margin-top: 15px;">
        @if ( Session::get('kcpe_index_no_conflict') != null)
    
        <div class="alert alert-danger alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Failed</strong> : {{ Session::get('kcpe_index_no_conflict')}}
        </div>
    
        @endif
    </div> 
    @if (count($errors) > 0)
              <div class="alert alert-danger">
                    <ul>
                         @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                         @endforeach
                    </ul>
             </div>
        @endif
 
	<div class="row">
        <form action="/add_new_student" method = "POST" name="student_form" enctype="multipart/form-data">
                @csrf
<div >
	<div >
		
			<div class="col-lg-2 col-md-2 col-sm-2 col-xs-1"></div>
			
			<div class=" col-xl-10 col-lg-10 col-md-12 col-sm-12 col-xs-12">
			<div style=" margin-left: 10px;">
                  	
                     
                <div ><h2  style="text-decoration: underline; color:green; margin-top: 0;">Student personal details</h2>
                  <div  class="row">
                          <input type="hidden" name="current_date" value="{{date('Y-m-d') }}">
                        <div class="col-xm-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                              <div class="form-group" id="first_name_div">
                                      <label class="control-table" for="first_name">First name</label>
                              <input type="text" name="first_name" id="first_name" class="form-control" placeholder="Enter first name" value="{{$first_name ?? ''}}">
                                      <div id="first_name_error"></div>
                              </div>	
                        </div>
  
                        <div class="col-xm-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                              <div class="form-group" id="middle_name_div">
                                      <label class="control-table" for="middle_name">Enter middle name</label>
                                      <input type="text" name="middle_name" id="middle_name" class="form-control" placeholder="Enter middle name" value="{{$middle_name ?? ''}}">
                                      <div id="middle_name_error"></div>
                              </div>	
                        </div>
  
                        <div class="col-xm-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                              <div class="form-group" id="last_name_div">
                                      <label class="control-table" for="last_name">Last name</label>
                                      <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Enter last name" value="{{$last_name ?? ''}}">
                                      <div id="last_name_error"></div>
                              </div>	
                        </div>

                        <div class="col-xm-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                <div class="form-group" id="admission_number_div">
                                        <label class="control-table" for="admission_number">Admission number</label>
                                        <input type="number" name="admission_number" id="admission_number" class="form-control" placeholder="Admission number" value="{{$admission_number ?? ''}}" @if($admission_number != "") readonly @endif>
                                        <div id="admission_number_error"></div>
                                </div>
                            
                        </div>

                        <div class="col-xm-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                <div class="form-group" id="gender_div">
                                        <label for="gender">Gender</label>
                                        <select id="gender" name="gender" class="form-control" required>
                                                <option value="">Select gender</option>
                                            <option @if($gender ?? '' == 'Male') selected @endif>Male</option>
                                             <option @if($gender ?? '' == 'female') selected @endif>female</option>
                                        </select>
                                        <div id="gender_error"></div>
                                    </div>
                            
                        </div>

                        <div class="col-xm-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                <div class="form-group" id="date_of_birth_div">
                                        <label for="date_of_birth">Date of birth</label>
                                        <input type="date" id="date_of_birth" class="form-control" name="date_of_birth" value="{{$date_of_birth ?? ''}}">
                                        <div id="date_of_birth_error"></div>
                                    </div>
                            
                        </div>

                        <div class="col-xm-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                <div class="form-group" id="birth_cert_no_div">
                                        <label for="birth_cert_no">Birth certificate number</label>
                                        <input type="number" id="birth_cert_no" class="form-control" name="birth_cert_no" value="{{$birth_cert_no ?? ''}}">
                                        <div id="birth_cert_no_error"></div>
                                </div>
                            
                        </div>

                        <div class="col-xm-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                <div class="form-group" id="kcpe_index_number_div">
                                        <label for="kcpe_index_number">KCPE index number</label>
                                        <input type="number" id="kcpe_index_number" class="form-control" name="kcpe_index_number" value="{{$kcpe_index_number ?? ''}}" >
                                        <div id="kcpe_index_number_error"></div>
                                </div>
                    
                        </div>

                        <div class="col-xm-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                <div class="form-group" id="residence_div">
                                        <label for="residence">Place of residence</label>
                                        <input type="text" id="residence" class="form-control" name="residence" value="{{$residence ?? ''}}">
                                        <div id="residence_error"></div>
                                </div>
                    
                        </div>

                        <div class="col-xm-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                <div class="form-group" id="religion_div">
                                        <label for="religion">Religion</label>
                                        <select id="religion" name="religion" class="form-control" required>
                                                <option value="">Select religion</option>
                                            <option @if($religion ?? '' == 'Christian') selected @endif>Christian</option>
                                             <option @if($religion ?? '' == 'Islam') selected @endif>Islam</option>
                                             <option @if($religion ?? '' == 'Other') selected @endif>Other</option>
                                        </select>
                                        <div id="religion_error"></div>
                                    </div>
                        </div>

                        <div class="col-xm-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                <div class="form-group" id="nationality_div">
                                        <label for="nationality">Nationality</label>
                                        <select id="nationality" name="nationality" class="form-control">
                                                <option value="">Select nationality</option>
                                            <option @if($nationality ?? '' == 'Kenyan') selected @endif >Kenyan</option>
                                             <option @if($nationality ?? '' == 'Ugandan') selected @endif>Ugandan</option>
                                             <option @if($nationality ?? '' == 'Tanzania') selected @endif>Tanzania</option>
                                             <option @if($nationality ?? '' == 'Somalian') selected @endif>Somalian</option>
                                        </select>
                                        <div id="nationality_error"></div>
                                    </div>
                
                        </div>

                        <div class="col-xm-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                <div class="form-group" id="student_class_div">
                                        <label for="student_class">Class</label>
                                        <select id="student_class" name="student_class" class="form-control" required>
                                             <option value="" >Select class</option>
                                             <option @if($student_class ?? '' == '1E') selected @endif value="1E">1 East</option>
                                             <option @if($student_class ?? '' == '1W') selected @endif value="1W">1 west</option>
                                             <option @if($student_class ?? '' == '2E') selected @endif value="2E">2 East</option>
                                             <option @if($student_class ?? '' == '2W') selected @endif value="2W">2 West</option>
                                             <option @if($student_class ?? '' == '3E') selected @endif value="3E">3 East</option>
                                             <option @if($student_class ?? '' == '3W') selected @endif value="3W">3 west</option>
                                             <option @if($student_class ?? '' == '4E') selected @endif value="4E">4 East</option>
                                             <option @if($student_class ?? '' == '4W') selected @endif value="4W">4 West</option>
                                        </select>
                                        <div id="student_class_error"></div>
                                    </div>
                
                        </div>

                        
                        <div class="col-xm-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 ">
                                        <div class="input-group form-group">
                                                <label for="image">Upload picture</label>
                                                <div class="form-control-file">
                                                <div class="custom-file">
                                                        <input type="file" name="image" class="custom-file-input" required >
                                                        
                                                        <label class="custom-file-label">Choose  picture</label>
                                                        
                                                </div>
                                                </div>
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

           </div>
    </div>
@endsection