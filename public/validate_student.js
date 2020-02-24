//get the student input fields
var first_name = document.forms['student_form']['first_name'];
var middle_name = document.forms['student_form']['middle_name'];
var last_name = document.forms['student_form']['last_name'];
var admission_number = document.forms['student_form']['admission_number'];
var date_of_birth = document.forms['student_form']['first_name'];
var birth_cert_no = document.forms['student_form']['birth_cert_no'];
var kcpe_index_number = document.forms['student_form']['kcpe_index_number'];
var student_class = document.forms['student_form']['student_class'];


//get the student details error fields
var first_name_error = document.getElementById('first_name_error');
var middle_name_error = document.getElementById('middle_name_error');
var last_name_error = document.getElementById('last_name_error');
var admission_number_error = document.getElementById('admission_number_error');
var date_of_birth_error = document.getElementById('date_of_birth_error');
var birth_cert_no_error = document.getElementById('birth_cert_no_error');
var kcpe_index_number_error = document.getElementById('kcpe_index_number_error');
var student_class_error = document.getElementById('student_class_error');




//add event listeners to student input fields
first_name.addEventListener('blur', first_nameVerify, true);
middle_name.addEventListener('blur', middle_nameVerify, true);
last_name.addEventListener('blur', last_nameVerify, true);
admission_number.addEventListener('blur', admission_numberVerify, true);
date_of_birth.addEventListener('blur', date_of_birthVerify, true);
birth_cert_no.addEventListener('blur', birth_cert_noVerify, true);
kcpe_index_number.addEventListener('blur', kcpe_index_numberVerify, true);
student_class.addEventListener('blur', student_classVerify, true);

function validateStudent(){

    //validate first name
    if(first_name.value == "" || first_name.value == null){
        first_name.style.border = "1px solid red";
        document.getElementById('first_name_div').style.color = "red";
        first_name_error.innerHTML = "First name is required";
        first_name.focus();
        return false;
    }
     //validate first name
     if(first_name.value.length < 3 ){
        first_name.style.border = "1px solid red";
        document.getElementById('first_name_div').style.color = "red";
        first_name_error.innerHTML = "Invalid name";
        first_name.focus();
        return false;
    }

    //validate middle name
    if(middle_name.value == "" || middle_name.value == null){
        middle_name.style.border = "1px solid red";
        document.getElementById('middle_name_div').style.color = "red";
        middle_name_error.innerHTML = "Middle name is required";
        middle_name.focus();
        return false;
    }

     //validate middle name
     if(middle_name.value.length < 3){
        middle_name.style.border = "1px solid red";
        document.getElementById('middle_name_div').style.color = "red";
        middle_name_error.innerHTML = "Invalid name";
        middle_name.focus();
        return false;
    }

    //validate last name
    if(last_name.value == "" || last_name.value == null){
        last_name.style.border = "1px solid red";
        document.getElementById('last_name_div').style.color = "red";
        last_name_error.innerHTML = "Last name is required";
        last_name.focus();
        return false;
    }

    //validate last name
    if(last_name.value.length < 3){
        last_name.style.border = "1px solid red";
        document.getElementById('last_name_div').style.color = "red";
        last_name_error.innerHTML = "Invalid name";
        last_name.focus();
        return false;
    }

    //validate last name
    if(admission_number.value == "" || admission_number.value == null){
        admission_number.style.border = "1px solid red";
        document.getElementById('admission_number_div').style.color = "red";
        admission_number_error.innerHTML = "Admission number is required";
        admission_number.focus();
        return false;
    }

    //validate last name
    if(admission_number.value.length < 3 || admission_number.value.length > 5 ||  admission_number.value < 1){
        admission_number.style.border = "1px solid red";
        document.getElementById('admission_number_div').style.color = "red";
        admission_number_error.innerHTML = "Invalid admission number";
        admission_number.focus();
        return false;
    }

    //validate date of birth
    if(date_of_birth.value == "" || date_of_birth.value == null){
        date_of_birth.style.border = "1px solid red";
        document.getElementById('date_of_birth_div').style.color = "red";
        date_of_birth_error.innerHTML = "Date of birth is required";
        date_of_birth.focus();
        return false;
    }


     //validate birth certificate number
     if(birth_cert_no.value == "" || birth_cert_no.value == null){
        birth_cert_no.style.border = "1px solid red";
        document.getElementById('birth_cert_no_div').style.color = "red";
        birth_cert_no_error.innerHTML = "Birth certificate number is required";
        birth_cert_no.focus();
        return false;
    }

    //validate birth certificate number
    if(birth_cert_no.value.length != 7 || birth_cert_no.value < 1){
        birth_cert_no.style.border = "1px solid red";
        document.getElementById('birth_cert_no_div').style.color = "red";
        birth_cert_no_error.innerHTML = "Invalid birth certificate number";
        birth_cert_no.focus();
        return false;
    }

     //validate kcpe index number
     if(kcpe_index_number.value == "" || kcpe_index_number.value == null){
        kcpe_index_number.style.border = "1px solid red";
        document.getElementById('kcpe_index_number_div').style.color = "red";
        kcpe_index_number_error.innerHTML = "KCPE index number is required";
        kcpe_index_number.focus();
        return false;
    }

    //validate kcpe index number
    if(kcpe_index_number.value.length != 9 || kcpe_index_number.value < 1){
        kcpe_index_number.style.border = "1px solid red";
        document.getElementById('kcpe_index_number_div').style.color = "red";
        kcpe_index_number_error.innerHTML = "Invalid KCPE index number";
        kcpe_index_number.focus();
        return false;
    }

    //validate student class
    if(student_class.value == "" || student_class.value == null){
        student_class.style.border = "1px solid red";
        document.getElementById('student_class_div').style.color = "red";
        student_class_error.innerHTML = "Student class is required";
        student_class.focus();
        return false;
    }

    return true;

}

//event handlers for the input fields
function first_nameVerify(){
    if(first_name.value != null || first_name.value != ""){			
        first_name.style.border = "1px solid #5e6e66";
        document.getElementById('first_name_div').style.color = "#5e6e66";
        first_name_error.innerHTML = "";
        return true;
    }
}
function middle_nameVerify(){
    if(middle_name.value != null || middle_name.value != ""){			
        middle_name.style.border = "1px solid #5e6e66";
        document.getElementById('middle_name_div').style.color = "#5e6e66";
        middle_name_error.innerHTML = "";
        return true;
    }
}

function last_nameVerify(){
    if(last_name.value != null || last_name.value != ""){			
        last_name.style.border = "1px solid #5e6e66";
        document.getElementById('last_name_div').style.color = "#5e6e66";
        last_name_error.innerHTML = "";
        return true;
    }
}

function admission_numberVerify(){
    if(admission_number.value != null || admission_number.value != ""){			
        admission_number.style.border = "1px solid #5e6e66";
        document.getElementById('admission_number_div').style.color = "#5e6e66";
        admission_number_error.innerHTML = "";
        return true;
    }
}

function date_of_birthVerify(){
    if(date_of_birth.value != null || date_of_birth.value != ""){			
        date_of_birth.style.border = "1px solid #5e6e66";
        document.getElementById('date_of_birth_div').style.color = "#5e6e66";
        date_of_birth_error.innerHTML = "";
        return true;
    }
}

function birth_cert_noVerify(){
    if(birth_cert_no.value != null || birth_cert_no.value != ""){			
        birth_cert_no.style.border = "1px solid #5e6e66";
        document.getElementById('birth_cert_no_div').style.color = "#5e6e66";
        birth_cert_no_error.innerHTML = "";
        return true;
    }
}

function kcpe_index_numberVerify(){
    if(kcpe_index_number.value != null || kcpe_index_number.value != ""){			
        kcpe_index_number.style.border = "1px solid #5e6e66";
        document.getElementById('kcpe_index_number_div').style.color = "#5e6e66";
        kcpe_index_number_error.innerHTML = "";
        return true;
    }
}


function student_classVerify(){
    if(student_class.value != null || student_class.value != ""){			
        student_class.style.border = "1px solid #5e6e66";
        document.getElementById('student_class_div').style.color = "#5e6e66";
        student_class_error.innerHTML = "";
        return true;
    }
}
