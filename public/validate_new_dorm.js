//get the  input fields
var dorm_name = document.forms['dormitory_form']['dorm_name'];
var dorm_status = document.forms['dormitory_form']['dorm_status'];


var name_regex = /^[a-zA-Z]{3,12}$/;


//get the form details error fields
var dorm_name_error = document.getElementById('dorm_name_error');
var dorm_status_error = document.getElementById('dorm_status_error');




//add event listeners to student input fields
dorm_name.addEventListener('blur', dorm_nameVerify, true);
dorm_status.addEventListener('blur', dorm_statusVerify, true);


function validateDorm(){


    //validate  name
    if(dorm_name.value == "" || dorm_name.value == null){
        dorm_name.style.border = "1px solid red";
        document.getElementById('dorm_name_div').style.color = "red";
        dorm_name_error.innerHTML = "Name is required";
        dorm_name.focus();
        return false;
    }
     
    if(!(name_regex.test(dorm_name.value))){
        dorm_name.style.border = "1px solid red";
        document.getElementById('dorm_name_div').style.color = "red";
        dorm_name_error.innerHTML = "Name can only contain letters that are between 3 and 12";
        dorm_name.focus();
        return false;
    }
    //validate middle name
    if(dorm_status.value == "" || dorm_status.value == null){
        dorm_status.style.border = "1px solid red";
        document.getElementById('dorm_status_div').style.color = "red";
        dorm_status_error.innerHTML = "Status in required";
        dorm_status.focus();
        return false;
    }


    return true;

}

//event handlers for the input fields
function dorm_nameVerify(){
    if(dorm_name.value != null || dorm_name.value != ""){			
        dorm_name.style.border = "1px solid #5e6e66";
        document.getElementById('dorm_name_div').style.color = "#5e6e66";
        dorm_name_error.innerHTML = "";
        return true;
    }
}
function dorm_statusVerify(){
    if(dorm_status.value != null || dorm_status.value != ""){			
        dorm_status.style.border = "1px solid #5e6e66";
        document.getElementById('dorm_status_div').style.color = "#5e6e66";
        dorm_status_error.innerHTML = "";
        return true;
    }
}
