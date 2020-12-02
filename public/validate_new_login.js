
//get the student input fields
var email = document.forms['login_form']['email'];
var password = document.forms['login_form']['password'];
var email_regex = /^([a-z0-9\.-]+)@([a-z0-9-]+)\.([a-z]{2,8})(\.[a-z]{2,8})?$/;

//get the student details error fields
var email_error = document.getElementById('email_error');
var password_error = document.getElementById('password_error');

//add event listeners to student input fields
email.addEventListener('blur', emailVerify, true);
password.addEventListener('blur', passwordVerify, true);


function validateLogin(){

    //validate first name
    if(email.value == "" || email.value == null){
        email_error.innerHTML = "Email address is required";
       email_error.style.color="red";
        return false;
    }

    if(!(email_regex.test(email.value))){
        email_error.innerHTML = "Invalid email";
       email_error.style.color="red";
        return false;
    }
    //validate middle name
    if(password.value == "" || password.value == null){
        document.getElementById('password_div').style.color = "red";
        password_error.innerHTML = "Password is required";
        password_error.style.color="red";
        return false;
    }

    return true;
}


//event handlers for the input fields
function emailVerify(){
    if(email.value != null || email.value != ""){        
        email_error.innerHTML = "";
        return true;
    }
}
function passwordVerify(){
    if(password.value != null || password.value != ""){			
        password_error.innerHTML = "";
        return true;
    }
}
