//get the fee input fields

var bank_name = document.forms['fee_input_form']['bank_name'];
var branch_name = document.forms['fee_input_form']['branch_name'];
var ref_no = document.forms['fee_input_form']['ref_no'];
var date_paid = document.forms['fee_input_form']['date_paid'];
var amount = document.forms['fee_input_form']['amount'];
var current_date = document.forms['fee_input_form']['current_date'];

var one_year = 1000*60*60*24*365;
var one_day = 1000*60*60*24;


//get the fee input details error fields

var bank_name_error = document.getElementById('bank_name_error');
var branch_name_error = document.getElementById('branch_name_error');
var ref_no_error = document.getElementById('ref_no_error');
var date_paid_error = document.getElementById('date_paid_error');
var amount_error = document.getElementById('amount_error');


//add event listeners to fee input fields
bank_name.addEventListener('blur', bank_nameVerify, true);
branch_name.addEventListener('blur', branch_nameVerify, true);
ref_no.addEventListener('blur', ref_noVerify, true);
date_paid.addEventListener('blur', date_paidVerify, true);
amount.addEventListener('blur', amountVerify, true);


function validateFeeInput(){
   

    //validate bank branch_name
    if(bank_name.value == "" || bank_name.value == null){
        bank_name.style.border = "1px solid red";
        document.getElementById('bank_name_div').style.color = "red";
        bank_name_error.innerHTML = "Bank name is required";
        bank_name.focus();
        return false;
    }

    //validate bank branch_name
    if(branch_name.value == "" || branch_name.value == null){
        branch_name.style.border = "1px solid red";
        document.getElementById('branch_name_div').style.color = "red";
        branch_name_error.innerHTML = "Bank branch name is required";
        branch_name.focus();
        return false;
    }


     
    //validate middle name
    if(ref_no.value == "" || ref_no.value == null){
        ref_no.style.border = "1px solid red";
        document.getElementById('ref_no_div').style.color = "red";
        ref_no_error.innerHTML = "Reference number is required";
        ref_no.focus();
        return false;
    }

     //validate middle name
     if(ref_no.value.length < 10 || ref_no.value < 0){
        ref_no.style.border = "1px solid red";
        document.getElementById('ref_no_div').style.color = "red";
        ref_no_error.innerHTML = "Reference number is too short. Its invalid";
        ref_no.focus();
        return false;
    }

    //validate last name
    if(date_paid.value == "" || date_paid.value == null){
        date_paid.style.border = "1px solid red";
        document.getElementById('date_paid_div').style.color = "red";
        date_paid_error.innerHTML = "Date the fees was paid is required";
        date_paid.focus();
        return false;
    }

    var current_date_time = new Date(current_date.value);
    var date_paid_time =  new Date(date_paid.value);

    var date_from_inFuture = current_date_time.getTime() - date_paid_time.getTime();
    
   
    
    if((date_from_inFuture/one_day) < -1){
        date_paid.style.border = "1px solid red";
        document.getElementById('date_paid_div').style.color = "red";
        date_paid_error.innerHTML = "Date paid can not be in future";
        date_paid.focus();
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
        amount_error.innerHTML = "Invalid amount";
        amount.focus();
        return false;
    }

    

    return true;

}

//event handlers for the input fields
function branch_nameVerify(){
    if(bank_name.value != null || bank_name.value != ""){			
        bank_name.style.border = "1px solid #5e6e66";
        document.getElementById('bank_name_div').style.color = "#5e6e66";
        bank_name_error.innerHTML = "";
        return true;
    }
}

function branch_nameVerify(){
    if(branch_name.value != null || branch_name.value != ""){			
        branch_name.style.border = "1px solid #5e6e66";
        document.getElementById('branch_name_div').style.color = "#5e6e66";
        branch_name_error.innerHTML = "";
        return true;
    }
}
function ref_noVerify(){
    if(ref_no.value != null || ref_no.value != ""){			
        ref_no.style.border = "1px solid #5e6e66";
        document.getElementById('ref_no_div').style.color = "#5e6e66";
        ref_no_error.innerHTML = "";
        return true;
    }
}

function date_paidVerify(){
    if(date_paid.value != null || date_paid.value != ""){			
        date_paid.style.border = "1px solid #5e6e66";
        document.getElementById('date_paid_div').style.color = "#5e6e66";
        date_paid_error.innerHTML = "";
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




