//get the fee structure  input fields
var class_name = document.forms['fee_structure_form']['class_name'];
var term = document.forms['fee_structure_form']['term'];
var total_fees = document.forms['fee_structure_form']['total_fees'];

//get the fee structure error fields
var class_name_error = document.getElementById('class_name_error');
var term_error = document.getElementById('term_error');
var total_fees_error = document.getElementById('total_fees_error');

//add event listeners to fee structure  input fields
class_name.addEventListener('blur', class_nameVerify, true);
term.addEventListener('blur', termVerify, true);
total_fees.addEventListener('blur', total_feesVerify, true);


function validateFeeStructure(){

    //validate class name
    if(class_name.value == "" || class_name.value == null){
        class_name.style.border = "1px solid red";
        document.getElementById('class_name_div').style.color = "red";
        class_name_error.innerHTML = "Class name is required";
        class_name.focus();
        return false;
    }
    //validate term
    if(term.value == "" || term.value == null){
        term.style.border = "1px solid red";
        document.getElementById('term_div').style.color = "red";
        term_error.innerHTML = "Term is required";
        term.focus();
        return false;
    }
    //validate total fees
    if(total_fees.value == "" || total_fees.value == null){
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


//event handlers for the input fields
function class_nameVerify(){
    if(class_name.value != null || class_name.value != ""){			
        class_name.style.border = "1px solid #5e6e66";
        document.getElementById('class_name_div').style.color = "#5e6e66";
        class_name_error.innerHTML = "";
        return true;
    }
}
function termVerify(){
    if(term.value != null || term.value != ""){			
        term.style.border = "1px solid #5e6e66";
        document.getElementById('term_div').style.color = "#5e6e66";
        term_error.innerHTML = "";
        return true;
    }
}

function total_feesVerify(){
    if(total_fees.value != null || total_fees.value != ""){			
        total_fees.style.border = "1px solid #5e6e66";
        document.getElementById('total_fees_div').style.color = "#5e6e66";
        total_fees_error.innerHTML = "";
        return true;
    }
}
