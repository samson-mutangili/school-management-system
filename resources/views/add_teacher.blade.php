<style>
        input[type="radio"]{
          margin: 0 10px 0 10px;
        }
        
            </style>
        
        @extends('layouts.dashboard')
        
        @section('content')


<div class="row">
    <div class="col-md-12">
        <h4 class="page-head-line">Teachers registration</h4>

    </div>
</div>


<div class="panel panel-default w-auto">
    <div class="panel-heading">
     Add a new teacher
    </div>
      @csrf
       <div class="panel-body">
        
            <div class="row">
            <form action="/add_teacher" method = "POST" name="teacher_form">
                @csrf
                <div>
            <div>
                
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-1"></div>
                    
                    <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                    <div  style="margin-top: 10px; margin-left: 10px;">
                             
                          <div class="row">
                                <div class="col-xm-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                      <div class="form-group" id="teacher_first_name_div">
                                              <label class="control-table" for="teacher_first_name">First name</label>
                                              <input type="text" name="teacher_first_name" id="teacher_first_name" class="form-control" required placeholder="Enter first name">
                                              <div id="teacher_first_name_error"></div>
                                      </div>	
                                </div>
          
                                <div class="col-xm-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                      <div class="form-group" id="teacher_middle_name_div">
                                              <label class="control-table" for="teacher_middle_name">Enter middle name</label>
                                              <input type="text" name="teacher_middle_name" id="teacher_middle_name" class="form-control" placeholder="Enter middle name">
                                              <div id="teacher_middle_name_error"></div>
                                      </div>	
                                </div>
          
                                <div class="col-xm-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                      <div class="form-group" id="teacher_last_name_div">
                                              <label class="control-table" for="teacher_last_name">Last name</label>
                                              <input type="text" name="teacher_last_name" id="teacher_last_name" class="form-control" placeholder="Enter last name">
                                              <div id="teacher_last_name_error"></div>
                                      </div>	
                                </div>
        
                                <div class="col-xm-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                        <div class="form-group" id="teacher_phone_no_div">
                                                <label class="control-table" for="teacher_phone_no">Phone number</label>
                                                <input type="number" name="teacher_phone_no" id="teacher_phone_no" class="form-control" placeholder="Enter phone number">
                                                <div id="teacher_phone_no_error"></div>
                                        </div>
                                    
                                </div>

                                <div class="col-xm-12 col-sm-12 col-md-6 col-lg-8 col-xl-8">
                                        <div class="form-group" id="teacher_email_div">
                                                <label class="control-table" for="teacher_email">Email address</label>
                                                <input type="email" name="teacher_email" id="teacher_email" class="form-control" placeholder="Enter email address">
                                                <div id="teacher_email_error"></div>
                                        </div>
                                    
                                </div>

                                <div class="col-xm-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                        <div class="form-group" id="tsc_no_div">
                                                <label for="tsc_no">TSC number</label>
                                                <input type="number" id="tsc_no" class="form-control" name="tsc_no" >
                                                <div id="tsc_no_error"></div>
                                        </div>
                                    
                                </div>
        
                                <div class="col-xm-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                        <div class="form-group" id="teacher_id_no_div">
                                                <label for="teacher_id_no">ID number</label>
                                                <input type="number" id="teacher_id_no" class="form-control" name="teacher_id_no" >
                                                <div id="teacher_id_no_error"></div>
                                        </div>
                            
                                </div>

                                <div class="col-xm-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                        <div class="form-group" id="subject_1_div">
                                                <label for="subject_1">Subject 1</label>
                                                <select id="subject_1" name="subject_1" class="form-control" onchange="populate(this.id,'subject_2')">
                                                    <option value=""></option>
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
                                                   
                                                </select>
                                                <div id="subject_2_error"></div>
                                            </div>
                                    
                                </div>  
        
                                <div class="col-xm-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                        <div class="form-group" id="teacher_gender_div">
                                                <label for="teacher_gender">Gender</label>
                                                <select id="teacher_gender" name="teacher_gender" class="form-control">
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
                    </div>
                    <div class="col-md-3"></div>
                </div>
            </div>
        </form>
            </div>
        
        
        
       </div>
</div>  
        @endsection

<script type="text/javascript">

    function populate(s1, s2){

        //get the values by id
        var s1 = document.getElementById('subject_1');
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