//get the change passwords input fields
var old_password = document.forms['change_password_form']['old_password'];
var new_password = document.forms['change_password_form']['new_password'];
var confirm_new_password = document.forms['change_password_form']['confirm_new_password'];

//get the change passwordserror fields
var old_password_error = document.getElementById('old_password_error');
var new_password_error = document.getElementById('new_password_error');
var confirm_new_password_error = document.getElementById('confirm_new_password_error');

//add event listeners to change passwords input fields
old_password.addEventListener('blur', old_passwordVerify, true);
new_password.addEventListener('blur', new_passwordVerify, true);
confirm_new_password.addEventListener('blur', confirm_new_passwordVerify, true);


function validatePasswords(){

    //validate old password
    if(old_password.value == "" || old_password.value == null){
        old_password.style.border = "1px solid red";
        document.getElementById('old_password_div').style.color = "red";
        old_password_error.innerHTML = "Old password is required";
        old_password.focus();
        return false;
    }
    //validate new_password
    if(new_password.value == "" || new_password.value == null){
        new_password.style.border = "1px solid red";
        document.getElementById('new_password_div').style.color = "red";
        new_password_error.innerHTML = "New password is required";
        new_password.focus();
        return false;
    }
    //validate confirming new password
    if(confirm_new_password.value == "" || confirm_new_password.value == null){
        confirm_new_password.style.border = "1px solid red";
        document.getElementById('confirm_new_password_div').style.color = "red";
        confirm_new_password_error.innerHTML = "Confirm new password";
        confirm_new_password.focus();
        return false;
    }

    //ensure the two passwords match
    if(confirm_new_password.value != new_password.value){
        confirm_new_password.style.border = "1px solid red";
        document.getElementById('confirm_new_password_div').style.color = "red";
        confirm_new_password_error.innerHTML = "The two passwords do not match";
        confirm_new_password.focus();
        return false;
    }



    return true;
}


//event handlers for the input fields
function old_passwordVerify(){
    if(old_password.value != null || old_password.value != ""){			
        old_password.style.border = "1px solid #5e6e66";
        document.getElementById('old_password_div').style.color = "#5e6e66";
        old_password_error.innerHTML = "";
        return true;
    }
}
function new_passwordVerify(){
    if(new_password.value != null || new_password.value != ""){			
        new_password.style.border = "1px solid #5e6e66";
        document.getElementById('new_password_div').style.color = "#5e6e66";
        new_password_error.innerHTML = "";
        return true;
    }
}

function confirm_new_passwordVerify(){
    if(confirm_new_password.value != null || confirm_new_password.value != ""){			
        confirm_new_password.style.border = "1px solid #5e6e66";
        document.getElementById('confirm_new_password_div').style.color = "#5e6e66";
        confirm_new_password_error.innerHTML = "";
        return true;
    }
}
