//get the student input fields
var email = document.forms['login_form']['email'];
var password = document.forms['login_form']['password'];

//get the student details error fields
var email_error = document.getElementById('email_error');
var password_error = document.getElementById('password_error');

//add event listeners to student input fields
email.addEventListener('blur', emailVerify, true);
password.addEventListener('blur', passwordVerify, true);


function validateLogin(){

    //validate first name
    if(email.value == "" || email.value == null){
        email.style.border = "1px solid red";
        document.getElementById('email_div').style.color = "red";
        email_error.innerHTML = "Email address is required";
        email.focus();
        return false;
    }
    //validate middle name
    if(password.value == "" || password.value == null){
        password.style.border = "1px solid red";
        document.getElementById('password_div').style.color = "red";
        password_error.innerHTML = "Password is required";
        password.focus();
        return false;
    }

    return true;
}


//event handlers for the input fields
function emailVerify(){
    if(email.value != null || email.value != ""){			
        email.style.border = "1px solid #5e6e66";
        document.getElementById('email_div').style.color = "#5e6e66";
        email_error.innerHTML = "";
        return true;
    }
}
function passwordVerify(){
    if(password.value != null || password.value != ""){			
        password.style.border = "1px solid #5e6e66";
        document.getElementById('password_div').style.color = "#5e6e66";
        password_error.innerHTML = "";
        return true;
    }
}
