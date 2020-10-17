
//function to change subject 2 depending on seletcted subject 1
function change_stream(s1, s2){

    //get the values by id
    var s1 = document.getElementById('next_class');
    var s2 = document.getElementById('class_stream');

    s2.innerHTML = "";

    if(s1.value == "Form 1"){
        var optionArray = [
                            "|",
                            "1E|1E", 
                            "1W|1W"
                            ];
    }
    else if(s1.value == "Form 2"){
        var optionArray = [
                            "|",
                            "2E|2E", 
                            "2W|2W"
                            ];
    }
    else if(s1.value == "Form 3"){
        var optionArray = [
                            "|",
                            "3E|3E", 
                            "3W|3W"
                            ];
    }
    else if(s1.value == "Form 4"){
        var optionArray = [
                            "|",
                            "4E|4E", 
                            "4W|4W"
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
