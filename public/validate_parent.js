
	var name_regex = /^[a-zA-Z]{3,12}$/;
	var phone_no_regex = /^(07)[0-9]{8}$/;
	var email_regex = /^([a-z0-9\.-]+)@([a-z0-9-]+)\.([a-z]{2,8})(\.[a-z]{2,8})?$/;
	var occupation_regex = /^[a-z\sA-Z]{3,20}$/;
	
	
    
    //get the guardian input fields
    var first_name = document.forms['parent_form']['first_name'];
	var middle_name = document.forms['parent_form']['middle_name'];
	var last_name = document.forms['parent_form']['last_name'];
    var phone_no = document.forms['parent_form']['phone_no'];
	var email = document.forms['parent_form']['email'];
	var id_no = document.forms['parent_form']['id_no'];   
	var occupation = document.forms['parent_form']['occupation'];
    
  
    //get the guardian details error fields
	var first_name_error = document.getElementById('first_name_error');
	var middle_name_error = document.getElementById('middle_name_error');
	var last_name_error = document.getElementById('last_name_error');
	var phone_no_error = document.getElementById('phone_no_error');
	var email_error = document.getElementById('email_error');
	var id_no_error = document.getElementById('id_no_error');
	var occupation_error = document.getElementById('occupation_error');
	
	
	
    //add event listeners to guardian input fields
	first_name.addEventListener('blur', first_nameVerify, true);	
	middle_name.addEventListener('blur', middle_nameVerify, true);
	last_name.addEventListener('blur', last_nameVerify, true);
    phone_no.addEventListener('blur', phone_noVerify, true);    
	email.addEventListener('blur', emailVerify, true);
	id_no.addEventListener('blur', id_noVerify, true);
	occupation.addEventListener('blur', occupationVerify, true);
	
	var regularExpression = /^([emp]{3})([0-9]{3, 4})$/;
	
	function validateParent(){
			
	   
		   //validate first name
            if(first_name.value == "" || first_name.value == null){
				first_name.style.border = "1px solid red";
                document.getElementById('first_name_div').style.color = "red";
                first_name_error.innerHTML = "First name is required";
                first_name.focus();
                return false;
			}

			//validate first name
            if(first_name.value.length < 3){
				first_name.style.border = "1px solid red";
                document.getElementById('first_name_div').style.color = "red";
                first_name_error.innerHTML = "Invalid name";
                first_name.focus();
                return false;
			}

			if(!(name_regex.test(first_name.value))){
				first_name.style.border = "1px solid red";
                document.getElementById('first_name_div').style.color = "red";
                first_name_error.innerHTML = "Name can only contain letters that do not exceed 12";
                first_name.focus();
                return false;
			}
			
			//validate middle name
            if(middle_name.value == "" || middle_name.value == null){
				middle_name.style.border = "1px solid red";
                document.getElementById('middle_name_div').style.color = "red";
                middle_name_error.innerHTML = "Middle name is required";
                middle_name.focus();
                return false;
			}

			//validate middle name
            if(middle_name.value.length < 3 ){
				middle_name.style.border = "1px solid red";
                document.getElementById('middle_name_div').style.color = "red";
                middle_name_error.innerHTML = "Invalid name";
                middle_name.focus();
                return false;
			}

			if(!(name_regex.test(middle_name.value))){
				middle_name.style.border = "1px solid red";
                document.getElementById('middle_name_div').style.color = "red";
                middle_name_error.innerHTML = "Name can only contain letters that do not exceed 12";
                middle_name.focus();
                return false;
			}
			
			//validate last name
            if(last_name.value == "" || middle_name.value == null){
				last_name.style.border = "1px solid red";
                document.getElementById('last_name_div').style.color = "red";
                last_name_error.innerHTML = "Last name is required";
                last_name.focus();
                return false;
			}

			//validate last name
            if(last_name.value.length < 3){
				last_name.style.border = "1px solid red";
                document.getElementById('mother_last_name_div').style.color = "red";
                last_name_error.innerHTML = "Invalid name";
                last_name.focus();
                return false;
			}
			
			if(!(name_regex.test(last_name.value))){
				last_name.style.border = "1px solid red";
                document.getElementById('mother_last_name_div').style.color = "red";
                last_name_error.innerHTML = "Name can only contain characters that do not exceed 12";
                last_name.focus();
                return false;
			}
			//validate phone number
            if(phone_no.value == "" || phone_no.value == null){
				phone_no.style.border = "1px solid red";
                document.getElementById('phone_no_div').style.color = "red";
                phone_no_error.innerHTML = "Phone number is required";
                phone_no.focus();
                return false;
			}

			//validate phone number
            if(phone_no.value.length != 10){
				phone_no.style.border = "1px solid red";
                document.getElementById('phone_no_div').style.color = "red";
                phone_no_error.innerHTML = "Invalid phone number";
                phone_no.focus();
                return false;
			}

			if(!(phone_no_regex.test(phone_no.value))){
				phone_no.style.border = "1px solid red";
                document.getElementById('phone_no_div').style.color = "red";
                phone_no_error.innerHTML = "Phone can only start with 07";
                phone_no.focus();
                return false;
			}
			
			//validate phone number
            if(email.value == "" || email.value == null){
				email.style.border = "1px solid red";
                document.getElementById('email_div').style.color = "red";
                email_error.innerHTML = "Email address is required";
                email.focus();
                return false;
			}
			
			if(!(email_regex.test(email.value))){
				email.style.border = "1px solid red";
                document.getElementById('email_div').style.color = "red";
                email_error.innerHTML = "Invalid email";
                email.focus();
                return false;
			}
			//validate id number
            if(id_no.value == "" || id_no.value == null){
				id_no.style.border = "1px solid red";
                document.getElementById('id_no_div').style.color = "red";
                id_no_error.innerHTML = "ID number is required";
                id_no.focus();
                return false;
			}

			//validate id number
            if(id_no.value.length != 8){
				id_no.style.border = "1px solid red";
                document.getElementById('id_no_div').style.color = "red";
                id_no_error.innerHTML = "Invalid ID number";
                id_no.focus();
                return false;
			}
			
			//validate id number
            if(occupation.value == "" || occupation.value == null){
				occupation.style.border = "1px solid red";
                document.getElementById('occupation_div').style.color = "red";
                occupation_error.innerHTML = "Occupation is required";
                occupation.focus();
                return false;
			}

			if(!(occupation_regex.test(occupation.value))){
				occupation.style.border = "1px solid red";
                document.getElementById('occupation_div').style.color = "red";
                occupation_error.innerHTML = "Occupation description can only contain letters that do not exceed 20";
                occupation.focus();
                return false;
			}
			
			//validate id number
            if(occupation.value.length < 4){
				occupation.style.border = "1px solid red";
                document.getElementById('occupation_div').style.color = "red";
                occupation_error.innerHTML = "Invalid occupation";
                occupation.focus();
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
	

	//event handlers for the guardian input fields
	function first_nameVerify(){
		if(first_name.value != null ){
			first_name.style.border = "1px solid #5e6e66";
			document.getElementById('first_name_div').style.color = "#5e6e66";
			first_name_error.innerHTML = "";
			return true;
		}
	}


	
	function middle_nameVerify(){
		if(middle_name.value != null || middle_name.value != ""){			
			middle_name.style.border = "1px solid #5e6e66";
			document.getElementById('middle_name_div').style.color = "#5e6e66";
			middle_name_error.innerHTML = "";
			return true;
		}
	}

	function last_nameVerify(){
		if(last_name.value != null || middle_name.value != ""){			
			last_name.style.border = "1px solid #5e6e66";
			document.getElementById('last_name_div').style.color = "#5e6e66";
			last_name_error.innerHTML = "";
			return true;
		}
	}

	function phone_noVerify(){
		if(phone_no.value != null || phone_no.value != ""){			
			phone_no.style.border = "1px solid #5e6e66";
			document.getElementById('phone_no_div').style.color = "#5e6e66";
			phone_no_error.innerHTML = "";
			return true;
		}
	}
	
	function emailVerify(){		
		if(email.value != null || email.value != ""){			
			email.style.border = "1px solid #5e6e66";
			document.getElementById('email_div').style.color = "#5e6e66";
			email_error.innerHTML = "";
			return true;
		}
	}

	function id_noVerify(){
		if(id_no.value != null || id_no.value != ""){			
			id_no.style.border = "1px solid #5e6e66";
			document.getElementById('id_no_div').style.color = "#5e6e66";
			id_no_error.innerHTML = "";
			return true;
		}
	}

	function occupationVerify(){
		if(occupation.value != null || occupation.value != ""){			
			occupation.style.border = "1px solid #5e6e66";
			document.getElementById('mother_occupation_div').style.color = "#5e6e66";
			occupation_error.innerHTML = "";
			return true;
		}
	}
