//get the student input fields
var password = document.forms['update_password_form']['password'];
var password_confirm = document.forms['update_password_form']['password_confirm'];

//get the student details error fields
var password_error = document.getElementById('password_error');
var password_confirm_error = document.getElementById('password_confirm_error');

//add event listeners to student input fields
password.addEventListener('blur', passwordVerify, true);
password_confirm.addEventListener('blur', password_confirmVerify, true);


function validateNewPassword(){

   
    //validate middle name
    if(password.value == "" || password.value == null){
        password_error.innerHTML = "Please enter new password";
        password_error.style.color ="red";
        return false;
    }

     //validate middle name
     if(password.value.length < 6 ){
        password_error.innerHTML = "Password is too short. It should be at least six characters in length.";
        password_error.style.color = "red";
        return false;
    }


     //validate first name
     if(password_confirm.value == "" || password_confirm.value == null){
        password_confirm_error.innerHTML = "Plese confirm password";
        password_confirm_error.style.color = "red";
        return false;
    }

    //validate first name
    if(password.value != password_confirm.value){
        password_confirm_error.innerHTML = "The two passwords do not match";
        password_confirm_error.style.color = "red";
        return false;
    }

    return true;
}



function passwordVerify(){
    if(password.value != null || password.value != ""){			
        password_error.innerHTML = "";
        return true;
    }
}

//event handlers for the input fields
function password_confirmVerify(){
    if(password_confirm.value != null || password_confirm.value != ""){			    
        password_confirm_error.innerHTML = "";
        return true;
    }
}
