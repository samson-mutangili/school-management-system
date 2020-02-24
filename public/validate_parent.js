
    //get the father input fields
    var father_first_name = document.forms['parent_form']['father_first_name'];
	var father_middle_name = document.forms['parent_form']['father_middle_name'];
	var father_last_name = document.forms['parent_form']['father_last_name'];
    var father_phone_no = document.forms['parent_form']['father_phone_no'];
	var father_email = document.forms['parent_form']['father_email'];
	var father_id_no = document.forms['parent_form']['father_id_no'];
    var father_occupation = document.forms['parent_form']['father_occupation'];
    

    //get the mother input fields
    var mother_first_name = document.forms['parent_form']['mother_first_name'];
	var mother_middle_name = document.forms['parent_form']['mother_middle_name'];
	var mother_last_name = document.forms['parent_form']['mother_last_name'];
    var mother_phone_no = document.forms['parent_form']['mother_phone_no'];
	var mother_email = document.forms['parent_form']['mother_email'];
	var mother_id_no = document.forms['parent_form']['mother_id_no'];
    var mother_occupation = document.forms['parent_form']['mother_occupation'];
    
    
    //get the guardian input fields
    var guardian_first_name = document.forms['parent_form']['guardian_first_name'];
	var guardian_middle_name = document.forms['parent_form']['guardian_middle_name'];
	var guardian_last_name = document.forms['parent_form']['guardian_last_name'];
    var guardian_phone_no = document.forms['parent_form']['guardian_phone_no'];
	var guardian_email = document.forms['parent_form']['guardian_email'];
	var guardian_id_no = document.forms['parent_form']['guardian_id_no'];   
	var guardian_occupation = document.forms['parent_form']['guardian_occupation'];
    
    
    //get the father details error fields
	var father_first_name_error = document.getElementById('father_first_name_error');
	var father_middle_name_error = document.getElementById('father_middle_name_error');
	var father_last_name_error = document.getElementById('father_last_name_error');
	var father_phone_no_error = document.getElementById('father_phone_no_error');
	var father_email_error = document.getElementById('father_email_error');
	var father_id_no_error = document.getElementById('father_id_no_error');
    var father_occupation_error = document.getElementById('father_occupation_error');
    
    //get the mother details error fields
	var mother_first_name_error = document.getElementById('mother_first_name_error');
	var mother_middle_name_error = document.getElementById('mother_middle_name_error');
	var mother_last_name_error = document.getElementById('mother_last_name_error');
	var mother_phone_no_error = document.getElementById('mother_phone_no_error');
	var mother_email_error = document.getElementById('mother_email_error');
	var mother_id_no_error = document.getElementById('mother_id_no_error');
    var mother_occupation_error = document.getElementById('mother_occupation_error');
    
	
    //get the guardian details error fields
	var guardian_first_name_error = document.getElementById('guardian_first_name_error');
	var guardian_middle_name_error = document.getElementById('guardian_middle_name_error');
	var guardian_last_name_error = document.getElementById('guardian_last_name_error');
	var guardian_phone_no_error = document.getElementById('guardian_phone_no_error');
	var guardian_email_error = document.getElementById('guardian_email_error');
	var guardian_id_no_error = document.getElementById('guardian_id_no_error');
	var guardian_occupation_error = document.getElementById('mother_occupation_error');
	
	
    //add event listeners to father input fields
	father_first_name.addEventListener('blur', father_first_nameVerify, true);
	father_middle_name.addEventListener('blur', father_middle_nameVerify, true);
	father_last_name.addEventListener('blur', father_last_nameVerify, true);
	father_phone_no.addEventListener('blur', father_phone_noVerify, true);  
	father_email.addEventListener('blur', father_emailVerify, true);	
	father_id_no.addEventListener('blur', father_id_noVerify, true);
    father_occupation.addEventListener('blur', father_occupationVerify, true);
    
    //add event listeners to mother input fields
	mother_first_name.addEventListener('blur', mother_first_nameVerify, true);
	mother_middle_name.addEventListener('blur', mother_middle_nameVerify, true);
	mother_last_name.addEventListener('blur', mother_last_nameVerify, true);
    mother_phone_no.addEventListener('blur', mother_phone_noVerify, true);    
	mother_email.addEventListener('blur', mother_emailVerify, true);
	mother_id_no.addEventListener('blur', mother_id_noVerify, true);
    mother_occupation.addEventListener('blur', mother_occupationVerify, true);
	
	
    //add event listeners to guardian input fields
	guardian_first_name.addEventListener('blur', guardian_first_nameVerify, true);	
	guardian_middle_name.addEventListener('blur', guardian_middle_nameVerify, true);
	guardian_last_name.addEventListener('blur', guardian_last_nameVerify, true);
    guardian_phone_no.addEventListener('blur', guardian_phone_noVerify, true);    
	guardian_email.addEventListener('blur', guardian_emailVerify, true);
	guardian_id_no.addEventListener('blur', guardian_id_noVerify, true);
	guardian_occupation.addEventListener('blur', guardian_occupationVerify, true);
	
	var regularExpression = /^([emp]{3})([0-9]{3, 4})$/;
	
	function validateParent(){

		//get the state of the check box, whether checked or not
		var father = document.getElementById('add_father').checked;
		var mother = document.getElementById('add_mother').checked;
		var guardian = document.getElementById('add_guardian').checked;
			
		if( (father && mother && guardian) || (father) || (mother) || (guardian) || (father && mother) || (father && guardian) || (mother && guardian) ){
			
	   
		//if father details are present, validate the fields
		if(father){
            //validate first name
            if(father_first_name.value == "" || father_first_name.value == null){
				father_first_name.style.border = "1px solid red";
                document.getElementById('father_first_name_div').style.color = "red";
                father_first_name_error.innerHTML = "First name is required";
                father_first_name.focus();
                return false;
			}

			//validate first name
            if(father_first_name.value.length < 3){
				father_first_name.style.border = "1px solid red";
                document.getElementById('father_first_name_div').style.color = "red";
                father_first_name_error.innerHTML = "Invalid name";
                father_first_name.focus();
                return false;
			}
			
			//validate middle name
            if(father_middle_name.value == "" || father_middle_name.value == null){
				father_middle_name.style.border = "1px solid red";
                document.getElementById('father_middle_name_div').style.color = "red";
                father_middle_name_error.innerHTML = "Middle name is required";
                father_middle_name.focus();
                return false;
			}

			//validate middle name
            if(father_middle_name.value.length < 3 ){
				father_middle_name.style.border = "1px solid red";
                document.getElementById('father_middle_name_div').style.color = "red";
                father_middle_name_error.innerHTML = "Invalid name";
                father_middle_name.focus();
                return false;
			}
			
			//validate last name
            if(father_last_name.value == "" || father_middle_name.value == null){
				father_last_name.style.border = "1px solid red";
                document.getElementById('father_last_name_div').style.color = "red";
                father_last_name_error.innerHTML = "Last name is required";
                father_last_name.focus();
                return false;
			}

			//validate last name
            if(father_last_name.value.length < 3){
				father_last_name.style.border = "1px solid red";
                document.getElementById('father_last_name_div').style.color = "red";
                father_last_name_error.innerHTML = "Invalid name";
                father_last_name.focus();
                return false;
			}
			
			//validate phone number
            if(father_phone_no.value == "" || father_phone_no.value == null){
				father_phone_no.style.border = "1px solid red";
                document.getElementById('father_phone_no_div').style.color = "red";
                father_phone_no_error.innerHTML = "Phone number is required";
                father_phone_no.focus();
                return false;
			}

			//validate phone number
            if(father_phone_no.value.length != 10){
				father_phone_no.style.border = "1px solid red";
                document.getElementById('father_phone_no_div').style.color = "red";
                father_phone_no_error.innerHTML = "Invalid phone number";
                father_phone_no.focus();
                return false;
			}
			
			//validate phone number
            if(father_email.value == "" || father_email.value == null){
				father_email.style.border = "1px solid red";
                document.getElementById('father_email_div').style.color = "red";
                father_email_error.innerHTML = "Email address is required";
                father_email.focus();
                return false;
			}
			
			//validate id number
            if(father_id_no.value == "" || father_id_no.value == null){
				father_id_no.style.border = "1px solid red";
                document.getElementById('father_id_no_div').style.color = "red";
                father_id_no_error.innerHTML = "Phone number is required";
                father_id_no.focus();
                return false;
			}

			//validate id number
            if(father_id_no.value.length != 8){
				father_id_no.style.border = "1px solid red";
                document.getElementById('father_id_no_div').style.color = "red";
                father_id_no_error.innerHTML = "Phone number is required";
                father_id_no.focus();
                return false;
			}
			
			//validate id number
            if(father_occupation.value == "" || father_occupation.value == null){
				father_occupation.style.border = "1px solid red";
                document.getElementById('father_occupation_div').style.color = "red";
                father_occupation_error.innerHTML = "Occupation is required";
                father_occupation.focus();
                return false;
			}
			
			//validate id number
            if(father_occupation.value.length < 4){
				father_occupation.style.border = "1px solid red";
                document.getElementById('father_occupation_div').style.color = "red";
                father_occupation_error.innerHTML = "Invalid occupation";
                father_occupation.focus();
                return false;
            }

		}
		 
		//validate the mother details if the mother exists
		if(mother){
            //validate first name
            if(mother_first_name.value == "" || mother_first_name.value == null){
				mother_first_name.style.border = "1px solid red";
                document.getElementById('mother_first_name_div').style.color = "red";
                mother_first_name_error.innerHTML = "First name is required";
                mother_first_name.focus();
                return false;
			}

			//validate first name
            if(mother_first_name.value.length < 3){
				mother_first_name.style.border = "1px solid red";
                document.getElementById('mother_first_name_div').style.color = "red";
                mother_first_name_error.innerHTML = "Invalid name";
                mother_first_name.focus();
                return false;
			}
			
			//validate middle name
            if(mother_middle_name.value == "" || mother_middle_name.value == null){
				mother_middle_name.style.border = "1px solid red";
                document.getElementById('mother_middle_name_div').style.color = "red";
                mother_middle_name_error.innerHTML = "Middle name is required";
                mother_middle_name.focus();
                return false;
			}

			//validate middle name
            if(mother_middle_name.value.length < 3 ){
				mother_middle_name.style.border = "1px solid red";
                document.getElementById('mother_middle_name_div').style.color = "red";
                mother_middle_name_error.innerHTML = "Invalid name";
                mother_middle_name.focus();
                return false;
			}
			
			//validate last name
            if(mother_last_name.value == "" || mother_middle_name.value == null){
				mother_last_name.style.border = "1px solid red";
                document.getElementById('mother_last_name_div').style.color = "red";
                mother_last_name_error.innerHTML = "Last name is required";
                mother_last_name.focus();
                return false;
			}

			//validate last name
            if(mother_last_name.value.length < 3){
				mother_last_name.style.border = "1px solid red";
                document.getElementById('mother_last_name_div').style.color = "red";
                mother_last_name_error.innerHTML = "Invalid name";
                mother_last_name.focus();
                return false;
			}
			
			//validate phone number
            if(mother_phone_no.value == "" || mother_phone_no.value == null){
				mother_phone_no.style.border = "1px solid red";
                document.getElementById('mother_phone_no_div').style.color = "red";
                mother_phone_no_error.innerHTML = "Phone number is required";
                mother_phone_no.focus();
                return false;
			}

			//validate phone number
            if(mother_phone_no.value.length != 10){
				mother_phone_no.style.border = "1px solid red";
                document.getElementById('mother_phone_no_div').style.color = "red";
                mother_phone_no_error.innerHTML = "Invalid phone number";
                mother_phone_no.focus();
                return false;
			}
			
			//validate phone number
            if(mother_email.value == "" || mother_email.value == null){
				mother_email.style.border = "1px solid red";
                document.getElementById('mother_email_div').style.color = "red";
                mother_email_error.innerHTML = "Email address is required";
                mother_email.focus();
                return false;
			}
			
			//validate id number
            if(mother_id_no.value == "" || mother_id_no.value == null){
				mother_id_no.style.border = "1px solid red";
                document.getElementById('mother_id_no_div').style.color = "red";
                mother_id_no_error.innerHTML = "ID number is required";
                mother_id_no.focus();
                return false;
			}

			//validate id number
            if(mother_id_no.value.length != 8){
				mother_id_no.style.border = "1px solid red";
                document.getElementById('mother_id_no_div').style.color = "red";
                mother_id_no_error.innerHTML = "Invalid ID number";
                mother_id_no.focus();
                return false;
			}
			
			//validate id number
            if(mother_occupation.value == "" || mother_occupation.value == null){
				mother_occupation.style.border = "1px solid red";
                document.getElementById('mother_occupation_div').style.color = "red";
                mother_occupation_error.innerHTML = "Occupation is required";
                mother_occupation.focus();
                return false;
			}
			
			//validate id number
            if(mother_occupation.value.length < 4){
				mother_occupation.style.border = "1px solid red";
                document.getElementById('mother_occupation_div').style.color = "red";
                mother_occupation_error.innerHTML = "Invalid occupation";
                mother_occupation.focus();
                return false;
            }

		}


		//validate the guardian details if the guardian exists
		if(guardian){
            //validate first name
            if(guardian_first_name.value == "" || guardian_first_name.value == null){
				guardian_first_name.style.border = "1px solid red";
                document.getElementById('guardian_first_name_div').style.color = "red";
                guardian_first_name_error.innerHTML = "First name is required";
                guardian_first_name.focus();
                return false;
			}

			//validate first name
            if(guardian_first_name.value.length < 3){
				guardian_first_name.style.border = "1px solid red";
                document.getElementById('guardian_first_name_div').style.color = "red";
                guardian_first_name_error.innerHTML = "Invalid name";
                guardian_first_name.focus();
                return false;
			}
			
			//validate middle name
            if(guardian_middle_name.value == "" || guardian_middle_name.value == null){
				guardian_middle_name.style.border = "1px solid red";
                document.getElementById('guardian_middle_name_div').style.color = "red";
                guardian_middle_name_error.innerHTML = "Middle name is required";
                guardian_middle_name.focus();
                return false;
			}

			//validate middle name
            if(guardian_middle_name.value.length < 3 ){
				guardian_middle_name.style.border = "1px solid red";
                document.getElementById('guardian_middle_name_div').style.color = "red";
                guardian_middle_name_error.innerHTML = "Invalid name";
                guardian_middle_name.focus();
                return false;
			}
			
			//validate last name
            if(guardian_last_name.value == "" || guardian_middle_name.value == null){
				guardian_last_name.style.border = "1px solid red";
                document.getElementById('guardian_last_name_div').style.color = "red";
                guardian_last_name_error.innerHTML = "Last name is required";
                guardian_last_name.focus();
                return false;
			}

			//validate last name
            if(guardian_last_name.value.length < 3){
				guardian_last_name.style.border = "1px solid red";
                document.getElementById('mother_last_name_div').style.color = "red";
                guardian_last_name_error.innerHTML = "Invalid name";
                guardian_last_name.focus();
                return false;
			}
			
			//validate phone number
            if(guardian_phone_no.value == "" || guardian_phone_no.value == null){
				guardian_phone_no.style.border = "1px solid red";
                document.getElementById('guardian_phone_no_div').style.color = "red";
                guardian_phone_no_error.innerHTML = "Phone number is required";
                guardian_phone_no.focus();
                return false;
			}

			//validate phone number
            if(guardian_phone_no.value.length != 10){
				guardian_phone_no.style.border = "1px solid red";
                document.getElementById('guardian_phone_no_div').style.color = "red";
                guardian_phone_no_error.innerHTML = "Invalid phone number";
                guardian_phone_no.focus();
                return false;
			}
			
			//validate phone number
            if(guardian_email.value == "" || guardian_email.value == null){
				guardian_email.style.border = "1px solid red";
                document.getElementById('guardian_email_div').style.color = "red";
                guardian_email_error.innerHTML = "Email address is required";
                guardian_email.focus();
                return false;
			}
			
			//validate id number
            if(guardian_id_no.value == "" || guardian_id_no.value == null){
				guardian_id_no.style.border = "1px solid red";
                document.getElementById('guardian_id_no_div').style.color = "red";
                guardian_id_no_error.innerHTML = "ID number is required";
                guardian_id_no.focus();
                return false;
			}

			//validate id number
            if(guardian_id_no.value.length != 8){
				guardian_id_no.style.border = "1px solid red";
                document.getElementById('guardian_id_no_div').style.color = "red";
                guardian_id_no_error.innerHTML = "Invalid ID number";
                guardian_id_no.focus();
                return false;
			}
			
			//validate id number
            if(guardian_occupation.value == "" || guardian_occupation.value == null){
				guardian_occupation.style.border = "1px solid red";
                document.getElementById('guardian_occupation_div').style.color = "red";
                guardian_occupation_error.innerHTML = "Occupation is required";
                guardian_occupation.focus();
                return false;
			}
			
			//validate id number
            if(guardian_occupation.value.length < 4){
				guardian_occupation.style.border = "1px solid red";
                document.getElementById('guardian_occupation_div').style.color = "red";
                guardian_occupation_error.innerHTML = "Invalid occupation";
                guardian_occupation.focus();
                return false;
            }
		}

	}
	else{            
		 alert("A student must have at least one parent or guardian");    
		 return false;
	}	
		



    
		
		/*
		if(regularExpression.test(empid.value)){
			return true;
		} else{
			emp_id.style.border = "1px solid red";
			document.getElementById('empid_div').style.color = "red";
			empid_error.textContent = "Invalid driver id";
			empid.focus();
			return false;
		}
		*/
		return true;
	}	
	
	//event handlers for father input fields
	function father_first_nameVerify(){
		if(father_first_name.value != null ){
			father_first_name.style.border = "1px solid #5e6e66";
			document.getElementById('father_first_name_div').style.color = "#5e6e66";
			father_first_name_error.innerHTML = "";
			return true;
		}
	}


	
	function father_middle_nameVerify(){
		if(father_middle_name.value != null || father_middle_name.value != ""){			
			father_middle_name.style.border = "1px solid #5e6e66";
			document.getElementById('father_middle_name_div').style.color = "#5e6e66";
			father_middle_name_error.innerHTML = "";
			return true;
		}
	}

	function father_last_nameVerify(){
		if(father_last_name.value != null || father_middle_name.value != ""){			
			father_last_name.style.border = "1px solid #5e6e66";
			document.getElementById('father_last_name_div').style.color = "#5e6e66";
			father_last_name_error.innerHTML = "";
			return true;
		}
	}

	function father_phone_noVerify(){
		if(father_phone_no.value != null || father_phone_no.value != ""){			
			father_phone_no.style.border = "1px solid #5e6e66";
			document.getElementById('father_phone_no_div').style.color = "#5e6e66";
			father_phone_no_error.innerHTML = "";
			return true;
		}
	}
	
	function father_emailVerify(){		
		if(father_email.value != null || father_email.value != ""){			
			father_email.style.border = "1px solid #5e6e66";
			document.getElementById('father_email_div').style.color = "#5e6e66";
			father_email_error.innerHTML = "";
			return true;
		}
	}

	function father_id_noVerify(){
		if(father_id_no.value != null || father_id_no.value != ""){			
			father_id_no.style.border = "1px solid #5e6e66";
			document.getElementById('father_id_no_div').style.color = "#5e6e66";
			father_id_no_error.innerHTML = "";
			return true;
		}
	}

	function father_occupationVerify(){
		if(father_occupation.value != null || father_occupation.value != ""){			
			father_occupation.style.border = "1px solid #5e6e66";
			document.getElementById('father_occupation_div').style.color = "#5e6e66";
			father_occupation_error.innerHTML = "";
			return true;
		}
	}

	//end of event handlers for father input fields


	//event handlers for the mother input fields
	function mother_first_nameVerify(){
		if(mother_first_name.value != null ){
			mother_first_name.style.border = "1px solid #5e6e66";
			document.getElementById('mother_first_name_div').style.color = "#5e6e66";
			mother_first_name_error.innerHTML = "";
			return true;
		}
	}


	
	function mother_middle_nameVerify(){
		if(mother_middle_name.value != null || mother_middle_name.value != ""){			
			mother_middle_name.style.border = "1px solid #5e6e66";
			document.getElementById('mother_middle_name_div').style.color = "#5e6e66";
			mother_middle_name_error.innerHTML = "";
			return true;
		}
	}

	function mother_last_nameVerify(){
		if(mother_last_name.value != null || mother_middle_name.value != ""){			
			mother_last_name.style.border = "1px solid #5e6e66";
			document.getElementById('mother_last_name_div').style.color = "#5e6e66";
			mother_last_name_error.innerHTML = "";
			return true;
		}
	}

	function mother_phone_noVerify(){
		if(mother_phone_no.value != null || mother_phone_no.value != ""){			
			mother_phone_no.style.border = "1px solid #5e6e66";
			document.getElementById('mother_phone_no_div').style.color = "#5e6e66";
			mother_phone_no_error.innerHTML = "";
			return true;
		}
	}
	
	function mother_emailVerify(){		
		if(mother_email.value != null || mother_email.value != ""){			
			mother_email.style.border = "1px solid #5e6e66";
			document.getElementById('mother_email_div').style.color = "#5e6e66";
			mother_email_error.innerHTML = "";
			return true;
		}
	}

	function mother_id_noVerify(){
		if(mother_id_no.value != null || mother_id_no.value != ""){			
			mother_id_no.style.border = "1px solid #5e6e66";
			document.getElementById('mother_id_no_div').style.color = "#5e6e66";
			mother_id_no_error.innerHTML = "";
			return true;
		}
	}

	function mother_occupationVerify(){
		if(mother_occupation.value != null || mother_occupation.value != ""){			
			mother_occupation.style.border = "1px solid #5e6e66";
			document.getElementById('mother_occupation_div').style.color = "#5e6e66";
			mother_occupation_error.innerHTML = "";
			return true;
		}
	}


	//end of event handlers for mother input fields


	//event handlers for the guardian input fields
	function guardian_first_nameVerify(){
		if(guardian_first_name.value != null ){
			guardian_first_name.style.border = "1px solid #5e6e66";
			document.getElementById('guardian_first_name_div').style.color = "#5e6e66";
			guardian_first_name_error.innerHTML = "";
			return true;
		}
	}


	
	function guardian_middle_nameVerify(){
		if(guardian_middle_name.value != null || guardian_middle_name.value != ""){			
			guardian_middle_name.style.border = "1px solid #5e6e66";
			document.getElementById('guardian_middle_name_div').style.color = "#5e6e66";
			guardian_middle_name_error.innerHTML = "";
			return true;
		}
	}

	function guardian_last_nameVerify(){
		if(guardian_last_name.value != null || guardian_middle_name.value != ""){			
			guardian_last_name.style.border = "1px solid #5e6e66";
			document.getElementById('guardian_last_name_div').style.color = "#5e6e66";
			guardian_last_name_error.innerHTML = "";
			return true;
		}
	}

	function guardian_phone_noVerify(){
		if(guardian_phone_no.value != null || guardian_phone_no.value != ""){			
			guardian_phone_no.style.border = "1px solid #5e6e66";
			document.getElementById('guardian_phone_no_div').style.color = "#5e6e66";
			guardian_phone_no_error.innerHTML = "";
			return true;
		}
	}
	
	function guardian_emailVerify(){		
		if(guardian_email.value != null || guardian_email.value != ""){			
			guardian_email.style.border = "1px solid #5e6e66";
			document.getElementById('guardian_email_div').style.color = "#5e6e66";
			guardian_email_error.innerHTML = "";
			return true;
		}
	}

	function guardian_id_noVerify(){
		if(guardian_id_no.value != null || guardian_id_no.value != ""){			
			guardian_id_no.style.border = "1px solid #5e6e66";
			document.getElementById('guardian_id_no_div').style.color = "#5e6e66";
			guardian_id_no_error.innerHTML = "";
			return true;
		}
	}

	function guardian_occupationVerify(){
		if(guardian_occupation.value != null || guardian_occupation.value != ""){			
			guardian_occupation.style.border = "1px solid #5e6e66";
			document.getElementById('mother_occupation_div').style.color = "#5e6e66";
			guardian_occupation_error.innerHTML = "";
			return true;
		}
	}
