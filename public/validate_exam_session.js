//get the  input fields
var exam_start_date = document.forms['exam_session_form']['exam_start_date'];
var exam_end_date = document.forms['exam_session_form']['exam_end_date'];
var exam_type = document.forms['exam_session_form']['exam_type'];

var current_date = document.forms['exam_session_form']['current_date'];

var one_day = 1000*60*60*24;



//get the form details error fields
var exam_start_date_error = document.getElementById('exam_start_date_error');
var exam_end_date_error = document.getElementById('exam_end_date_error');
var exam_type_error = document.getElementById('exam_type_error');




//add event listeners to student input fields
exam_start_date.addEventListener('blur', exam_start_dateVerify, true);
exam_end_date.addEventListener('blur', exam_end_dateVerify, true);
exam_type.addEventListener('blur', exam_typeVerify, true);


function validateExamDates(){


    if(exam_type.value == "" || exam_type.value == null){
        exam_type.style.border = "1px solid red";
        document.getElementById('exam_type_div').style.color = "red";
        exam_type_error.innerHTML = "Exam type is required";
        exam_type.focus();
        return false;
    }
    //validate  date from
    if(exam_start_date.value == "" || exam_start_date.value == null){
        exam_start_date.style.border = "1px solid red";
        document.getElementById('exam_start_date_div').style.color = "red";
        exam_start_date_error.innerHTML = "Start date is required";
        exam_start_date.focus();
        return false;
    }

    var current_date_time = new Date(current_date.value);
    var exam_start_date_time =  new Date(exam_start_date.value);
    var exam_end_date_time = new Date(exam_end_date.value);

    var date_diff = exam_end_date_time.getTime() - exam_start_date_time.getTime();
    var exam_start_dateinPast = exam_start_date_time.getTime() - current_date_time.getTime();
    var exam_end_date_inPast = exam_end_date_time.getTime() - current_date_time.getTime();
     
    if((exam_start_dateinPast/one_day) < 0){
        exam_start_date.style.border = "1px solid red";
        document.getElementById('exam_start_date_div').style.color = "red";
        exam_start_date_error.innerHTML = "Start date cannot be in past";
        exam_start_date.focus();
        return false;
    }
   
    //validate date to 
    if(exam_end_date.value == "" || exam_end_date.value == null){
        exam_end_date.style.border = "1px solid red";
        document.getElementById('exam_end_date_div').style.color = "red";
        exam_end_date_error.innerHTML = "End date is required";
        exam_end_date.focus();
        return false;
    }

    if((exam_end_date_inPast/one_day) < 0){
        exam_end_date.style.border = "1px solid red";
        document.getElementById('exam_end_date_div').style.color = "red";
        exam_end_date_error.innerHTML = "End date cannot be in past";
        exam_end_date.focus();
        return false;
    }

    if((date_diff/one_day) < 0){
        exam_end_date.style.border = "1px solid red";
        document.getElementById('exam_end_date_div').style.color = "red";
        exam_end_date_error.innerHTML = "start date to can not be lower than end date";
        exam_end_date.focus();
        return false;
    }



    return true;

}

//event handlers for the input fields
function exam_typeVerify(){
    if(exam_type.value != null || exam_type.value != ""){			
        exam_type.style.border = "1px solid #5e6e66";
        document.getElementById('exam_type_div').style.color = "#5e6e66";
        exam_type_error.innerHTML = "";
        return true;
    }
}

function exam_start_dateVerify(){
    if(exam_start_date.value != null || exam_start_date.value != ""){			
        exam_start_date.style.border = "1px solid #5e6e66";
        document.getElementById('exam_start_date_div').style.color = "#5e6e66";
        exam_start_date_error.innerHTML = "";
        return true;
    }
}
function exam_end_dateVerify(){
    if(exam_end_date.value != null || exam_end_date.value != ""){			
        exam_end_date.style.border = "1px solid #5e6e66";
        document.getElementById('exam_end_date_div').style.color = "#5e6e66";
        exam_end_date_error.innerHTML = "";
        return true;
    }
}
