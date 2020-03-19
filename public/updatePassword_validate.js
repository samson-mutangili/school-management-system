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
        password.style.border = "1px solid red";
        document.getElementById('password_div').style.color = "red";
        password_error.innerHTML = "Please enter new password";
        password.focus();
        return false;
    }

     //validate middle name
     if(password.value.length < 6 ){
        password.style.border = "1px solid red";
        document.getElementById('password_div').style.color = "red";
        password_error.innerHTML = "Password is too short. It should be at least six characters in length.";
        password.focus();
        return false;
    }


     //validate first name
     if(password_confirm.value == "" || password_confirm.value == null){
        password_confirm.style.border = "1px solid red";
        document.getElementById('password_confirm_div').style.color = "red";
        password_confirm_error.innerHTML = "Plese confirm password";
        password_confirm.focus();
        return false;
    }

    //validate first name
    if(password.value != password_confirm.value){
        password_confirm.style.border = "1px solid red";
        document.getElementById('password_confirm_div').style.color = "red";
        password_confirm_error.innerHTML = "The two passwords do not match";
        password_confirm.focus();
        return false;
    }

    return true;
}



function passwordVerify(){
    if(password.value != null || password.value != ""){			
        password.style.border = "1px solid #5e6e66";
        document.getElementById('password_div').style.color = "#5e6e66";
        password_error.innerHTML = "";
        return true;
    }
}

//event handlers for the input fields
function password_confirmVerify(){
    if(password_confirm.value != null || password_confirm.value != ""){			
        password_confirm.style.border = "1px solid #5e6e66";
        document.getElementById('password_confirm_div').style.color = "#5e6e66";
        password_confirm_error.innerHTML = "";
        return true;
    }
}
