//get the student input fields
var teacher_first_name = document.forms['teacher_form']['teacher_first_name'];
var teacher_middle_name = document.forms['teacher_form']['teacher_middle_name'];
var teacher_last_name = document.forms['teacher_form']['teacher_last_name'];
var teacher_phone_no = document.forms['teacher_form']['teacher_phone_no'];
var teacher_email = document.forms['teacher_form']['teacher_email'];
var tsc_no = document.forms['teacher_form']['tsc_no'];
var teacher_id_no = document.forms['teacher_form']['teacher_id_no'];
var subject_1 = document.forms['teacher_form']['subject_1'];
var subject_2 = document.forms['teacher_form']['subject_2'];

var name_regex = /^[a-zA-Z]{3,12}$/;
var phone_no_regex = /^(07)[0-9]{8}$/;
var email_regex = /^([a-z0-9\.-]+)@([a-z0-9-]+)\.([a-z]{2,8})(\.[a-z]{2,8})?$/;

//get the student details error fields
var teacher_first_name_error = document.getElementById('teacher_first_name_error');
var teacher_middle_name_error = document.getElementById('teacher_middle_name_error');
var teacher_last_name_error = document.getElementById('teacher_last_name_error');
var teacher_phone_no_error = document.getElementById('teacher_phone_no_error');
var teacher_email_error = document.getElementById('teacher_email_error');
var tsc_no_error = document.getElementById('tsc_no_error');
var teacher_id_no_error = document.getElementById('teacher_id_no_error');
var subject_1_error = document.getElementById('subject_1_error');
var subject_2_error = document.getElementById('subject_2_error');




//add event listeners to student input fields
teacher_first_name.addEventListener('blur', teacher_first_nameVerify, true);
teacher_middle_name.addEventListener('blur', teacher_middle_nameVerify, true);
teacher_last_name.addEventListener('blur', teacher_last_nameVerify, true);
teacher_phone_no.addEventListener('blur', teacher_phone_noVerify, true);
teacher_email.addEventListener('blur', teacher_emailVerify, true);
tsc_no.addEventListener('blur', tsc_noVerify, true);
teacher_id_no.addEventListener('blur', teacher_id_noVerify, true);
subject_1.addEventListener('blur', subject_1Verify, true);
subject_2.addEventListener('blur', subject_2Verify, true);


function validateTeacher(){

   
    //validate first name
    if(teacher_first_name.value == "" || teacher_first_name.value == null){
        teacher_first_name.style.border = "1px solid red";
        document.getElementById('teacher_first_name_div').style.color = "red";
        teacher_first_name_error.innerHTML = "First name is required";
        teacher_first_name.focus();
        return false;
    }
    if(!(name_regex.test(teacher_first_name.value))){
        teacher_first_name.style.border = "1px solid red";
        document.getElementById('teacher_first_name_div').style.color = "red";
        teacher_first_name_error.innerHTML = "Name should only contain letters that not exceed 12";
        teacher_first_name.focus();
        return false;
    }
     //validate first name
     if(teacher_first_name.value.length < 3 ){
        teacher_first_name.style.border = "1px solid red";
        document.getElementById('teacher_first_name_div').style.color = "red";
        teacher_first_name_error.innerHTML = "Invalid name";
        teacher_first_name.focus();
        return false;
    }

    //validate middle name
    if(teacher_middle_name.value == "" || teacher_middle_name.value == null){
        teacher_middle_name.style.border = "1px solid red";
        document.getElementById('teacher_middle_name_div').style.color = "red";
        teacher_middle_name_error.innerHTML = "Middle name is required";
        teacher_middle_name.focus();
        return false;
    }

    if(!(name_regex.test(teacher_middle_name.value))){
        teacher_middle_name.style.border = "1px solid red";
        document.getElementById('teacher_middle_name_div').style.color = "red";
        teacher_middle_name_error.innerHTML = "Name should only contain letters that not exceed 12";
        teacher_middle_name.focus();
        return false;
    }
     //validate middle name
     if(teacher_middle_name.value.length < 3){
        teacher_middle_name.style.border = "1px solid red";
        document.getElementById('teacher_middle_name_div').style.color = "red";
        teacher_middle_name_error.innerHTML = "Invalid name";
        teacher_middle_name.focus();
        return false;
    }

    //validate last name
    if(teacher_last_name.value == "" || teacher_last_name.value == null){
        teacher_last_name.style.border = "1px solid red";
        document.getElementById('teacher_last_name_div').style.color = "red";
        teacher_last_name_error.innerHTML = "Last name is required";
        teacher_last_name.focus();
        return false;
    }
    if(!(name_regex.test(teacher_last_name.value))){
        teacher_last_name.style.border = "1px solid red";
        document.getElementById('teacher_last_name_div').style.color = "red";
        teacher_last_name_error.innerHTML = "Name should only contain letters that not exceed 12";
        teacher_last_name.focus();
        return false;
    }

    //validate last name
    if(teacher_last_name.value.length < 3){
        teacher_last_name.style.border = "1px solid red";
        document.getElementById('teacher_last_name_div').style.color = "red";
        teacher_last_name_error.innerHTML = "Invalid name";
        teacher_last_name.focus();
        return false;
    }

    //validate phone number
    if(teacher_phone_no.value == "" || teacher_phone_no.value == null){
        teacher_phone_no.style.border = "1px solid red";
        document.getElementById('teacher_phone_no_div').style.color = "red";
        teacher_phone_no_error.innerHTML = "Phone number is required";
        teacher_phone_no.focus();
        return false;
    }

    if(!(phone_no_regex.test(teacher_phone_no.value))){
        teacher_phone_no.style.border = "1px solid red";
        document.getElementById('teacher_phone_no_div').style.color = "red";
        teacher_phone_no_error.innerHTML = "Invalid phone number. should start with 07 and should not exceed 10 digits";
        teacher_phone_no.focus();
        return false;
    }

    //validate last name
    if(teacher_phone_no.value.length != 10 || teacher_phone_no.value  < 0 ){
        teacher_phone_no.style.border = "1px solid red";
        document.getElementById('teacher_phone_no_div').style.color = "red";
        teacher_phone_no_error.innerHTML = "Invalid phone number";
        teacher_phone_no.focus();
        return false;
    }

    //validate date of birth
    if(teacher_email.value == "" || teacher_email.value == null){
        teacher_email.style.border = "1px solid red";
        document.getElementById('teacher_email_div').style.color = "red";
        teacher_email_error.innerHTML = "Email address is required";
        teacher_email.focus();
        return false;
    }

    if(!(email_regex.test(teacher_email.value))){
        teacher_email.style.border = "1px solid red";
        document.getElementById('teacher_email_div').style.color = "red";
        teacher_email_error.innerHTML = "Invalid email address";
        teacher_email.focus();
        return false;
    }


     //validate birth certificate number
     if(tsc_no.value == "" || tsc_no.value == null){
        tsc_no.style.border = "1px solid red";
        document.getElementById('tsc_no_div').style.color = "red";
        tsc_no_error.innerHTML = "TSC number is required";
        tsc_no.focus();
        return false;
    }

    //validate birth certificate number
    if(tsc_no.value.length != 7 || tsc_no.value < 1){
        tsc_no.style.border = "1px solid red";
        document.getElementById('tsc_no_div').style.color = "red";
        tsc_no_error.innerHTML = "Invalid TSC number";
        tsc_no.focus();
        return false;
    }

     //validate kcpe index number
     if(teacher_id_no.value == "" || teacher_id_no.value == null){
        teacher_id_no.style.border = "1px solid red";
        document.getElementById('teacher_id_no_div').style.color = "red";
        teacher_id_no_error.innerHTML = "ID number is required";
        teacher_id_no.focus();
        return false;
    }

    //validate kcpe index number
    if(teacher_id_no.value.length != 8 || teacher_id_no.value < 1){
        teacher_id_no.style.border = "1px solid red";
        document.getElementById('teacher_id_no_div').style.color = "red";
        teacher_id_no_error.innerHTML = "Invalid ID number";
        teacher_id_no.focus();
        return false;
    }

    //validate student class
    if(subject_1.value == "" || subject_1.value == null){
        subject_1.style.border = "1px solid red";
        document.getElementById('subject_1_div').style.color = "red";
        subject_1_error.innerHTML = "Subject 1 specialization is required. Select from the list";
        subject_1.focus();
        return false;
    }

    //validate student class
    if(subject_2.value == "" || subject_2.value == null){
        subject_2.style.border = "1px solid red";
        document.getElementById('subject_2_div').style.color = "red";
        subject_2_error.innerHTML = "Subject 2 specialization is required. Select from the list";
        subject_2.focus();
        return false;
    }


    return true;

}

//event handlers for the input fields
function teacher_first_nameVerify(){
    if(teacher_first_name.value != null || teacher_first_name.value != ""){			
        teacher_first_name.style.border = "1px solid #5e6e66";
        document.getElementById('teacher_first_name_div').style.color = "#5e6e66";
        teacher_first_name_error.innerHTML = "";
        return true;
    }
}
function teacher_middle_nameVerify(){
    if(teacher_middle_name.value != null || teacher_middle_name.value != ""){			
        teacher_middle_name.style.border = "1px solid #5e6e66";
        document.getElementById('teacher_middle_name_div').style.color = "#5e6e66";
        teacher_middle_name_error.innerHTML = "";
        return true;
    }
}

function teacher_last_nameVerify(){
    if(teacher_last_name.value != null || teacher_last_name.value != ""){			
        teacher_last_name.style.border = "1px solid #5e6e66";
        document.getElementById('teacher_last_name_div').style.color = "#5e6e66";
        teacher_last_name_error.innerHTML = "";
        return true;
    }
}

function teacher_phone_noVerify(){
    if(teacher_phone_no.value != null || teacher_phone_no.value != ""){			
        teacher_phone_no.style.border = "1px solid #5e6e66";
        document.getElementById('teacher_phone_no_div').style.color = "#5e6e66";
        teacher_phone_no_error.innerHTML = "";
        return true;
    }
}

function teacher_emailVerify(){
    if(teacher_email.value != null || teacher_email.value != ""){			
        teacher_email.style.border = "1px solid #5e6e66";
        document.getElementById('teacher_email_div').style.color = "#5e6e66";
        teacher_email_error.innerHTML = "";
        return true;
    }
}

function tsc_noVerify(){
    if(tsc_no.value != null || tsc_no.value != ""){			
        tsc_no.style.border = "1px solid #5e6e66";
        document.getElementById('tsc_no_div').style.color = "#5e6e66";
        tsc_no_error.innerHTML = "";
        return true;
    }
}

function teacher_id_noVerify(){
    if(teacher_id_no.value != null || teacher_id_no.value != ""){			
        teacher_id_no.style.border = "1px solid #5e6e66";
        document.getElementById('teacher_id_no_div').style.color = "#5e6e66";
        teacher_id_no_error.innerHTML = "";
        return true;
    }
}


function subject_1Verify(){
    if(subject_1.value != null || subject_1.value != ""){			
        subject_1.style.border = "1px solid #5e6e66";
        document.getElementById('subject_1_div').style.color = "#5e6e66";
        subject_1_error.innerHTML = "";
        return true;
    }
}


function subject_2Verify(){
    if(subject_2.value != null || subject_2.value != ""){			
        subject_2.style.border = "1px solid #5e6e66";
        document.getElementById('subject_2_div').style.color = "#5e6e66";
        subject_2_error.innerHTML = "";
        return true;
    }
}



//function to change subject 2 depending on seletcted subject 1
function populate(s1, s2){

    //get the values by id
    var s1 = document.getElementById('subject_1');
    var s2 = document.getElementById('subject_2');

    s2.innerHTML = "";

    if(s1.value == "mathematics"){
        var optionArray = [
                            "|",
                            "chemistry|Chemistry", 
                            "physics|Physics",
                            "business_studies|Business studies",
                            "geography|Geography"
                            ];
    }
    else if(s1.value == "english"){
        var optionArray = [
                            "|",
                            "literature|Literature" 
                            ];
    }
    else if(s1.value == "kiswahili"){
        var optionArray = [
                            "|",
                            "history|History", 
                            "cre|Christian Religous Education"
                            ];
    }
    else if(s1.value == "chemistry"){
        var optionArray = [
                            "|",
                            "mathematics|Mathematics", 
                            "physics|Physics",
                            "geography|Geography"
                            ];
    }
    else if(s1.value == "biology"){
        var optionArray = [
                            "|",
                            "chemistry|Chemistry", 
                            "agriculture|Agriculture",
                            "geography|Geography"
                            ];
    }
    else if(s1.value == "physics"){
        var optionArray = [
                            "|",
                            "chemistry|Chemistry", 
                            "mathematics|Mathematics"
                            ];
    }
    else if(s1.value == "geography"){
        var optionArray = [
                            "|",
                            "chemistry|Chemistry", 
                            "mathematics|Mathematics",
                            "biology|Biology",
                            "agriculture|Agriculture",
                            "business_studies|Business studies"
                            ];
    }
    else if(s1.value == "history"){
        var optionArray = [
                            "|",
                            "kiswahili|Kiswahili", 
                            "cre|Christian Religious Education"
                            ];
    }
    else if(s1.value == "cre"){
        var optionArray = [
                            "|",
                            "history|History", 
                            "kiswahili|Kiswahili"
                            ];
    }
    else if(s1.value == "agriculture"){
        var optionArray = [
                            "|",
                            "biology|Biology", 
                            "geography|geography",
                            "chemistry|Chemistry",
                            "mathematics|Mathematics"
                            ];
    }
    else if(s1.value == "business_studies"){
        var optionArray = [
                            "|",
                            "mathematics|Mathematics", 
                            "geography|Geography"
                            ];
    }

    for(var option in optionArray){

        var pair = optionArray[option].split("|");
        var newOption = document.createElement("option");
        newOption.value = pair[0];
        newOption.innerHTML = pair[1];
        s2.options.add(newOption);

    }
}
