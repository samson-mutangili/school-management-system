//get the address input fields
var postal_code = document.forms['address_form']['postal_code'];
var postal_address = document.forms['address_form']['postal_address'];
var street = document.forms['address_form']['street'];
var town = document.forms['address_form']['town'];
var country = document.forms['address_form']['postal_code'];

var name_regex = /^[a-zA-Z]{3,12}$/;
var postal_address_regex = /^[0-9]{5}$/;
var postal_code_regex = /^[0-9]{1,6}$/;

//get the student details error fields
var postal_code_error = document.getElementById('postal_code_error');
var postal_address_error = document.getElementById('postal_address_error');
var street_error = document.getElementById('street_error');
var town_error = document.getElementById('town_error');
var country_error = document.getElementById('country_error');


//add event listeners to student input fields
postal_code.addEventListener('blur', postal_codeVerify, true);
postal_address.addEventListener('blur', postal_addressVerify, true);
street.addEventListener('blur', streetVerify, true);
town.addEventListener('blur', townVerify, true);
country.addEventListener('blur', countryVerify, true);


function validateAddress(){

    //validate first name
    if(postal_code.value == "" || postal_code.value == null){
        postal_code.style.border = "1px solid red";
        document.getElementById('postal_code_div').style.color = "red";
        postal_code_error.innerHTML = "Postal code is required";
        postal_code.focus();
        return false;
    }
     //validate first name
     if(postal_code.value.length < 1 || postal_code.value < 0 ){
        postal_code.style.border = "1px solid red";
        document.getElementById('postal_code_div').style.color = "red";
        postal_code_error.innerHTML = "Invalid postal code";
        postal_code.focus();
        return false;
    }

    if(!(postal_code_regex.test(postal_code.value))){
        postal_code.style.border = "1px solid red";
        document.getElementById('postal_code_div').style.color = "red";
        postal_code_error.innerHTML = "Invalid postal code";
        postal_code.focus();
        return false;
    }

    //validate middle name
    if(postal_address.value == "" || postal_address.value == null){
        postal_address.style.border = "1px solid red";
        document.getElementById('postal_address_div').style.color = "red";
        postal_address_error.innerHTML = "Postal address is required";
        postal_address.focus();
        return false;
    }

     //validate middle name
     if(postal_address.value.length != 5 || postal_address.value < 0){
        postal_address.style.border = "1px solid red";
        document.getElementById('postal_address_div').style.color = "red";
        postal_address_error.innerHTML = "Invalid postal address";
        postal_address.focus();
        return false;
    }

    if(!(postal_address_regex.test(postal_address.value))){
        postal_address.style.border = "1px solid red";
        document.getElementById('postal_address_div').style.color = "red";
        postal_address_error.innerHTML = "Postal address can only contain 5 digits";
        postal_address.focus();
        return false;
    }

    //validate last name
    if(street.value == "" || street.value == null){
        street.style.border = "1px solid red";
        document.getElementById('street_div').style.color = "red";
        street_error.innerHTML = "Street name is required";
        street.focus();
        return false;
    }

    //validate last name
    if(street.value.length < 3){
        street.style.border = "1px solid red";
        document.getElementById('street_div').style.color = "red";
        street_error.innerHTML = "Invalid street name";
        street.focus();
        return false;
    }

    if(!(name_regex.test(street.value))){
        street.style.border = "1px solid red";
        document.getElementById('street_div').style.color = "red";
        street_error.innerHTML = "Invalid! street name can only contain letters that do not exceed 12";
        street.focus();
        return false;
    }
    //validate last name
    if(town.value == "" || town.value == null){
        town.style.border = "1px solid red";
        document.getElementById('town_div').style.color = "red";
        town_error.innerHTML = "Town name is required";
        town.focus();
        return false;
    }

    //validate last name
    if(town.value.length < 3 ){
        town.style.border = "1px solid red";
        document.getElementById('town_div').style.color = "red";
        town_error.innerHTML = "Invalid town name";
        town.focus();
        return false;
    }

    if(!(name_regex.test(town.value))){
        town.style.border = "1px solid red";
        document.getElementById('town_div').style.color = "red";
        town_error.innerHTML = "Invalid! Town name can only contain letters that do not exceed 12";
        town.focus();
        return false;
    }
    //validate date of birth
    if(country.value == "" || country.value == null){
        country.style.border = "1px solid red";
        document.getElementById('country_div').style.color = "red";
        country_error.innerHTML = "country is required";
        country.focus();
        return false;
    }


    return true;

}

//event handlers for the input fields
function postal_codeVerify(){
    if(postal_code.value != null || postal_code.value != ""){			
        postal_code.style.border = "1px solid #5e6e66";
        document.getElementById('postal_code_div').style.color = "#5e6e66";
        postal_code_error.innerHTML = "";
        return true;
    }
}
function postal_addressVerify(){
    if(postal_address.value != null || postal_address.value != ""){			
        postal_address.style.border = "1px solid #5e6e66";
        document.getElementById('postal_address_div').style.color = "#5e6e66";
        postal_address_error.innerHTML = "";
        return true;
    }
}

function streetVerify(){
    if(street.value != null || street.value != ""){			
        street.style.border = "1px solid #5e6e66";
        document.getElementById('street_div').style.color = "#5e6e66";
        street_error.innerHTML = "";
        return true;
    }
}

function townVerify(){
    if(town.value != null || town.value != ""){			
        town.style.border = "1px solid #5e6e66";
        document.getElementById('town_div').style.color = "#5e6e66";
        town_error.innerHTML = "";
        return true;
    }
}

function countryVerify(){
    if(country.value != null || country.value != ""){			
        country.style.border = "1px solid #5e6e66";
        document.getElementById('country_div').style.color = "#5e6e66";
        country_error.innerHTML = "";
        return true;
    }
}


