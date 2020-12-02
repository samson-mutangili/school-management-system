
//get the student input fields
var email = document.forms['forgot_password_form']['email'];
var user_category = document.forms['forgot_password_form']['user_category'];
var email_regex = /^([a-z0-9\.-]+)@([a-z0-9-]+)\.([a-z]{2,8})(\.[a-z]{2,8})?$/;

//get the student details error fields
var email_error = document.getElementById('email_error');
var user_category_error = document.getElementById('user_category_error');

//add event listeners to student input fields
email.addEventListener('blur', emailVerify, true);
user_category.addEventListener('blur', user_categoryVerify, true);


function validateLogin(){

    if(user_category.value == "" || user_category.value == null){
        user_category_error.innerHTML = "Select user category";
        user_category_error.style.color="red";
        return false;
    }

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
    

    return true;
}


//event handlers for the input fields
function emailVerify(){
    if(email.value != null || email.value != ""){        
        email_error.innerHTML = "";
        return true;
    }
}
function user_categoryVerify(){
    if(user_category.value != null || user_category.value != ""){			
        user_category_error.innerHTML = "";
        return true;
    }
}
