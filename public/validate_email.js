
	var name_regex = /^[a-zA-Z0-9]{3,25}$/;	
	
    
    //get the guardian input fields
    var subject = document.forms['email_form']['subject'];
	var message_body = document.forms['email_form']['message_body'];
    
  
    //get the guardian details error fields
	var subject_error = document.getElementById('subject_error');
	var message_body_error = document.getElementById('message_body_error');
	
	
	
    //add event listeners to guardian input fields
	subject.addEventListener('blur', subjectVerify, true);	
	message_body.addEventListener('blur', message_bodyVerify, true);
	
	
	function validateEmail(){
			
	   
		   //validate first name
            if(subject.value == "" || subject.value == null){
				subject.style.border = "1px solid red";
                document.getElementById('subject_div').style.color = "red";
                subject_error.innerHTML = "Subject is required";
                subject.focus();
                return false;
			}

			//validate first name
            if(subject.value.length < 3){
				subject.style.border = "1px solid red";
                document.getElementById('subject_div').style.color = "red";
                subject_error.innerHTML = "Subject is too short";
                subject.focus();
                return false;
			}

			if(!(name_regex.test(subject.value))){
				subject.style.border = "1px solid red";
                document.getElementById('subject_div').style.color = "red";
                subject_error.innerHTML = "Subject can only contain alphanumeric characters only that do not exceed 25";
                subject.focus();
                return false;
			}
			
			//validate middle name
            if(message_body.value == "" || message_body.value == null){
				message_body.style.border = "1px solid red";
                document.getElementById('message_body_div').style.color = "red";
                message_body_error.innerHTML = "message body is required";
                message_body.focus();
                return false;
			}

			//validate middle name
            if(message_body.value.length < 3 ){
				message_body.style.border = "1px solid red";
                document.getElementById('message_body_div').style.color = "red";
                message_body_error.innerHTML = "Message body is too short";
                message_body.focus();
                return false;
			}

			
		return true;
	}	
	

	//event handlers for the guardian input fields
	function subjectVerify(){
		if(subject.value != null ){
			subject.style.border = "1px solid #5e6e66";
			document.getElementById('subject_div').style.color = "#5e6e66";
			subject_error.innerHTML = "";
			return true;
		}
	}


	
	function message_bodyVerify(){
		if(message_body.value != null || message_body.value != ""){			
			message_body.style.border = "1px solid #5e6e66";
			document.getElementById('message_body_div').style.color = "#5e6e66";
			message_body_error.innerHTML = "";
			return true;
		}
	}

	