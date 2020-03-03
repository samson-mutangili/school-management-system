//validate the marks entry 
	//get the marks input fields
	var subject1 = document.getElementById('subject1');
	var subject2 = document.getElementById('subject2');
	
	
	//get the marks error fields
	var subject1_error = document.getElementById('subject1_error');
	var subject2_error = document.getElementById('subject2_error');
	
	
	//add event listeners to marks input fields
	subject1.addEventListener('blur', subject1Verify, true);
	subject2.addEventListener('blur', subject2Verify, true);
	
	function validateMarks(){

		//validate first marks field
		if(subject1.value == "" || subject1.value == null){
			subject1.style.border = "1px solid red";
			document.getElementById('subject1_div').style.color = "red";
			subject1_error.innerHTML = "This field is required";
			subject1.focus();
			return false;
        }
        
        //validate first marks field
		if(subject1.value.length < 0 || subject1.value.length >100){
			subject1.style.border = "1px solid red";
			document.getElementById('subject1_div').style.color = "red";
			subject1_error.innerHTML = "Invalid marks";
			subject1.focus();
			return false;
		}
		
		        
        //validate second marks field
		if(subject2.value.length < 0 || subject2.value.length > 100){
			subject2.style.border = "1px solid red";
			document.getElementById('subject2_div').style.color = "red";
			subject2_error.innerHTML = "Invalid marks";
			subject2.focus();
			return false;
		}
		
		return true;
	}
	
	
	//event handlers for the input fields
	function subject1Verify(){
		if(subject1.value != null || subject1.value != ""){			
			subject1.style.border = "1px solid #5e6e66";
			document.getElementById('subject1_div').style.color = "#5e6e66";
			subject1_error.innerHTML = "";
			return true;
		}
	}
	function subject2Verify(){
		if(subject2.value != null || subject2.value != ""){			
			subject2.style.border = "1px solid #5e6e66";
			document.getElementById('subject2_div').style.color = "#5e6e66";
			subject2_error.innerHTML = "";
			return true;
		}
	}