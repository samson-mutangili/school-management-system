@extends('layouts.dashboard')

@section('content')
    

<div class="row">
    <div class="col-md-12">
        <h4 class="page-head-line">Help</h4>

    </div>
</div>


<div class="panel panel-default w-auto">
    <div class="panel-heading">
      
    </div>

     <div class="panel-body">
        <h4 style="text-decoration: underline; color: green;">Navigation in small screen</h4>
        <p>When in viewing this application using devices that have smmall screes, the side menu will not apper automatically.
            But don't worry, we got you covered.
            Click on the toggle bar that is on the top left corner of the screen as shown below.
        </p>
        <img src="{{ URL::asset('help_images/toggle_bar.jpg') }}" alt="toggle bar" style="height: 400px;"/>
    <br>
        <div style="position: relative;">
           <p> The side menu will appear on the screen as shown below.</p>
            <img src="{{ URL::asset('help_images/show_side_menu.png') }}" alt="side menu" style="height: 400px;"/>
    
        </div>

        <p> Depending on your intented use, you can choose one of the options in the side menu.</p>
    </div>


</div>
@if (Session::get("is_principal"))


<div class="panel panel-default w-auto">
    <div class="panel-heading">
      
    </div>

     <div class="panel-body">
        <h4 style="text-decoration: underline; color: green;">Adding a new teacher</h4>
        <p>
            Newly employed teachers can easily be added in to the system.
            To add a new teachers, first click in the "teachers" menu in the side menu, then select "add new teacher "as shown below.
            
        </p>
        <br>
        <img src="{{ URL::asset('help_images/add_teacher.jpg') }}" alt="add teacher" style=" margin-top: 10px; margin-bottom: 10px; height: auto; width: 90%;"/>
    <br>
        <div style="position: relative;">
           <p> The form for adding a  new teacher will be dispplayed as shown below. Fill in the teachers details and then click the 
               green submit button.
           </p>
           <br>
            <img src="{{ URL::asset('help_images/teachers_form.png') }}" alt="teachers form" style=" margin-top: 10px; margin-bottom: 10px; height: auto; width: 90%;"/>
    
        </div>

    </div>

</div>


<div class="panel panel-default w-auto">
    <div class="panel-heading">
      
    </div>

     <div class="panel-body">
        <h4 style="text-decoration: underline; color: green;">About teachers roles and responsibilities</h4>
        <p>
            Special teacher responsibilities includes a teacher being the deputy principal, bording master, or in charge of student admission and examination.
            To assign a roles and responsibilities, first, in the side menu, click on the "teachers menu" as shown below, then on 
            drop down menu, click on "teachers details" option.
        </p>
        <img src="{{ URL::asset('help_images/teachers_side_menu.jpg') }}" alt="teachers side menu" style=" margin-top: 10px; margin-bottom: 10px; height: auto; width: 90%;"/>
    <br>
          <p> The the teachers details appear as follows. </p>
            <img src="{{ URL::asset('help_images/teachers_list.png') }}" alt="teachers list" style=" margin-top: 10px; margin-bottom: 10px; height: auto; width: 90%;"/>
    
     <br>
     <p> Click on the tab named "roles and responsibilities" as shown in the area circled below.</p>
        <img src="{{ URL::asset('help_images/circled_roles.jpg') }}" alt="roles and responsibilities" style=" margin-top: 10px; margin-bottom: 10px; height: auto; width: 90%;"/>
    
   

    <br>
     <p> If the teacher is not assigned any special role, click the blue word "here" to assign the teacher a role</p>
        <br>

    <p style="text-decoration: underline;"> Teacher responsibilities</p>
    <p>Teacher responsibility involves a teacher teacher in charge of a class, also known as "class teacher"
        <br>
        In the teachear is charge of any class, click the circle area as shown below in order to assign the teacher a class 
        to be in charge of.
        <br>
        <img src="{{ URL::asset('help_images/add_teacher_responsibility.jpg') }}" alt="teachers list" style=" margin-top: 10px; margin-bottom: 10px; height: auto; width: 90%;"/>
    

    </p>
    
    </div>
</div>

    
@endif


@endsection