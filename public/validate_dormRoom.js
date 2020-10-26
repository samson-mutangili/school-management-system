//get the dorm room input fields
var room_no = document.forms['new_dormRoom_form']['room_no'];
var room_capacity = document.forms['new_dormRoom_form']['room_capacity'];
var room_status = document.forms['new_dormRoom_form']['room_status'];


var room_no_regex = /^[a-zA-Z0-9]{1,4}$/;
var room_capacity_regex = /^[0-9]{1,3}$/;

//get the dorm room input details error fields
var room_no_error = document.getElementById('room_no_error');
var room_capacity_error = document.getElementById('room_capacity_error');
var room_status_error = document.getElementById('room_status_error');


//add event listeners to input fields
room_no.addEventListener('blur', room_noVerify, true);
room_capacity.addEventListener('blur', room_capacityVerify, true);
room_status.addEventListener('blur', room_statusVerify, true);


function validateDormRoom(){   

    //validate bank room_no
    if(room_no.value == "" || room_no.value == null){
        room_no.style.border = "1px solid red";
        document.getElementById('room_no_div').style.color = "red";
        room_no_error.innerHTML = "Room number is required";
        room_no.focus();
        return false;
    }

    if(!room_no_regex.test(room_no.value)){
        room_no.style.border = "1px solid red";
        document.getElementById('room_no_div').style.color = "red";
        room_no_error.innerHTML = "Room number is can only contain letters and numbers that do not exceed 6";
        room_no.focus();
        return false;
    }
     
    //validate middle name
    if(room_capacity.value == "" || room_capacity.value == null){
        room_capacity.style.border = "1px solid red";
        document.getElementById('room_capacity_div').style.color = "red";
        room_capacity_error.innerHTML = "Room capacity is required";
        room_capacity.focus();
        return false;
    }
    
    if(!room_capacity_regex.test(room_capacity.value)){
        room_capacity.style.border = "1px solid red";
        document.getElementById('room_capacity_div').style.color = "red";
        room_capacity_error.innerHTML = "Room capacity can only contain digits that donot exceed 3";
        room_capacity.focus();
        return false;
    }
     //validate middle name
     if(room_capacity.value < 1){
        room_capacity.style.border = "1px solid red";
        document.getElementById('room_capacity_div').style.color = "red";
        room_capacity_error.innerHTML = "Room capacity cannot be less than 1";
        room_capacity.focus();
        return false;
    }

    //validate middle name
    if(room_capacity.value.length > 1000 ){
        room_capacity.style.border = "1px solid red";
        document.getElementById('room_capacity_div').style.color = "red";
        room_capacity_error.innerHTML = "Unreasonable room capacity. Room capacity should not exceed 1000 students";
        room_capacity.focus();
        return false;
    }

    //validate last name
    if(room_status.value == "" || room_status.value == null){
        room_status.style.border = "1px solid red";
        document.getElementById('room_status_div').style.color = "red";
        room_status_error.innerHTML = "Room status is required";
        room_status.focus();
        return false;
    }

    

    return true;

}

//event handlers for the input fields
function room_noVerify(){
    if(room_no.value != null || room_no.value != ""){			
        room_no.style.border = "1px solid #5e6e66";
        document.getElementById('room_no_div').style.color = "#5e6e66";
        room_no_error.innerHTML = "";
        return true;
    }
}
function room_capacityVerify(){
    if(room_capacity.value != null || room_capacity.value != ""){			
        room_capacity.style.border = "1px solid #5e6e66";
        document.getElementById('room_capacity_div').style.color = "#5e6e66";
        room_capacity_error.innerHTML = "";
        return true;
    }
}

function room_statusVerify(){
    if(room_status.value != null || room_status.value != ""){			
        room_status.style.border = "1px solid #5e6e66";
        document.getElementById('room_status_div').style.color = "#5e6e66";
        room_status_error.innerHTML = "";
        return true;
    }
}





