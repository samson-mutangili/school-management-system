
//get the student input fields
var room = document.forms['allocate_room_form']['room'];


//get the student details error fields
var room_error = document.getElementById('room_error');

//add event listeners to student input fields
room.addEventListener('blur', roomVerify, true);

function validateRoomNo(){


    //validate first name
    if(room.value == "" || room.value == null){
        room.style.border = "1px solid red";
        document.getElementById('room_div').style.color = "red";
        room_error.innerHTML = "Room number is required";
        room.focus();
        return false;
    }

    return true;
}

function roomVerify(){
    if(room.value != null || room.value != ""){			
        room.style.border = "1px solid #5e6e66";
        document.getElementById('room_div').style.color = "#5e6e66";
        room_error.innerHTML = "";
        return true;
    }
}