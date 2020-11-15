//get the  input fields
var date_from = document.forms['report_filter_form']['date_from'];
var date_to = document.forms['report_filter_form']['date_to'];

var current_date = document.forms['report_filter_form']['current_date'];

var one_year = 1000*60*60*24*365;
var one_day = 1000*60*60*24;



//get the form details error fields
var date_from_error = document.getElementById('date_from_error');
var date_to_error = document.getElementById('date_to_error');




//add event listeners to student input fields
date_from.addEventListener('blur', date_fromVerify, true);
date_to.addEventListener('blur', date_toVerify, true);


function validateDates(){


    //validate  date from
    if(date_from.value == "" || date_from.value == null){
        date_from.style.border = "1px solid red";
        document.getElementById('date_from_div').style.color = "red";
        date_from_error.innerHTML = "Date from is required";
        date_from.focus();
        return false;
    }

    var current_date_time = new Date(current_date.value);
    var date_from_time =  new Date(date_from.value);
    var date_to_time = new Date(date_to.value);

    var date_from_inFuture = current_date_time.getTime() - date_from_time.getTime();
    var date_to_inFuture = current_date_time.getTime() - date_to_time.getTime();

    var date_diff = date_to_time.getTime() - date_from_time.getTime();

    
    if((date_from_inFuture/one_day) < -1){
        date_from.style.border = "1px solid red";
        document.getElementById('date_from_div').style.color = "red";
        date_from_error.innerHTML = "Date from can not be in future";
        date_from.focus();
        return false;
    }
     
   
    //validate date to 
    if(date_to.value == "" || date_to.value == null){
        date_to.style.border = "1px solid red";
        document.getElementById('date_to_div').style.color = "red";
        date_to_error.innerHTML = "Date to is required";
        date_to.focus();
        return false;
    }

    if((date_to_inFuture/one_day) < -1){
        date_to.style.border = "1px solid red";
        document.getElementById('date_to_div').style.color = "red";
        date_to_error.innerHTML = "Date to can not be in future";
        date_to.focus();
        return false;
    }

    if((date_diff/one_day) < 0){
        date_to.style.border = "1px solid red";
        document.getElementById('date_to_div').style.color = "red";
        date_to_error.innerHTML = "Date to can not be lower than date from";
        date_to.focus();
        return false;
    }



    return true;

}

//event handlers for the input fields
function date_fromVerify(){
    if(date_from.value != null || date_from.value != ""){			
        date_from.style.border = "1px solid #5e6e66";
        document.getElementById('date_from_div').style.color = "#5e6e66";
        date_from_error.innerHTML = "";
        return true;
    }
}
function date_toVerify(){
    if(date_to.value != null || date_to.value != ""){			
        date_to.style.border = "1px solid #5e6e66";
        document.getElementById('date_to_div').style.color = "#5e6e66";
        date_to_error.innerHTML = "";
        return true;
    }
}
