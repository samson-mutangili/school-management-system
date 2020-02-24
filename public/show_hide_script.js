 //function to hide or show father details input form
        function showFatherInput(){
                if(document.getElementById('add_father').checked){
                        document.getElementById('fathers_details').style.display = 'block';
                } else {
                        document.getElementById('fathers_details').style.display = 'none';
                }
        }

         //function to hide or show mother details input form
         function showMotherInput(){
                if(document.getElementById('add_mother').checked){
                        document.getElementById('mothers_details').style.display = 'block';
                } else {
                        document.getElementById('mothers_details').style.display = 'none';
                }
        }

         //function to hide or show guardian details input form
         function showGuardianInput(){
                if(document.getElementById('add_guardian').checked){
                        document.getElementById('guardian_details').style.display = 'block';
                } else {
                        document.getElementById('guardian_details').style.display = 'none';
                }
        }


