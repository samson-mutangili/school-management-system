@extends('layouts.dashboard')

@section('content')

<?php 

$i = 1;

?>

            <div class="row">
                <div class="col-md-12">
                    <h1 class="page-head-line">Student details</h1>

                </div>
            </div>

            

             <div class="panel panel-default w-auto">
                             <div class="panel-heading">
                               Edit student details
                             </div>
                               
                                <div class="panel-body">
                                        <div>
                                                @if ( Session::get('adm_no_conflict') != null)
                                            
                                                <div class="alert alert-danger alert-dismissible">
                                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                        <strong>Failed</strong> : {{ Session::get('adm_no_conflict')}}
                                                </div>
                                            
                                                @endif
                                            </div>

                                            <div >
                                                    @if ( Session::get('birth_cert_no_conflict') != null)
                                                
                                                    <div class="alert alert-danger alert-dismissible">
                                                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                            <strong>Failed</strong> : {{ Session::get('birth_cert_no_conflict')}}
                                                    </div>
                                                
                                                    @endif
                                                </div>

                                            <div >
                                                    @if ( Session::get('kcpe_index_no_conflict') != null)
                                                
                                                    <div class="alert alert-danger alert-dismissible">
                                                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                            <strong>Failed</strong> : {{ Session::get('kcpe_index_no_conflict')}}
                                                    </div>
                                                
                                                    @endif
                                                </div>
                             
                                                <div >
                                                    @if ( Session::get('DOB_error') != null)
                                                
                                                    <div class="alert alert-danger alert-dismissible">
                                                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                            <strong>Failed</strong> : {{ Session::get('DOB_error')}}
                                                    </div>
                                                
                                                    @endif
                                                </div>

                                                <div >
                                                    @if ( Session::get('student_too_young') != null)
                                                
                                                    <div class="alert alert-danger alert-dismissible">
                                                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                            <strong>Failed</strong> : {{ Session::get('student_too_young')}}
                                                    </div>
                                                
                                                    @endif
                                                </div>

                                      @if (!$student_details->isEmpty())
                                          @foreach($student_details as $student)

                                       
                                                <form action="/students/edit_student" method = "POST" name="student_edit_form">
                                                    @csrf
                                        <div class="row" style=" margin:10px 0 10px 0; ">
                                            
                                                <input type="hidden" name="stream" value="{{$student->stream}}" />
                                                <input type="hidden" name="student_id" value="{{$student->id}}" />
                                                <div class="col-lg-10 col-offset-lg-1 col-md-12 col-sm-12 col-xs-12">
                                                
                                                    <div >
                                                      <div class="row">
                                                            <div class="col-xm-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                                                  <div class="form-group" id="first_name_div">
                                                                          <label class="control-table" for="first_name">First name</label>
                                                                          <input type="text" name="first_name" id="first_name" class="form-control" placeholder="Enter first name" value="{{$student->first_name}}" required>
                                                                          <div id="first_name_error"></div>
                                                                  </div>	
                                                            </div>
                                      
                                                            <div class="col-xm-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                                                  <div class="form-group" id="middle_name_div">
                                                                          <label class="control-table" for="middle_name">Enter middle name</label>
                                                                          <input type="text" name="middle_name" id="middle_name" class="form-control" placeholder="Enter middle name" value="{{$student->middle_name}}" required>
                                                                          <div id="middle_name_error"></div>
                                                                  </div>	
                                                            </div>
                                      
                                                            <div class="col-xm-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                                                  <div class="form-group" id="last_name_div">
                                                                          <label class="control-table" for="last_name">Last name</label>
                                                                          <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Enter last name" value="{{$student->last_name}}" required>
                                                                          <div id="last_name_error"></div>
                                                                  </div>	
                                                            </div>
                                    
                                                            <div class="col-xm-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                                                    <div class="form-group" id="admission_number_div">
                                                                            <label class="control-table" for="admission_number">Admission number</label>
                                                                            <input type="number" name="admission_number" id="admission_number" class="form-control" placeholder="Admission number" value="{{$student->admission_number}}" required>
                                                                            <div id="admission_number_error"></div>
                                                                    </div>
                                                                
                                                            </div>
                                    
                                                            <div class="col-xm-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                                                    <div class="form-group" id="gender_div">
                                                                            <label for="gender">Gender</label>
                                                                            <select id="gender" name="gender" class="form-control" required>
                                                                                <option value="">Select gender</option>
                                                                                <option @if($student->gender == 'Male') selected @endif>Male</option>
                                                                                 <option @if($student->gender == 'female') selected @endif>female</option>
                                                                            </select>
                                                                            <div id="gender_error"></div>
                                                                        </div>
                                                                
                                                            </div>
                                    
                                                            <div class="col-xm-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                                                    <div class="form-group" id="date_of_birth_div">
                                                                            <label for="date_of_birth">Date of birth</label>
                                                                            <input type="date" id="date_of_birth" class="form-control" name="date_of_birth" value="{{$student->DOB}}" required >
                                                                            <div id="date_of_birth_error"></div>
                                                                        </div>
                                                                
                                                            </div>
                                    
                                                            <div class="col-xm-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                                                    <div class="form-group" id="birth_cert_no_div">
                                                                            <label for="birth_cert_no">Birth certificate number</label>
                                                                            <input type="number" id="birth_cert_no" class="form-control" name="birth_cert_no" value="{{$student->birth_cert_no}}" required>
                                                                            <div id="birth_cert_no_error"></div>
                                                                    </div>
                                                                
                                                            </div>
                                    
                                                            <div class="col-xm-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                                                    <div class="form-group" id="kcpe_index_number_div">
                                                                            <label for="kcpe_index_number">KCPE index number</label>
                                                                            <input type="number" id="kcpe_index_number" class="form-control" name="kcpe_index_number" value="{{$student->kcpe_index_no}}" required>
                                                                            <div id="kcpe_index_number_error"></div>
                                                                    </div>
                                                        
                                                            </div>
                                    
                                                            <div class="col-xm-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                                                    <div class="form-group" id="residence_div">
                                                                            <label for="residence">Place of residence</label>
                                                                            <input type="text" id="residence" class="form-control" name="residence" value="{{$student->residence}}" required >
                                                                            <div id="residence_error"></div>
                                                                    </div>
                                                        
                                                            </div>
                                    
                                                            <div class="col-xm-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                                                    <div class="form-group" id="religion_div">
                                                                            <label for="religion">Religion</label>
                                                                            <select id="religion" name="religion" class="form-control" required>
                                                                                <option value="">Select religion</option>
                                                                                <option @if($student->religion == 'Christian') selected @endif>Christian</option>
                                                                                 <option @if($student->religion == 'Islam') selected @endif>Islam</option>
                                                                                 <option @if($student->religion == 'Other') selected @endif>Other</option>
                                                                            </select>
                                                                            <div id="religion_error"></div>
                                                                        </div>
                                                            </div>
                                    
                                                            <div class="col-xm-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                                                    <div class="form-group" id="nationality_div">
                                                                            <label for="nationality">Nationality</label>
                                                                            <select id="nationality" name="nationality" class="form-control" required>
                                                                                    <option value="">Select nationality</option>
                                                                                <option  @if($student->nationality == 'Kenyan') selected @endif>Kenyan</option>
                                                                                 <option  @if($student->nationality == 'Ugandan') selected @endif>Ugandan</option>
                                                                                 <option  @if($student->nationality == 'Tanzania') selected @endif>Tanzania</option>
                                                                                 <option  @if($student->nationality == 'Somalian') selected @endif>Somalian</option>
                                                                            </select>
                                                                            <div id="nationality_error"></div>
                                                                        </div>
                                                    
                                                            </div>
                                    
                                      
                                                        </div>
                                                      </div>
                                                
                                                <div style="align: center;" class="pull-right">
                                                <input type="submit" class="btn btn-success" value="Update" ></input>
                                                
                                                </div>
                                                <div class="col-md-3"></div>
                                            </div>
                                        
                                    </form>

                                    @endforeach
                                    @endif
                               
                           
                             </div>
                             
                              
                                
                              </div>
                                 
      
    

    
@endsection

