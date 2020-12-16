
//function to change subject 2 depending on seletcted subject 1
function matchStreams(s1, s2){

    //get the values by id
    var s1 = document.getElementById('class_name');
    var s2 = document.getElementById('streams');

    s2.innerHTML = "";

    if(s1.value == "Form 1"){
        var optionArray = [
                            "|",
                            "all|All", 
                            "1E|1E", 
                            "1W|1W"
                            ];
    }
    else if(s1.value == "Form 2"){
        var optionArray = [
                             "|",
                            "all|All", 
                            "2E|2E", 
                            "2W|2W"
                            ];
    }
    else if(s1.value == "Form 3"){
        var optionArray = [
                             "|",
                            "all|All", 
                            "3E|3E", 
                            "3W|3W"
                            ];
    }
    else if(s1.value == "Form 4"){
        var optionArray = [
                             "|",
                            "all|All", 
                            "4E|4E", 
                            "4W|4W"
                            ];
    }
    else if(s1.value == ""){
        var optionArray = [
                            "|"
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
