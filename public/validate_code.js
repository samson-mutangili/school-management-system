

//get the student input fields
var code = document.forms['code_form']['code'];


//get the student details error fields
var code_error = document.getElementById('code_error');

//add event listeners to student input fields
code.addEventListener('blur', codeVerify, true);

function validateCode(){


    //validate first name
    if(code.value == "" || code.value == null){
        code_error.innerHTML = "Confirmation code is required";
        code_error.style.color = "red";
        code.focus();
        return false;
    }

     //validate first name
     if(code.value <= 0 || code.value.length < 3){
        code_error.innerHTML = "Code is too short";
        code_error.style.color="red";
        return false;
    }

    return true;
}

function codeVerify(){
    if(code.value != null || code.value != ""){			
        code_error.innerHTML = "";
        return true;
    }
}