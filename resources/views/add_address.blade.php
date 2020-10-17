<style>
        input[type="radio"]{
          margin: 0 10px 0 10px;
        }
        
            </style>
        
        @extends('layouts.dashboard')
        
        @section('content')
        <?php
                $student_id;

                foreach ($student as $stu) {
                        $student_id = $stu->id;
                }

                echo $student_id;
        ?>
        
        
            <div>
            <form action="add_student_address" method = "POST" name="address_form">
                    @csrf
        <div class="container">
            <div class="row">
                
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-1"></div>
                    
                    <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                    <div class="jumbotron-fluid">
                          <h1 class="text-center" style="text-decoration: underline;">Add student address details</h1>	
                            <input type="hidden" name="student_id" value="<?php echo $student_id ?>" /> 
                          <div class="row">
                                <div class="col-xm-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                      <div class="form-group" id="postal_code_div">
                                              <label class="control-table" for="postal_code">Postal code</label>
                                              <input type="number" name="postal_code" id="postal_code" class="form-control" placeholder="Enter postal code">
                                              <div id="postal_code_error"></div>
                                      </div>	
                                </div>
          
                                <div class="col-xm-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                      <div class="form-group" id="postal_address_div">
                                              <label class="control-table" for="postal_address">Postal address</label>
                                              <input type="number" name="postal_address" id="postal_address" class="form-control" placeholder="Enter postal address">
                                              <div id="postal_address_error"></div>
                                      </div>	
                                </div>
          
                                <div class="col-xm-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                      <div class="form-group" id="street_div">
                                              <label class="control-table" for="street">Street</label>
                                              <input type="text" name="street" id="street" class="form-control" placeholder="Enter street name">
                                              <div id="street_error"></div>
                                      </div>	
                                </div>
        
                                <div class="col-xm-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                        <div class="form-group" id="town_div">
                                                <label class="control-table" for="town">Town</label>
                                                <input type="text" name="town" id="town" class="form-control" placeholder="Enter town">
                                                <div id="town_error"></div>
                                        </div>
                                    
                                </div>
        
                                <div class="col-xm-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                        <div class="form-group" id="gende_div">
                                                <label for="country">Country</label>
                                                <select id="country" name="country" class="form-control">
                                                    <option>Kenya</option>
                                                     <option>Uganda</option>
                                                     <option>Tanzania</option>
                                                     <option>Somalia</option>
                                                </select>
                                                <div id="gender_error"></div>
                                            </div>
                                    
                                </div>
        
                                
        
          
                            
                          </div>
                    
                    <div style="align: center;" class="pull-right">
                    <input type="submit" class="btn btn-success" value="Submit" onclick="return validateAddress()"></input>
                    
                    </div>
                    </div>
                    <div class="col-md-3"></div>
                </div>
            </div>
        </form>
            </div>
        
            
        @endsection