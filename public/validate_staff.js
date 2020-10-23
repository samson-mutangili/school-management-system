
//get the non teaching staff input fields
var first_name = document.forms['not_teaching_staff_form']['first_name'];
var middle_name = document.forms['not_teaching_staff_form']['middle_name'];
var last_name = document.forms['not_teaching_staff_form']['last_name'];
var phone_no = document.forms['not_teaching_staff_form']['phone_no'];
var email = document.forms['not_teaching_staff_form']['email'];
var id_no = document.forms['not_teaching_staff_form']['id_no'];
var emp_no = document.forms['not_teaching_staff_form']['emp_no'];
var category = document.forms['not_teaching_staff_form']['category'];
var salary = document.forms['not_teaching_staff_form']['salary'];

var name_regex = /^[a-zA-Z]{3,12}$/;
var phone_no_regex = /^(07)[0-9]{8}$/;
var email_regex = /^([a-z0-9\.-]+)@([a-z0-9-]+)\.([a-z]{2,8})(\.[a-z]{2,8})?$/;

//get the non teaching staff error fields
var first_name_error = document.getElementById('first_name_error');
var middle_name_error = document.getElementById('middle_name_error');
var last_name_error = document.getElementById('last_name_error');
var phone_no_error = document.getElementById('phone_no_error');
var email_error = document.getElementById('email_error');
var id_no_error = document.getElementById('id_no_error');
var emp_no_error = document.getElementById('emp_no_error');
var category_error = document.getElementById('category_error');
var salary_error = document.getElementById('salary_error');



//add event listeners to non teaching staff input fields
first_name.addEventListener('blur', first_nameVerify, true);
middle_name.addEventListener('blur', middle_nameVerify, true);
last_name.addEventListener('blur', last_nameVerify, true);
phone_no.addEventListener('blur', phone_noVerify, true);
email.addEventListener('blur', emailVerify, true);
id_no.addEventListener('blur', id_noVerify, true);
emp_no.addEventListener('blur', emp_noVerify, true);
category.addEventListener('blur', categoryVerify, true);
salary.addEventListener('blur', salaryVerify, true);



function validateNonTeachingStaff(){

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
    //validate phone number
    if(phone_no.value == "" || phone_no.value == null){
        phone_no.style.border = "1px solid red";
        document.getElementById('phone_no_div').style.color = "red";
        phone_no_error.innerHTML = "Phone number is required";
        phone_no.focus();
        return false;
    }

    //validate phone number
    if(phone_no.value.length != 10 || phone_no.value  < 0 ){
        phone_no.style.border = "1px solid red";
        document.getElementById('phone_no_div').style.color = "red";
        phone_no_error.innerHTML = "Invalid phone number";
        phone_no.focus();
        return false;
    }

    if(!(phone_no_regex.test(phone_no.value))){
        phone_no.style.border = "1px solid red";
        document.getElementById('phone_no_div').style.color = "red";
        phone_no_error.innerHTML = "Phone number should start with 07";
        phone_no.focus();
        return false;
    }

    //validate email
    if(email.value == "" || email.value == null){
        email.style.border = "1px solid red";
        document.getElementById('email_div').style.color = "red";
        email_error.innerHTML = "Email address is required";
        email.focus();
        return false;
    }

    if(!(email_regex.test(email.value))){
        email.style.border = "1px solid red";
        document.getElementById('email_div').style.color = "red";
        email_error.innerHTML = "Invalid email";
        return false;
    }


     //validate id number
     if(id_no.value == "" || id_no.value == null){
        id_no.style.border = "1px solid red";
        document.getElementById('id_no_div').style.color = "red";
        id_no_error.innerHTML = "ID number is required";
        id_no.focus();
        return false;
    }

     //validate kcpe index number
     if(id_no.value.length != 8 || id_no.value < 1){
        id_no.style.border = "1px solid red";
        document.getElementById('id_no_div').style.color = "red";
        id_no_error.innerHTML = "Invalid ID number";
        id_no.focus();
        return false;
    }

     //validate employee number
     if(emp_no.value == "" || emp_no.value == null){
        emp_no.style.border = "1px solid red";
        document.getElementById('emp_no_div').style.color = "red";
        emp_no_error.innerHTML = "Employee number is required";
        emp_no.focus();
        return false;
    }

    //validate employee number
    if(emp_no.value.length < 3){
        emp_no.style.border = "1px solid red";
        document.getElementById('emp_no_div').style.color = "red";
        emp_no_error.innerHTML = "Invalid employee number";
        emp_no.focus();
        return false;
    }
     //validate category
     if(category.value == "" || category.value == null){
        category.style.border = "1px solid red";
        document.getElementById('category_div').style.color = "red";
        category_error.innerHTML = "Select a category";
        category.focus();
        return false;
    }    
   

    //validate salary
    if(salary.value == "" || salary.value == null){
        salary.style.border = "1px solid red";
        document.getElementById('salary_div').style.color = "red";
        salary_error.innerHTML = "Employee salary is required";
        salary.focus();
        return false;
    }

     //validate salary
     if(salary.value.length > 7 || salary.value > 200000 || salary.value < 1){
        salary.style.border = "1px solid red";
        document.getElementById('salary_div').style.color = "red";
        salary_error.innerHTML = "Inavlid salary";
        salary.focus();
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

function phone_noVerify(){
    if(phone_no.value != null || phone_no.value != ""){			
        phone_no.style.border = "1px solid #5e6e66";
        document.getElementById('phone_no_div').style.color = "#5e6e66";
        phone_no_error.innerHTML = "";
        return true;
    }
}

function emailVerify(){
    if(email.value != null || email.value != ""){			
        email.style.border = "1px solid #5e6e66";
        document.getElementById('email_div').style.color = "#5e6e66";
        email_error.innerHTML = "";
        return true;
    }
}

function categoryVerify(){
    if(category.value != null || category.value != ""){			
        category.style.border = "1px solid #5e6e66";
        document.getElementById('category_div').style.color = "#5e6e66";
        category_error.innerHTML = "";
        return true;
    }
}

function id_noVerify(){
    if(id_no.value != null || id_no.value != ""){			
        id_no.style.border = "1px solid #5e6e66";
        document.getElementById('id_no_div').style.color = "#5e6e66";
        id_no_error.innerHTML = "";
        return true;
    }
}

function emp_noVerify(){
    if(emp_no.value != null || emp_no.value != ""){			
        emp_no.style.border = "1px solid #5e6e66";
        document.getElementById('emp_no_div').style.color = "#5e6e66";
        emp_no_error.innerHTML = "";
        return true;
    }
}


function salaryVerify(){
    if(salary.value != null || salary.value != ""){			
        salary.style.border = "1px solid #5e6e66";
        document.getElementById('salary_div').style.color = "#5e6e66";
        salary_error.innerHTML = "";
        return true;
    }
}
