

//get the student input fields
var code = document.forms['code_form']['code'];


//get the student details error fields
var code_error = document.getElementById('code_error');

//add event listeners to student input fields
code.addEventListener('blur', codeVerify, true);

function validateCode(){


    //validate first name
    if(code.value == "" || code.value == null){
        code.style.border = "1px solid red";
        document.getElementById('code_div').style.color = "red";
        code_error.innerHTML = "Confirmation code is required";
        code.focus();
        return false;
    }

     //validate first name
     if(code.value <= 0 || code.value.length < 3){
        code.style.border = "1px solid red";
        document.getElementById('code_div').style.color = "red";
        code_error.innerHTML = "Invalid code";
        code.focus();
        return false;
    }

    return true;
}

function codeVerify(){
    if(code.value != null || code.value != ""){			
        code.style.border = "1px solid #5e6e66";
        document.getElementById('code_div').style.color = "#5e6e66";
        code_error.innerHTML = "";
        return true;
    }
}