<style>
    input[type="radio"]{
      margin: 0 10px 0 10px;
    }

    fieldset{
            border: 2px solid #333;
            border-radius: 10px;
            padding: 5px;
    }

    legend{
        color: #red;
    }

    input[type="checkbox"]{
      margin: 0 10px 0 10px;
    }
        </style>
    
    @extends('layouts.dashboard')
    
    @section('content')
    
    
        <div>
        <form action="RegisterBus" method = "POST" name="parent_form" onsubmit="return validateParent()">
    <div class="container">
        <div class="row">
            
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"></div>
                
                <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                <div class="jumbotron-fluid">
                      <h1 class="text-center" style="text-decoration: underline;">Add student's parent(s)</h1>	
                     
                      <div class="form-check-inline">
                        <label class="form-check-label">
                          <input type="checkbox" class="form-check-input" value="father" checked id="add_father" onclick="showFatherInput()">Add father
                        </label>
                      </div>
                      <div class="form-check-inline">
                        <label class="form-check-label">
                          <input type="checkbox" class="form-check-input" value="mother" checked id="add_mother" onclick="showMotherInput()" >Add mother
                        </label>
                      </div>
                      <div class="form-check-inline">
                        <label class="form-check-label">
                          <input type="checkbox" class="form-check-input" value="guardian" checked id="add_guardian" onclick="showGuardianInput()" >Add guardian
                        </label>
                      </div>


                      <fieldset style="border: 2px solid #333; border-radius: 10px; padding: 5px; margin: 10px 5px; position: relative; overflow: hidden; " id="fathers_details">
                      <legend style="color: red; width: auto;"> Fathers details</legend>
                      
                      <div class="row">
                          
                              
                            <div class="col-xm-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                  <div class="form-group" id="father_first_name_div">
                                          <label class="control-table" for="father_first_name">First name</label>
                                          <input type="text" name="father_first_name" id="father_first_name" class="form-control" placeholder="Enter first name">
                                          <div id="father_first_name_error"></div>
                                  </div>	
                            </div>
      
                            <div class="col-xm-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                  <div class="form-group" id="father_middle_name_div">
                                          <label class="control-table" for="father_middle_name">Enter middle name</label>
                                          <input type="text" name="father_middle_name" id="father_middle_name" class="form-control" placeholder="Enter middle name">
                                          <div id="father_middle_name_error"></div>
                                  </div>	
                            </div>
      
                            <div class="col-xm-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                  <div class="form-group" id="father_last_name_div">
                                          <label class="control-table" for="father_last_name">Last name</label>
                                          <input type="text" name="father_last_name" id="father_last_name" class="form-control" placeholder="Enter last name">
                                          <div id="father_last_name_error"></div>
                                  </div>	
                            </div>
    
                            <div class="col-xm-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                    <div class="form-group" id="father_phone_no_div">
                                            <label class="control-table" for="father_phone_no">Phone number</label>
                                            <input type="number" name="father_phone_no" id="father_phone_no" class="form-control" placeholder="Phone number">
                                            <div id="father_phone_no_error"></div>
                                    </div>
                                
                            </div>

                            <div class="col-xm-12 col-sm-12 col-md-6 col-lg-8 col-xl-8">
                                <div class="form-group" id="father_email_div">
                                        <label for="father_email">Email address</label>
                                        <input type="email" id="father_email" class="form-control" name="father_email" placeholder="Email address" >
                                        <div id="father_email_error"></div>
                                    </div>                            
                             </div>
    
                               
                            
    
                            <div class="col-xm-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                    <div class="form-group" id="father_id_no_div">
                                            <label for="father_id_no">ID number</label>
                                            <input type="number" id="father_id_no" class="form-control" name="father_id_no"  >
                                            <div id="father_id_no_error"></div>
                                    </div>
                                
                            </div> 

                            <div class="col-xm-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                <div class="form-group" id="father_occupation_div">
                                        <label for="father_id_no">Occupation</label>
                                        <input type="text" id="father_occupation" class="form-control" name="father_occupation" placeholder="Parents occupation"  >
                                        <div id="father_occupation_error"></div>
                                </div>
                            
                        </div> 
                        </div>
                </fieldset>

                      
                      
                      <br>

                      <fieldset style="border: 2px solid #333; border-radius: 10px; padding: 5px; margin: 10px 0px; " id="mothers_details">
                            <legend style="color:red; width: auto;">Mothers details</legend>
                            
                            <div class="row">
                                
                                    
                                  <div class="col-xm-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                        <div class="form-group" id="mother_first_name_div">
                                                <label class="control-table" for="mother_first_name">First name</label>
                                                <input type="text" name="mother_first_name" id="mother_first_name" class="form-control" placeholder="Enter first name">
                                                <div id="mother_first_name_error"></div>
                                        </div>	
                                  </div>
                                  
            
                                  <div class="col-xm-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                        <div class="form-group" id="mother_middle_name_div">
                                                <label class="control-table" for="mother_middle_name">Enter middle name</label>
                                                <input type="text" name="mother_middle_name" id="mother_middle_name" class="form-control" placeholder="Enter middle name">
                                                <div id="mother_middle_name_error"></div>
                                        </div>	
                                  </div>
            
                                  <div class="col-xm-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                        <div class="form-group" id="mother_last_name_div">
                                                <label class="control-table" for="mother_last_name">Last name</label>
                                                <input type="text" name="mother_last_name" id="mother_last_name" class="form-control" placeholder="Enter last name">
                                                <div id="mother_last_name_error"></div>
                                        </div>	
                                  </div>
          
                                  <div class="col-xm-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                          <div class="form-group" id="mother_phone_no_div">
                                                  <label class="control-table" for="mother_phone_no">Phone number</label>
                                                  <input type="number" name="mother_phone_no" id="mother_phone_no" class="form-control" placeholder="Phone number">
                                                  <div id="mother_phone_no_error"></div>
                                          </div>
                                      
                                  </div>
      
                                  <div class="col-xm-12 col-sm-12 col-md-6 col-lg-8 col-xl-8">
                                      <div class="form-group" id="mother_email_div">
                                              <label for="mother_email">Email address</label>
                                              <input type="email" id="mother_email" class="form-control" name="mother_email" placeholder="Email address" >
                                              <div id="mother_email_error"></div>
                                          </div>                            
                                   </div>         
                                  
                                  <div class="col-xm-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                          <div class="form-group" id="mother_id_no_div">
                                                  <label for="mother_id_no">ID number</label>
                                                  <input type="number" id="mother_id_no" class="form-control" name="mother_id_no"  >
                                                  <div id="mother_id_no_error"></div>
                                          </div>
                                      
                                  </div> 
      
                                  <div class="col-xm-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                      <div class="form-group" id="mother_occupation_div">
                                              <label for="mother_occupation">Occupation</label>
                                              <input type="text" id="mother_occupation" class="form-control" name="mother_occupation" placeholder="Parents occupation"  >
                                              <div id="mother_occupation_error"></div>
                                      </div>
                                  
                              </div> 
                              </div>
                        </fieldset>


                      <br>

                      <fieldset style="border: 2px solid #333; border-radius: 10px; padding: 5px; margin: 10px 0px; " id="guardian_details">
                            <legend style="color:red; width: auto;">Guardian details</legend>
                            
                            <div class="row">
                                
                                    
                                  <div class="col-xm-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                        <div class="form-group" id="guardian_first_name_div">
                                                <label class="control-table" for="guardian_first_name">First name</label>
                                                <input type="text" name="guardian_first_name" id="guardian_first_name" class="form-control" placeholder="Enter first name">
                                                <div id="guardian_first_name_error"></div>
                                        </div>	
                                  </div>
            
                                  <div class="col-xm-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                        <div class="form-group" id="guardian_middle_name_div">
                                                <label class="control-table" for="guardian_middle_name">Enter middle name</label>
                                                <input type="text" name="guardian_middle_name" id="guardian_middle_name" class="form-control" placeholder="Enter middle name">
                                                <div id="guardian_middle_name_error"></div>
                                        </div>	
                                  </div>
            
                                  <div class="col-xm-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                        <div class="form-group" id="guardian_last_name_div">
                                                <label class="control-table" for="guardian_last_name">Last name</label>
                                                <input type="text" name="guardian_last_name" id="guardian_last_name" class="form-control" placeholder="Enter last name">
                                                <div id="guardian_last_name_error"></div>
                                        </div>	
                                  </div>
          
                                  <div class="col-xm-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                          <div class="form-group" id="guardian_phone_no_div">
                                                  <label class="control-table" for="guardian_phone_no">Phone number</label>
                                                  <input type="number" name="guardian_phone_no" id="guardian_phone_no" class="form-control" placeholder="Phone number">
                                                  <div id="guardian_phone_no_error"></div>
                                          </div>
                                      
                                  </div>
      
                                  <div class="col-xm-12 col-sm-12 col-md-6 col-lg-8 col-xl-8">
                                      <div class="form-group" id="guardian_email_div">
                                              <label for="guardian_email">Email address</label>
                                              <input type="email" id="guardian_email" class="form-control" name="guardian_email" placeholder="Email address" >
                                              <div id="guardian_email_error"></div>
                                          </div>                            
                                   </div>
          
                                  <div class="col-xm-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                          <div class="form-group" id="guardian_gender_div">
                                                  <label for="guardian_gender">Gender</label>
                                                  <select id="guardian_gender" name="guardian_gender" class="form-control">
                                                      <option>Male</option>
                                                       <option>female</option>
                                                  </select>
                                                  <div id="guardian_gender_error"></div>
                                              </div>
                                      
                                  </div>
          
                                  
          
                                  <div class="col-xm-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                          <div class="form-group" id="guardian_id_no_div">
                                                  <label for="guardian_id_no">ID number</label>
                                                  <input type="number" id="guardian_id_no" class="form-control" name="guardian_id_no"  >
                                                  <div id="guardian_id_no_error"></div>
                                          </div>
                                      
                                  </div> 
      
                                  <div class="col-xm-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                      <div class="form-group" id="guardian_occupation_div">
                                              <label for="guardian_occupation">Occupation</label>
                                              <input type="text" id="guardian_occupation" class="form-control" name="guardian_occupation" placeholder="Parents occupation"  >
                                              <div id="guardian_occupation_error"></div>
                                      </div>
                                  
                              </div> 
                              </div>
                        </fieldset>
                <div style="align: center;" class="pull-right">
                <input type="submit" class="btn btn-success" value="Submit" onClick="return validateParent()">
                
                </div>
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
    </form>
        </div>
    
        
    @endsection

