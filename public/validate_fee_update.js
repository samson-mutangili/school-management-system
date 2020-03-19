
//get input field
var total_fees = document.forms['fee_structure_update_form']['total_fees'];

//get the error fields
var total_fees_error = document.getElementById('total_fees_error');

//add event listener to the input field
total_fees.addEventListener('blur', total_feesVerify, true);

function validateUpdateFee(){
    //validate total fees
    if(total_fees.value == "" || total_fees.value == null){
        
    alert(total_fees.value);
        total_fees.style.border = "1px solid red";
        document.getElementById('total_fees_div').style.color = "red";
        total_fees_error.innerHTML = "Total fees is required";
        total_fees.focus();
        return false;
    }

    //validate total fees
    if(total_fees.value <= 0){
        total_fees.style.border = "1px solid red";
        document.getElementById('total_fees_div').style.color = "red";
        total_fees_error.innerHTML = "Total fees can not be a negative or zero value";
        total_fees.focus();
        return false;
    }

    //validate total fees
    if(total_fees.value < 100  || total_fees.value > 100000 ){
        total_fees.style.border = "1px solid red";
        document.getElementById('total_fees_div').style.color = "red";
        total_fees_error.innerHTML = "The total fees in unreasonable";
        total_fees.focus();
        return false;
    }

    return true;
}


function total_feesVerify(){
    if(total_fees.value != null || total_fees.value != ""){			
        total_fees.style.border = "1px solid #5e6e66";
        document.getElementById('total_fees_div').style.color = "#5e6e66";
        total_fees_error.innerHTML = "";
        return true;
    }
}