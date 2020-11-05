@extends('layouts.dashboard')

@section('content')
    

<div class="row">
    <div class="col-md-12">
        <h4 class="page-head-line">Marks Entry Help</h4>

    </div>
</div>


<div class="panel panel-default w-auto">
    <div class="panel-heading">
      
    </div>

     <div class="panel-body">
        <h4 style="text-decoration: underline; color: green;">Adding or submitting marks</h4>
       <strong> Note!! You are only able to submit marks for the subject you are teaching in that class</strong>
        <br>
        <p>
           
            Once you are ready to start submitting new marks for students exams, you can click the "add" button, as circled 
            below, in the row which corresponds the student details whose marks are to be submitted.
        </p>
        <img src="{{ URL::asset('help_images/add_marks_btn.jpg') }}" alt="add marks button" style=" margin-top: 10px; margin-bottom: 10px; height: auto; width: 90%;"/>
    <br>
        <p>
            A dialog modal appears that has input fields for the respective subject you are teaching.
            The marks scored by the students must be entered and the respective comment selected.
            Failure to enter student marks, one can not submit empty fields.
            You can click the "submit" button to submit the entered marks
        </p>
        <br>
        <img src="{{ URL::asset('help_images/add_marks.png') }}" alt="add marks" style=" margin-top: 10px; margin-bottom: 10px; height: auto; width: 90%;"/>

    </div>


</div>

<div class="panel panel-default w-auto">
    <div class="panel-heading">
      
    </div>

     <div class="panel-body">
        <h4 style="text-decoration: underline; color: green;">Viewing submitted marks</h4>
       <strong> Note!! You can only view marks for the students you have submitted!!</strong>
        <p>
            Once marks have been submitted, you can view the marks by clicking the "view" button as shown below

        </p>
        <br>
        <img src="{{ URL::asset('help_images/view_marks_btn.jpg') }}" alt="view marks button" style=" margin-top: 10px; margin-bottom: 10px; height: auto; width: 90%;"/>
    <br>
          <p>A dialog modal pops up, as shown below, that displays the submitted marks and their respective comments appears.
              If no marks had been submitted before, an information will be displayed to inform you that you have not submitted 
              any marks.
           </p>
           <br>
            <img src="{{ URL::asset('help_images/view_marks.png') }}" alt="view marks" style=" margin-top: 10px; margin-bottom: 10px; height: auto; width: 90%;"/>
    

    </div>

</div>


<div class="panel panel-default w-auto">
    <div class="panel-heading">
      
    </div>

     <div class="panel-body">
        <h4 style="text-decoration: underline; color: green;">Edit marks</h4>
        <strong> Note!! You can only edit marks for the students you have submitted!!</strong>

        <p>

            Incase of wrong submitted marks or updates to be made, do not worry. We got you sorted.
            By clicking on the "edit" button circled below, you are able to open a dialog modal that displays the submitted marks
            and can be easily edited.
        </p>
        <img src="{{ URL::asset('help_images/edit_marks_btn.jpg') }}" alt="edit marks btn" style=" margin-top: 10px; margin-bottom: 10px; height: auto; width: 90%;"/>
    <br>
          <p> On the dialog modal, you can update the students marks as per required and then click on the update button.
        <br>
        If no changes are to be made, you can click on the "close" button to close the dialog modal.
        If no marks have been submitted for the respective student, an information will be displayed to inform you that you have 
        not submitted any marks.
            
        </p>
            <img src="{{ URL::asset('help_images/edit_marks.png') }}" alt="edit_marks" style=" margin-top: 10px; margin-bottom: 10px; height: auto; width: 90%;"/>
    
     <br>
     
    
    </div>
</div>


<div class="panel panel-default w-auto">
    <div class="panel-heading">
      
    </div>

     <div class="panel-body">
        <h4 style="text-decoration: underline; color: green;">Remove / delete marks</h4>
        <strong> Note!! You can only remove or delete marks for the students you have submitted!!</strong>

        <p>

            Incase you want to totally delete the marks for the student, you can click the "remove" button circled below.
            Note that this action is permanent and cannot be reverted.

        </p>
        <img src="{{ URL::asset('help_images/remove_marks_btn.jpg') }}" alt="edit marks btn" style=" margin-top: 10px; margin-bottom: 10px; height: auto; width: 90%;"/>
    <br>
          <p> On the dialog modal, you can tick the check box for the student subject marks that are to be removed. If no option for a check box shows up,
              then it implies that you have not submitted marks for that student in either subject you are teching in that class.
        <br>
        If no marks have been submitted for the respective student, an information will be displayed to inform you that you have 
        not submitted any marks.
        You can click the "close" button in changes you do not want to remove or delete the marks
            
        </p>
            <img src="{{ URL::asset('help_images/remove_marks.png') }}" alt="edit_marks" style=" margin-top: 10px; margin-bottom: 10px; height: auto; width: 90%;"/>
    
     <br>
     
    
    </div>
</div>




@endsection