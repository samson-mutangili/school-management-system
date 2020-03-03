$(document).ready(function(){
	
	$(document.body).on("click", "tr[data-href]", function(){
		window.location.href = this.dataset.href;
	});

	// $('#staff_table').DataTable({
	// 	processing: true,
	// 	serverSide: true,
	// 	ajax: {
	// 		url: "{{ route('get.users') }}",
	// 	},
	// 	columns: [
	// 		{
	// 			data: 'first_name',
	// 			name: 'first_name',	
	// 		}, 
	// 		{
	// 			data: 'middle_name',
	// 			name: 'middle_name'
	// 		}
	// 	]
	// });


});

	//get the student input fields
	var role = document.forms['role_form']['role'];

	//get the student details error fields
	var role_error = document.getElementById('role_error');
	
	//add event listeners to student input fields
	role.addEventListener('blur', roleVerify, true);
	
	function validateRole(){
	
		//validate first name
		if(role.value == "" || role.value == null){
			role.style.border = "1px solid red";
			document.getElementById('role_div').style.color = "red";
			role_error.innerHTML = "Teacher role is required!!";
			role.focus();
			return false;
		}
		
		return true;
	}
	
	//event handlers for the input fields
	function roleVerify(){
		if(role.value != null || role.value != ""){			
			role.style.border = "1px solid #5e6e66";
			document.getElementById('role_div').style.color = "#5e6e66";
			role_error.innerHTML = "";
			return true;
		}
	}


	//validate the responsibility form
	
	//get the student input fields
var responsibility = document.forms['responsibility_form']['responsibility'];
var class_incharge = document.forms['responsibility_form']['class_incharge'];


//get the student details error fields
var responsibility_error = document.getElementById('responsibility_error');
var class_incharge_error = document.getElementById('class_incharge_error');


//add event listeners to student input fields
responsibility.addEventListener('blur', responsibilityVerify, true);
class_incharge.addEventListener('blur', class_inchargeVerify, true);

function validateResponsibility(){

	//validate first name
    if(responsibility.value == "" || responsibility.value == null){
        responsibility.style.border = "1px solid red";
        document.getElementById('responsibility_div').style.color = "red";
        responsibility_error.innerHTML = "Responsibility type is required";
        responsibility.focus();
        return false;
	}
	
	//validate middle name
    if(class_incharge.value == "" || class_incharge.value == null){
        class_incharge.style.border = "1px solid red";
        document.getElementById('class_incharge_div').style.color = "red";
        class_incharge_error.innerHTML = "Class is required";
        class_incharge.focus();
        return false;
	}
	
	return true;
}


//event handlers for the input fields
function responsibilityVerify(){
    if(responsibility.value != null || responsibility.value != ""){			
        responsibility.style.border = "1px solid #5e6e66";
        document.getElementById('responsibility_div').style.color = "#5e6e66";
        responsibility_error.innerHTML = "";
        return true;
    }
}
function class_inchargeVerify(){
    if(class_incharge.value != null || class_incharge.value != ""){			
        class_incharge.style.border = "1px solid #5e6e66";
        document.getElementById('class_incharge_div').style.color = "#5e6e66";
        class_incharge_error.innerHTML = "";
        return true;
    }
}


//check if the selected subjects are already taught by another teacher
$(document).ready(function(){

	
	$('#class_name').blur(function(){		
			var class_name = $(this).val();
			var subject = $('#subject').val();

			//ajax request for a controller function
			$.ajax({
				url:"checkTeachingSubject",
				method:"POST",
				data:{class_name:class_name},
				data:{subject:subject},
				dataType:"text",
				success:function(html){
					$('#availability').html(html);
				}
			});
	});

});



	//validate the teaching classes  form
	
	//get the teaching classes input fields
	var class_name = document.forms['teachingClasses_form']['class_name'];
	var subject = document.forms['teachingClasses_form']['subject'];
	
	
	//get the teaching classes details error fields
	var class_name_error = document.getElementById('class_name_error');
	var subject_error = document.getElementById('subject_error');
	
	
	//add event listeners to teaching classes  input fields
	class_name.addEventListener('blur', class_nameVerify, true);
	subject.addEventListener('blur', subjectVerify, true);
	
	function validateTeacherClasses(){
	
		//validate first field, class name
		if(class_name.value == "" || class_name.value == null){
			class_name.style.border = "1px solid red";
			document.getElementById('class_name_div').style.color = "red";
			class_name_error.innerHTML = "Class name is required";
			class_name.focus();
			return false;
		}
		
		//validate second field, subject
		if(subject.value == "" || subject.value == null){
			subject.style.border = "1px solid red";
			document.getElementById('subject_div').style.color = "red";
			subject_error.innerHTML = "Subject name is required";
			subject.focus();
			return false;
		}
		
		return true;
	}
	
	
	//event handlers for the input fields
	function class_nameVerify(){
		if(class_name.value != null || class_name.value != ""){			
			class_name.style.border = "1px solid #5e6e66";
			document.getElementById('class_name_div').style.color = "#5e6e66";
			class_name_error.innerHTML = "";
			return true;
		}
	}
	function subjectVerify(){
		if(subject.value != null || subject.value != ""){			
			subject.style.border = "1px solid #5e6e66";
			document.getElementById('subject_div').style.color = "#5e6e66";
			subject_error.innerHTML = "";
			return true;
		}
	}
	

	