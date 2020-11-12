var phone_no_regex = /^(07)[0-9]{8}$/;
var amount_regex = /^[0-9]{1,6}$/;

//get the fee input fields
var phone_no = document.forms['pay_fees_form']['phone_no'];
var amount = document.forms['pay_fees_form']['amount'];


//get the fee input details error fields
var phone_no_error = document.getElementById('phone_no_error');
var amount_error = document.getElementById('amount_error');


//add event listeners to fee input fields
phone_no.addEventListener('blur', phone_noVerify, true);
amount.addEventListener('blur', amountVerify, true);


function validateFeePayInputs(){
   
     
   

    //validate last name
    if(phone_no.value == "" || phone_no.value == null){
        phone_no.style.border = "1px solid red";
        document.getElementById('phone_no_div').style.color = "red";
        phone_no_error.innerHTML = "Phone number is required";
        phone_no.focus();
        return false;

    }

    if(!(phone_no_regex.test(phone_no.value))){
        phone_no.style.border = "1px solid red";
        document.getElementById('phone_no_div').style.color = "red";
        phone_no_error.innerHTML = "Invalid phone number. it can only start with 07 and have maximum of 10 digits";
        phone_no.focus();
        return false;
    }
    

  
    if(!(amount_regex.test(amount.value))){
        amount.style.border = "1px solid red";
        document.getElementById('amount_div').style.color = "red";
        amount_error.innerHTML = "Invalid amount. can contain maximum of 6 numerical digits";
        amount.focus();
        return false;
    }

    //validate last name
    if(amount.value == "" || amount.value == null){
        amount.style.border = "1px solid red";
        document.getElementById('amount_div').style.color = "red";
        amount_error.innerHTML = "Amount is required";
        amount.focus();
        return false;
    }

    

    //validate last name
    if(amount.value <= 0 || amount.value >100000 ){
        amount.style.border = "1px solid red";
        document.getElementById('amount_div').style.color = "red";
        amount_error.innerHTML = "Invalid amount.Amount cannot be below 5 and  Maximum of 100000 allowed!";
        amount.focus();
        return false;
    }

    

    return true;

}

//event handlers for the input fields


function phone_noVerify(){
    if(phone_no.value != null || phone_no.value != ""){			
        phone_no.style.border = "1px solid #5e6e66";
        document.getElementById('phone_no_div').style.color = "#5e6e66";
        phone_no_error.innerHTML = "";
        return true;
    }
}

function amountVerify(){
    if(amount.value != null || amount.value != ""){			
        amount.style.border = "1px solid #5e6e66";
        document.getElementById('amount_div').style.color = "#5e6e66";
        amount_error.innerHTML = "";
        return true;
    }
}




