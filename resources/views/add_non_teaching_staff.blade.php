<style>
        input[type="radio"]{
          margin: 0 10px 0 10px;
        }
        
            </style>
        
        @extends('layouts.dashboard')
        
        @section('content')
        
        
            <div>
            <form action="/add_staff" method = "POST" name="not_teaching_staff_form">
                @csrf
        <div class="container">
            <div class="row">
                
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-1"></div>
                    
                    <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                    <div class="jumbotron-fluid">
                          <h1 class="text-center" style="text-decoration: underline; ">Add non-teaching staff</h1>	
                             
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
                                        <div class="form-group" id="phone_no_div">
                                                <label class="control-table" for="phone_no">Phone number</label>
                                                <input type="number" name="phone_no" id="phone_no" class="form-control" placeholder="Enter phone number">
                                                <div id="phone_no_error"></div>
                                        </div>
                                    
                                </div>

                                <div class="col-xm-12 col-sm-12 col-md-6 col-lg-8 col-xl-8">
                                        <div class="form-group" id="email_div">
                                                <label class="control-table" for="email">Email address</label>
                                                <input type="email" name="email" id="email" class="form-control" placeholder="Enter email address">
                                                <div id="email_error"></div>
                                        </div>
                                    
                                </div>

                                <div class="col-xm-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                        <div class="form-group" id="id_no_div">
                                                <label for="id_no">ID number</label>
                                                <input type="number" id="id_no" class="form-control" name="id_no" >
                                                <div id="id_no_error"></div>
                                        </div>
                            
                                </div>

                                <div class="col-xm-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                        <div class="form-group" id="emp_no_div">
                                                <label for="emp_no">Employee number</label>
                                                <input type="text" id="emp_no" class="form-control" name="emp_no" >
                                                <div id="emp_no_error"></div>
                                        </div>
                            
                                </div>

                                <div class="col-xm-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                        <div class="form-group" id="category_div">
                                                <label for="category">Category</label>
                                                <select id="category" name="category" class="form-control">
                                                    <option value=""></option>
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
                                                    <option>Male</option>
                                                     <option>Female</option>
                                                </select>
                                                <div id="gender_error"></div>
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
                                        <div class="form-group" id="salary_div">
                                                <label for="salary">Salary</label>
                                                <input type="number" id="salary" class="form-control" name="salary" >
                                                <div id="salary_error"></div>
                                        </div>
                            
                                </div>
          
                            </div>
                    
                    <div style="align: center;" class="pull-right">
                    <input type="submit" class="btn btn-success" value="Submit" onclick="return validateNonTeachingStaff()"></input>
                    
                    </div>
                    </div>
                    <div class="col-md-3"></div>
                </div>
            </div>
        </form>
            </div>
        
            
        @endsection

<script type="text/javascript">

    function populate(s1, s2){

        //get the values by id
        var s1 = document.getElementById('category');
        var s2 = document.getElementById('subject_2');

        s2.innerHTML = "";

        if(s1.value == "mathematics"){
            var optionArray = [
                                "|",
                                "chemistry|Chemistry", 
                                "physics|Physics",
                                "business_studies|Business studies",
                                "geography|Geography"
                                ];
        }
        else if(s1.value == "english"){
            var optionArray = [
                                "|",
                                "literature|Literature" 
                                ];
        }
        else if(s1.value == "kiswahili"){
            var optionArray = [
                                "|",
                                "history|History", 
                                "cre|Christian Religous Education"
                                ];
        }
        else if(s1.value == "chemistry"){
            var optionArray = [
                                "|",
                                "mathematics|Mathematics", 
                                "physics|Physics",
                                "geography|Geography"
                                ];
        }
        else if(s1.value == "biology"){
            var optionArray = [
                                "|",
                                "chemistry|Chemistry", 
                                "agriculture|Agriculture",
                                "geography|Geography"
                                ];
        }
        else if(s1.value == "physics"){
            var optionArray = [
                                "|",
                                "chemistry|Chemistry", 
                                "mathematics|Mathematics"
                                ];
        }
        else if(s1.value == "geography"){
            var optionArray = [
                                "|",
                                "chemistry|Chemistry", 
                                "mathematics|Mathematics",
                                "biology|Biology",
                                "agriculture|Agriculture",
                                "business_studies|Business studies"
                                ];
        }
        else if(s1.value == "history"){
            var optionArray = [
                                "|",
                                "kiswahili|Kiswahili", 
                                "cre|Christian Religious Education"
                                ];
        }
        else if(s1.value == "cre"){
            var optionArray = [
                                "|",
                                "history|History", 
                                "kiswahili|Kiswahili"
                                ];
        }
        else if(s1.value == "agriculture"){
            var optionArray = [
                                "|",
                                "biology|Biology", 
                                "geography|geography",
                                "chemistry|Chemistry",
                                "mathematics|Mathematics"
                                ];
        }
        else if(s1.value == "business_studies"){
            var optionArray = [
                                "|",
                                "mathematics|Mathematics", 
                                "geography|Geography"
                                ];
        }

        for(var option in optionArray){

            var pair = optionArray[option].split("|");
            var newOption = document.createElement("option");
            newOption.value = pair[0];
            newOption.innerHTML = pair[1];
            s2.options.add(newOption);

        }
    }

 </script>