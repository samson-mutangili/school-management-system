//get the student input fields
var first_name = document.forms['student_edit_form']['first_name'];
var middle_name = document.forms['student_edit_form']['middle_name'];
var last_name = document.forms['student_edit_form']['last_name'];
var admission_number = document.forms['student_edit_form']['admission_number'];
var date_of_birth = document.forms['student_edit_form']['date_of_birth'];
var birth_cert_no = document.forms['student_edit_form']['birth_cert_no'];
var kcpe_index_number = document.forms['student_edit_form']['kcpe_index_number'];
var residence = document.forms['student_edit_form']['residence'];

var current_date = document.forms['student_edit_form']['current_date'];

var one_year = 1000*60*60*24*365;


var gender = document.forms['student_edit_form']['gender'];
var religion = document.forms['student_edit_form']['religion'];
var nationality = document.forms['student_edit_form']['nationality'];
var image = document.forms['student_edit_form']['image'];

var name_regex = /^[a-zA-Z]{3,12}$/;
var phone_no_regex = /^(07)[0-9]{8}$/;
var email_regex = /^([a-z0-9\.-]+)@([a-z0-9-]+)\.([a-z]{2,8})(\.[a-z]{2,8})?$/;


//get the student details error fields
var first_name_error = document.getElementById('first_name_error');
var middle_name_error = document.getElementById('middle_name_error');
var last_name_error = document.getElementById('last_name_error');
var admission_number_error = document.getElementById('admission_number_error');
var date_of_birth_error = document.getElementById('date_of_birth_error');
var birth_cert_no_error = document.getElementById('birth_cert_no_error');
var kcpe_index_number_error = document.getElementById('kcpe_index_number_error');
var residence_error = document.getElementById('residence_error');


var gender_error = document.getElementById('gender_error');
var religion_error = document.getElementById('religion_error');
var nationality_error = document.getElementById('nationality_error');
var image_error = document.getElementById('image_error');




//add event listeners to student input fields
first_name.addEventListener('blur', first_nameVerify, true);
middle_name.addEventListener('blur', middle_nameVerify, true);
last_name.addEventListener('blur', last_nameVerify, true);
admission_number.addEventListener('blur', admission_numberVerify, true);
date_of_birth.addEventListener('blur', date_of_birthVerify, true);
birth_cert_no.addEventListener('blur', birth_cert_noVerify, true);
kcpe_index_number.addEventListener('blur', kcpe_index_numberVerify, true);
residence.addEventListener('blur', residenceVerify, true);

gender.addEventListener('blur', genderVerify, true);
religion.addEventListener('blur', religionVerify, true);
nationality.addEventListener('blur', nationalityVerify, true);

image.addEventListener('blur', imageVerify, true);


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
    
    if(!(name_regex.test(first_name.value))){
        first_name.style.border = "1px solid red";
        document.getElementById('first_name_div').style.color = "red";
        first_name_error.innerHTML = "Name can only contain letters that do not exceed 12";
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

    if(!(name_regex.test(middle_name.value))){
        middle_name.style.border = "1px solid red";
        document.getElementById('middle_name_div').style.color = "red";
        middle_name_error.innerHTML = "Name can only contain letters that do not exceed 12";
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

    if(!(name_regex.test(last_name.value))){
        last_name.style.border = "1px solid red";
        document.getElementById('last_name_div').style.color = "red";
        last_name_error.innerHTML = "Name can only contain letters that do not exceed 12";
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

    var current_date_time = new Date(current_date.value);
    var entered_date_time =  new Date(date_of_birth.value);

    var diff = current_date_time.getTime() - entered_date_time.getTime();
    var diff_years = diff/one_year;
    if(diff_years < 0){
        date_of_birth.style.border = "1px solid red";
        document.getElementById('date_of_birth_div').style.color = "red";
        date_of_birth_error.innerHTML = "Date of birth cannot be in future";
        date_of_birth.focus();
        return false;
    }

    if(diff_years < 11){
        date_of_birth.style.border = "1px solid red";
        document.getElementById('date_of_birth_div').style.color = "red";
        date_of_birth_error.innerHTML = "Child is too young. At least 11 years of age is accepted";
        date_of_birth.focus();
        return false;
    }

    
    if(diff_years > 40){
        date_of_birth.style.border = "1px solid red";
        document.getElementById('date_of_birth_div').style.color = "red";
        date_of_birth_error.innerHTML = "Whooa!! too old";
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
        birth_cert_no_error.innerHTML = "Invalid! Birth certificate number should be 7 digits ";
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
        kcpe_index_number_error.innerHTML = "Invalid! KCPE index number should be 9 digits";
        kcpe_index_number.focus();
        return false;
    }

    //validate kcpe index number
    if(residence.value == "" || residence.value == null){
        residence.style.border = "1px solid red";
        document.getElementById('residence_div').style.color = "red";
        residence_error.innerHTML = "Place of residence is required";
        residence.focus();
        return false;
    }

    //validate kcpe index number
    if(residence.value.length < 3 ){
        residence.style.border = "1px solid red";
        document.getElementById('residence_div').style.color = "red";
        residence_error.innerHTML = "Invalid place of residence";
        residence.focus();
        return false;
    }

    if(!(name_regex.test(residence.value))){
        residence.style.border = "1px solid red";
        document.getElementById('residence_div').style.color = "red";
        residence_error.innerHTML = "Only letters are allowed";
        residence.focus();
        return false;
    }




    //validate kcpe index number
    if(gender.value == "" || gender.value == null){
        gender.style.border = "1px solid red";
        document.getElementById('gender_div').style.color = "red";
        gender_error.innerHTML = "Please select your gender";
        gender.focus();
        return false;
    }

    //validate religion
    if(religion.value.length == "" || religion.value  == null){
        religion.style.border = "1px solid red";
        document.getElementById('religion_div').style.color = "red";
        religion_error.innerHTML = "Select your religion";
        religion.focus();
        return false;
    }

    //validate nationality
    if(nationality.value == "" || nationality.value == null){
        nationality.style.border = "1px solid red";
        document.getElementById('nationality_div').style.color = "red";
        nationality_error.innerHTML = "Select your nationality";
        nationality.focus();
        return false;
    }


    //validate image
    if(image.value != null){
        var formData = new FormData();
        var file = document.getElementById("image").files[0];
        formData.append("Filedata", file);
        var t = file.type.split('/').pop().toLowerCase();
        if (t != "jpeg" && t != "jpg" && t != "png"  && t != "gif") {
            image_error.innerHTML = "Please select a valid image. Allowed types are: .png, .jpeg, .jpg, .gif";
            image_error.style.color = "red";
            return false;
        }
        if (file.size > 2048000) {
            var upload_file = file.size / 1000000;
            image_error.innerHTML = "Maximum upload size is 2MB. Your file is : " +upload_file.toFixed(2)+"MB";
            image_error.style.color = "red";
            return false;
        }
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

function religionVerify(){
    if(religion.value != null || religion.value != ""){			
        religion.style.border = "1px solid #5e6e66";
        document.getElementById('religion_div').style.color = "#5e6e66";
        religion_error.innerHTML = "";
        return true;
    }
}

function genderVerify(){
    if(gender.value != null || gender.value != ""){			
        gender.style.border = "1px solid #5e6e66";
        document.getElementById('gender_div').style.color = "#5e6e66";
        gender_error.innerHTML = "";
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

function residenceVerify(){
    if(residence.value != null || residence.value != ""){			
        residence.style.border = "1px solid #5e6e66";
        document.getElementById('residence_div').style.color = "#5e6e66";
        residence_error.innerHTML = "";
        return true;
    }
}


function nationalityVerify(){
    if(nationality.value != null || nationality.value != ""){			
        nationality.style.border = "1px solid #5e6e66";
        document.getElementById('nationality_div').style.color = "#5e6e66";
        nationality_error.innerHTML = "";
        return true;
    }
}


function imageVerify(){
    if(image.value != null || image.value != ""){			
        image_error.innerHTML = "";
        return true;
    }
}
