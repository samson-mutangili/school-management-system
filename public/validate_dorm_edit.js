//get the  input fields
var edit_dorm_name = document.forms['dormitory_edit_form']['edit_dorm_name'];
var edit_dorm_status = document.forms['dormitory_edit_form']['edit_dorm_status'];


var name_regex = /^[a-zA-Z]{3,12}$/;


//get the form details error fields
var edit_dorm_name_error = document.getElementById('edit_dorm_name_error');
var edit_dorm_status_error = document.getElementById('edit_dorm_status_error');




//add event listeners to student input fields
edit_dorm_name.addEventListener('blur', edit_dorm_nameVerify, true);
edit_dorm_status.addEventListener('blur', edit_dorm_statusVerify, true);


function validateDormEdit(){


    //validate  name
    if(edit_dorm_name.value == "" || edit_dorm_name.value == null){
        edit_dorm_name.style.border = "1px solid red";
        document.getElementById('edit_dorm_name_div').style.color = "red";
        edit_dorm_name_error.innerHTML = "Name is required";
        edit_dorm_name.focus();
        return false;
    }
     
    if(!(name_regex.test(edit_dorm_name.value))){
        edit_dorm_name.style.border = "1px solid red";
        document.getElementById('edit_dorm_name_div').style.color = "red";
        edit_dorm_name_error.innerHTML = "Name can only contain letters that are between 3 and 12";
        edit_dorm_name.focus();
        return false;
    }
    //validate middle name
    if(edit_dorm_status.value == "" || edit_dorm_status.value == null){
        edit_dorm_status.style.border = "1px solid red";
        document.getElementById('edit_dorm_status_div').style.color = "red";
        edit_dorm_status_error.innerHTML = "Status in required";
        edit_dorm_status.focus();
        return false;
    }


    return true;

}

//event handlers for the input fields
function edit_dorm_nameVerify(){
    if(edit_dorm_name.value != null || edit_dorm_name.value != ""){			
        edit_dorm_name.style.border = "1px solid #5e6e66";
        document.getElementById('edit_dorm_name_div').style.color = "#5e6e66";
        edit_dorm_name_error.innerHTML = "";
        return true;
    }
}
function edit_dorm_statusVerify(){
    if(edit_dorm_status.value != null || edit_dorm_status.value != ""){			
        edit_dorm_status.style.border = "1px solid #5e6e66";
        document.getElementById('edit_dorm_status_div').style.color = "#5e6e66";
        edit_dorm_status_error.innerHTML = "";
        return true;
    }
}
