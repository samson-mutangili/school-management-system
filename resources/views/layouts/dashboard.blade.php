<!DOCTYPE html>
<html lang="en">
<head>
	<title>School management system</title>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

  <link href= " {{ URL::asset('dash/vendor/fontawesome-free/css/all.min.css') }} " rel="stylesheet" type="text/css">
  <link href= " {{ URL::asset(' https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i') }}" rel="stylesheet">
 
  <link href=" {{ URL::asset('dash/css/sb-admin-2.min.css') }}" rel="stylesheet">
<link rel="stylesheet" type="text/css" href=" {{ URL::asset('css/bootstrap.css') }}">
<link rel="stylesheet" type="text/css" href=" {{ URL::asset('css/basic.css') }}">
<link rel="stylesheet" type="text/css" href=" {{ URL::asset('css/show_more_styles.css') }}">
<link rel="stylesheet" type="text/css" href=" {{ URL::asset('adminLTE/css/adminlte_styles.css') }}">
<link rel="stylesheet" type="text/css" href=" {{ URL::asset('https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css') }}">

<!--link for datatables-->
<link rel="stylesheet" type="text/css" href=" {{ URL::asset('https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css') }}">

<link rel="stylesheet" type="text/css" href=" {{ URL::asset('css/new_styles.css') }}">

<script src=" {{ URL::asset('https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js') }}"></script>




</head>
<body id="page-top">
<!-- Page Wrapper -->
<div id="wrapper" >


 
<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
    <div class="sidebar-brand-icon rotate-n-15">
    </div>
    <div class="sidebar-brand-text mx-3">Shiners high school</div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">


  <!-- Divider -->
  <hr class="sidebar-divider">
  


  @if(Session::get('is_principal') || Session::get('is_deputy_principal') || Session::get('is_admin'))
      <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
      <a href="/admin/dashboard" class="nav-link">
        <span style="font-size: 15px;"><i class="fa fa-home"  style="font-size: 18px; color: black;"></i>Dashboard</span>
      </a>
    </li>
  @endif

  @if(Session::get('is_normal_teacher') && (!Session::get('is_boarding_master')))
        <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a href="/teachers/dashboard" class="nav-link">
          <span style="font-size: 15px;"><i class="fa fa-home" style="font-size: 18px; color: black;" ></i>Dashboard</span>
        </a>
      </li>
  @endif

  

      @if (Session::get('staff_category') == "bursar")

      <li class="nav-item" style=" padding: 0 !important;">
        <a style=" padding-top: 0 !important; padding-bottom: 0 !important;" href="/finance_department" class="nav-link">
          <span style="font-size: 15px; margin: 0;"><i class="fa fa-home" style="font-size: 18px; color: black;" ></i>Dashboard</span>
        </a>
      </li>

                  <!-- Nav Item - Pages Collapse Menu -->
          <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#trips" aria-expanded="true" aria-controls="collapseTwo">
              <span style="font-size: 15px;">Take Fees</span>
            </a>
            <div id="trips" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                  <hr>
                      <a class="collapse-item" href="/finance_department/take_fees/1E">Form 1E</a>
                      <a class="collapse-item" href="/finance_department/take_fees/1W">Form 1W</a>            
                    <hr>
                    <a class="collapse-item" href="/finance_department/take_fees/2E">Form 2E</a>
                    <a class="collapse-item" href="/finance_department/take_fees/2W">Form 2W</a>
                    <hr>
                    <a class="collapse-item" href="/finance_department/take_fees/3E">Form 3E</a>
                    <a class="collapse-item" href="/finance_department/take_fees/3W">Form 3W</a>
                    <hr>
                      <a class="collapse-item" href="/finance_department/take_fees/4E">Form 4E</a>
                    <a class="collapse-item" href="/finance_department/take_fees/4W">Form 4W</a>
                    <hr>
                    <a class="collapse-item" href="/finance_department/alumni/take_fees/">Alumni</a>
              </div>
            </div>
          </li>

        
                  <!-- Nav Item - Pages Collapse Menu -->
                  <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#fee_balances" aria-expanded="true" aria-controls="collapseTwo">
                      <span style="font-size: 15px;">Fee Balances</span>
                    </a>
                    <div id="fee_balances" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                      <div class="bg-white py-2 collapse-inner rounded">
                          <hr>
                              <a class="collapse-item" href="/finance_department/fee_balances/1E">Form 1E</a>
                              <a class="collapse-item" href="/finance_department/fee_balances/1W">Form 1W</a>            
                            <hr>
                            <a class="collapse-item" href="/finance_department/fee_balances/2E">Form 2E</a>
                            <a class="collapse-item" href="/finance_department/fee_balances/2W">Form 2W</a>
                            <hr>
                            <a class="collapse-item" href="/finance_department/fee_balances/3E">Form 3E</a>
                            <a class="collapse-item" href="/finance_department/fee_balances/3W">Form 3W</a>
                            <hr>
                              <a class="collapse-item" href="/finance_department/fee_balances/4E">Form 4E</a>
                            <a class="collapse-item" href="/finance_department/fee_balances/4W">Form 4W</a>
                            <hr>
                      </div>
                    </div>
                  </li>

                  <!-- Nav Item - Pages Collapse Menu -->
                  <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#clean_students" aria-expanded="true" aria-controls="collapseTwo">
                      <span style="font-size: 15px;">Clean students</span>
                    </a>
                    <div id="clean_students" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                      <div class="bg-white py-2 collapse-inner rounded">
                         
                              <a class="collapse-item" href="/finance_department/clean_students/form1">Form 1</a>  
                            <a class="collapse-item" href="/finance_department/clean_students/form2">Form 2</a>
                            <a class="collapse-item" href="/finance_department/clean_students/form3">Form 3</a>
                              <a class="collapse-item" href="/finance_department/clean_students/form4">Form 4</a>
                      </div>
                    </div>
                  </li>


                  <!-- Nav Item - Pages Collapse Menu -->
                  <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#fee_statements" aria-expanded="true" aria-controls="collapseTwo">
                      <span style="font-size: 15px;">Fee Statements</span>
                    </a>
                    <div id="fee_statements" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                      <div class="bg-white py-2 collapse-inner rounded">
                          <hr>
                              <a class="collapse-item" href="/finance_department/fee_statements/1E">Form 1E</a>
                              <a class="collapse-item" href="/finance_department/fee_statements/1W">Form 1W</a>            
                            <hr>
                            <a class="collapse-item" href="/finance_department/fee_statements/2E">Form 2E</a>
                            <a class="collapse-item" href="/finance_department/fee_statements/2W">Form 2W</a>
                            <hr>
                            <a class="collapse-item" href="/finance_department/fee_statements/3E">Form 3E</a>
                            <a class="collapse-item" href="/finance_department/fee_statements/3W">Form 3W</a>
                            <hr>
                              <a class="collapse-item" href="/finance_department/fee_statements/4E">Form 4E</a>
                            <a class="collapse-item" href="/finance_department/fee_statements/4W">Form 4W</a>
                            <hr>
                            <a class="collapse-item" href="/finance_department/alumni/fee_statement">Alumni</a>

                      </div>
                    </div>
                  </li>

                  <li class="nav-item">
                    <a  href="/finance_department/reports" class="nav-link">
                      <span style="font-size: 18px;">Reports</span>
                    </a>
                  </li>
        
     @endif

     @if (Session::get('is_boardingMaster'))
                  
      <li class="nav-item" style=" padding: 0 !important;">
        <a href="/accommodation_facility/dashboard" class="nav-link">
          <span style="font-size: 15px; margin: 0;"><i class="fa fa-home" style="font-size: 18px; color: black;" ></i>Dashboard</span>
        </a>
      </li>

      <li class="nav-item" style=" padding: 0 !important;">
        <a  href="/accommodation_facility/dormitories" class="nav-link">
          <span style="font-size: 15px; margin: 0;">Dormitories</span>
        </a>
      </li>

        <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#student_rooms" aria-expanded="true" aria-controls="collapseTwo">
        <span style="font-size: 15px;">Student rooms</span>
      </a>
      <div id="student_rooms" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <hr style="padding-top: 0; padding-bottom: 0; margin-top: 0; margin-bottom: 0;">
          <a class="collapse-item" href="/accommodation_facility/studentRooms/1E">Form 1E</a>
          <a class="collapse-item" href="/accommodation_facility/studentRooms/1W">Form 1W</a>
          <hr style="padding-top: 0; padding-bottom: 0; margin-top: 0; margin-bottom: 0;">
          <a class="collapse-item" href="/accommodation_facility/studentRooms/2E">Form 2E</a>
          <a class="collapse-item" href="/accommodation_facility/studentRooms/2W">Form 2W</a>
          <hr style="padding-top: 0; padding-bottom: 0; margin-top: 0; margin-bottom: 0;">
          <a class="collapse-item" href="/accommodation_facility/studentRooms/3E">Form 3E</a>
          <a class="collapse-item" href="/accommodation_facility/studentRooms/3W">Form 3W</a>
          <hr style="padding-top: 0; padding-bottom: 0; margin-top: 0; margin-bottom: 0;">
          <a class="collapse-item" href="/accommodation_facility/studentRooms/4E">Form 4E</a>
          <a class="collapse-item" href="/accommodation_facility/studentRooms/4W">Form 4W</a>
          <hr style="padding-top: 0; padding-bottom: 0; margin-top: 0; margin-bottom: 0;">
        </div>
      </div>
    </li>


    <li class="nav-item" style=" padding: 0 !important;">
      <a  href="/accommodation_facility/report" target="_blank" class="nav-link">
        <span style="font-size: 15px; margin: 0;">Accommodation report</span>
      </a>
    </li>

     @endif


     @if (Session::get('is_principal'))
            <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#teachers" aria-expanded="true" aria-controls="collapseTwo">
          <span style="font-size: 15px;"><i class="fa fa-user " style="color:black; font-size: 20px; "></i>Teachers</span>
        </a>
        <div id="teachers" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="/teachers_details">Teachers details</a>
            <a class="collapse-item" href="/addTeacher">Add new teacher</a>
            <a class="collapse-item" href="#">Assign roles</a>
          </div>
        </div>
      </li>
     @endif
   
  
  @if (Session::get('is_teacher'))
    <li class="nav-item">
        <a class="nav-link" href="/teachers/myTeachingClasses">
    
          
          <span style="font-size: 15px;"><i  class="fa fa-chalkboard" style="color: black; font-size: 20px;"></i>My Teaching classes</span>
        </a>
      </li>
  @endif

  @if (Session::get('is_principal') || Session::get('is_deputy_principal') || Session::get('is_in_examination_and_student_admission'))
      <!-- Nav Item - Pages Collapse Menu -->
  <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#bookingRequests" aria-expanded="true" aria-controls="collapseTwo">
        <span style="font-size: 15px;"> <i class="fa fa-graduation-cap" style="color: black; font-size: 20px;"></i> Students</span>
      </a>
      <div id="bookingRequests" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <hr style="padding-top: 0; padding-bottom: 0; margin-top: 0; margin-bottom: 0;">
          <a class="collapse-item" href="/add_student">Add new student</a>
          <hr style="padding-top: 0; padding-bottom: 0; margin-top: 0; margin-bottom: 0;">
          <a class="collapse-item" href="/students_details/1E">Form 1E</a>
          <a class="collapse-item" href="/students_details/1W">Form 1W</a>
          <hr style="padding-top: 0; padding-bottom: 0; margin-top: 0; margin-bottom: 0;">
          <a class="collapse-item" href="/students_details/2E">Form 2E</a>
          <a class="collapse-item" href="/students_details/2W">Form 2W</a>
          <hr style="padding-top: 0; padding-bottom: 0; margin-top: 0; margin-bottom: 0;">
          <a class="collapse-item" href="/students_details/3E">Form 3E</a>
          <a class="collapse-item" href="/students_details/3W">Form 3W</a>
          <hr style="padding-top: 0; padding-bottom: 0; margin-top: 0; margin-bottom: 0;">
          <a class="collapse-item" href="/students_details/4E">Form 4E</a>
          <a class="collapse-item" href="/students_details/4W">Form 4W</a>
          <hr style="padding-top: 0; padding-bottom: 0; margin-top: 0; margin-bottom: 0;">
  
          @if (Session::get('is_principal') || Session::get('is_deputy_principal'))
            <a class="collapse-item" href="/students/alumni">Alumni</a>
          @endif
         
          <!--  <a class="collapse-item" href="ViewLocalBookings.jsp">Local use requests</a>-->
        </div>
      </div>
    </li>

      
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#communications" aria-expanded="true" aria-controls="collapseUtilities">
        <span style="font-size: 15px;" ><i class="fa fa-sms" style="color: black; font-size: 20px;"></i>Communications</span>
      </a>
      <div id="communications" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          
            <a class="collapse-item" href="/Communications/Form1">Form 1</a>        
          
          <a class="collapse-item" href="/Communications/Form2">Form 2</a>
          
          <a class="collapse-item" href="/Communications/Form3">Form 3</a>
          
            <a class="collapse-item" href="/Communications/Form4">Form 4</a>
          
        </div>
      </div>
    </li>
  
  @endif
  

  @if (Session::get('is_principal') || Session::get('is_deputy_principal'))
        <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <span style="font-size: 15px;"><i class="fa fa-user " style="color:black; font-size: 20px; "></i>Non teaching staff</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
          
            <a class="collapse-item" href="/nonTeachingStaffDetails">All staff</a>
            <a class="collapse-item" href="/addStaff">Add new</a>
            <a class="collapse-item" href="/alumniStaff">Alumni staff</a>
          </div>
        </div>
      </li>
  @endif
  



  @if (Session::get('is_principal') || Session::get('is_deputy_principal'))

      <!-- Nav Item - Pages Collapse Menu Fee structures-->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#feeStructure" aria-expanded="true" aria-controls="collapseTwo">
          <span style="font-size: 15px;">Fee structures</span>
        </a>
        <div id="feeStructure" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
          
            @if (Session::get('is_principal'))
                <a class="collapse-item" href="/new_fee_structure">Add new</a>
            @endif
            
            <a class="collapse-item" href="/current_fee_structures">Current fee structure</a>
            <a class="collapse-item" href="/all_fee_structures">All fee structures</a>
          </div>
        </div>
      </li>
  
      <!-- Nav Item - Pages Collapse Menu term sessions-->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#term_sessions" aria-expanded="true" aria-controls="collapseTwo">
          <span style="font-size: 15px;">Term sessions</span>
        </a>
        <div id="term_sessions" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
          
            <a class="collapse-item" href="/term_sessions/current_session">Current session</a>
            <a class="collapse-item" href="/term_sessions/others">Others</a>
          </div>
        </div>
      </li>
      
  @endif
    

  @if (Session::get('is_teacher'))
      
         <!-- Nav Item - Pages Collapse Menu -->
  <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#marks_entry" aria-expanded="true" aria-controls="collapseTwo">
        <span style="font-size: 15px;"><i class="fa fa-edit" style="color: black; font-size: 20px;"></i>Marks Entry</span>
      </a>
      <div id="marks_entry" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <hr style="padding-top: 0; padding-bottom: 0; margin-top: 0; margin-bottom: 0;">
          <a class="collapse-item" href="/marks_entry/1E">Form 1E</a>
          <a class="collapse-item" href="/marks_entry/1W">Form 1W</a>
          <hr style="padding-top: 0; padding-bottom: 0; margin-top: 0; margin-bottom: 0;">
          <a class="collapse-item" href="/marks_entry/2E">Form 2E</a>
          <a class="collapse-item" href="/marks_entry/2W">Form 2W</a>
          <hr style="padding-top: 0; padding-bottom: 0; margin-top: 0; margin-bottom: 0;">
          <a class="collapse-item" href="/marks_entry/3E">Form 3E</a>
          <a class="collapse-item" href="/marks_entry/3W">Form 3W</a>
          <hr style="padding-top: 0; padding-bottom: 0; margin-top: 0; margin-bottom: 0;">
          <a class="collapse-item" href="/marks_entry/4E">Form 4E</a>
          <a class="collapse-item" href="/marks_entry/4W">Form 4W</a>
          <hr style="padding-top: 0; padding-bottom: 0; margin-top: 0; margin-bottom: 0;">
  
          <!--  <a class="collapse-item" href="ViewLocalBookings.jsp">Local use requests</a>-->
        </div>
      </div>
    </li>
  

  @endif

    

  @if (Session::get('is_principal') || Session::get('is_deputy_principal') || Session::get('is_in_examination_and_student_admission'))
      
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#merit_lists" aria-expanded="true" aria-controls="collapseUtilities">
          <span style="font-size: 15px;" ><i class="fa fa-receipt" style="color: black; font-size: 20px;"></i>Merit lists</span>
        </a>
        <div id="merit_lists" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <hr>
              <a class="collapse-item" href="/viewMeritListForm1">Form 1</a>        
            <hr>
            <a class="collapse-item" href="/viewMeritListForm2">Form 2</a>
            <hr>
            <a class="collapse-item" href="/viewMeritListForm3">Form 3</a>
            <hr>
              <a class="collapse-item" href="/viewMeritListForm4">Form 4</a>
            <hr>
          </div>
        </div>
      </li>
  
      <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#report_forms" aria-expanded="true" aria-controls="collapseUtilities">
            <span style="font-size: 15px;"><i class="fa fa-receipt" style="color: black; font-size: 20px;"></i>Result Slips</span>
          </a>
          <div id="report_forms" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <hr>
                <a class="collapse-item" href="/report_forms/1E">Form 1E</a>
                <a class="collapse-item" href="/report_forms/1W">Form 1W</a>            
              <hr>
              <a class="collapse-item" href="/report_forms/2E">Form 2E</a>
              <a class="collapse-item" href="/report_forms/2W">Form 2W</a>
              <hr>
              <a class="collapse-item" href="/report_forms/3E">Form 3E</a>
              <a class="collapse-item" href="/report_forms/3W">Form 3W</a>
              <hr>
                <a class="collapse-item" href="/report_forms/4E">Form 4E</a>
              <a class="collapse-item" href="/report_forms/4W">Form 4W</a>
              <hr>
            </div>
          </div>
        </li>
  @endif
    


  @if (Session::get('is_teacher'))
  <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#disciplinary" aria-expanded="true" aria-controls="collapseUtilities">
        <span style="font-size: 15px;">Disciplinary</span>
      </a>
      <div id="disciplinary" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          @if (Session::get('is_principal') || Session::get('is_deputy_principal'))
            <hr style="padding-top: 0; padding-bottom: 0; margin-top: 0; margin-bottom: 0;">
            <a class="collapse-item" href="/disciplinary/cases/current_cases">Current cases</a>
          @endif
          
          <hr style="padding-top: 0; padding-bottom: 0; margin-top: 0; margin-bottom: 0;">
            <a class="collapse-item" href="/disciplinary/1E">Form 1E</a>
            <a class="collapse-item" href="/disciplinary/1W">Form 1W</a>            
          <hr style="padding-top: 0; padding-bottom: 0; margin-top: 0; margin-bottom: 0;">
          <a class="collapse-item" href="/disciplinary/2E">Form 2E</a>
          <a class="collapse-item" href="/disciplinary/2W">Form 2W</a>
          <hr style="padding-top: 0; padding-bottom: 0; margin-top: 0; margin-bottom: 0;">
          <a class="collapse-item" href="/disciplinary/3E">Form 3E</a>
          <a class="collapse-item" href="/disciplinary/3W">Form 3W</a>
          <hr style="padding-top: 0; padding-bottom: 0; margin-top: 0; margin-bottom: 0;">
            <a class="collapse-item" href="/disciplinary/4E">Form 4E</a>
          <a class="collapse-item" href="/disciplinary/4W">Form 4W</a>
          <hr style="padding-top: 0; padding-bottom: 0; margin-top: 0; margin-bottom: 0;">
        </div>
      </div>
    </li>
  @endif

      
  <!-- Divider -->
  <hr class="sidebar-divider">

   
  
  

  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>
<!-- End of Sidebar -->

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

  <!-- Main Content -->
  <div id="content">

    <!-- Topbar -->
    <nav style="height: 40px;" class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

      <!-- Sidebar Toggle (Topbar) -->
      <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
      </button>

      <!-- Topbar Search -->
      
      <!-- Topbar Navbar -->
      <ul class="navbar-nav ml-auto">
      <li class="nav-l"></li>

        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
        <li class="nav-item dropdown no-arrow d-sm-none">
          <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-search fa-fw"></i>
          </a>
          <!-- Dropdown - Messages -->
          <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
            <form class="form-inline mr-auto w-100 navbar-search">
              <div class="input-group">
                <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                <div class="input-group-append">
                  <button class="btn btn-primary" type="button">
                    <i class="fas fa-search fa-sm"></i>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </li>

        

        <!-- Nav Item - Messages -->
        <li class="nav-item dropdown no-arrow mx-1">
          <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
           <!-- <i class="fas fa-envelope fa-fw"></i> --> 
            <!-- Counter - Messages -->
            <!-- <span class="badge badge-danger badge-counter">7</span> -->
          </a>
          <!-- Dropdown - Messages -->
        
        </li>

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            


            <span class=" " style="color: green;">{{ session::get('username')}}</span>

            @if (session::get('profile_pic') != null)
                <img class="img-profile rounded-circle" src="{{URL::asset('images/'.session::get('profile_pic'))}}"> 
            @else
            <img class="img-profile rounded-circle" src="{{URL::asset('images/default_profile_pic.png')}}"> 

            @endif
            <!-- <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60"> -->
          </a>
          <!-- Dropdown - User Information -->
          <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
             <a class="dropdown-item" href="/users/profile">
               <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
              Profile
            </a>
            <a class="dropdown-item" href="/settings/change_password">
              <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
              Settings
            </a>
            <!--<a class="dropdown-item" href="#">
              <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
              Activity Log
            </a> 
          -->
           <!--
             <div class="dropdown-divider"></div>
         
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="">
            <span class="focus-input100" data-placeholder="&#xf191;"></span>
              Change password
            </a> -->
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="/users/logout">
              <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
              Logout
            </a>
            <div class="dropdown-divider"></div>
            
          </div>
        </li>

      </ul>

    </nav>
    <!-- End of Topbar -->

    <!-- Begin Page Content -->
    <div class="container-fluid">
      <div id="page-wrapper">
        <div id="page-inner">
 <!-- get the username-->
            @yield('content')

        </div>
      </div>


    </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer style="align: bottom; margin-top: 30%;" class="sticky-footer bg-white static-bottom">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span><!-- Copyright &copy; --> Shiners high school management system</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Bootstrap core JavaScript-->
  <script src=" {{ URL::asset('dash/vendor/jquery/jquery.min.js') }} "></script>
  <script src=" {{ URL::asset('dash/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

  <!-- Core plugin JavaScript-->
  <script src=" {{ URL::asset('dash/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

  <!-- Custom scripts for all pages-->
  <script src=" {{ URL::asset('dash/js/sb-admin-2.min.js') }}"></script>
  <script src=" {{ URL::asset('adminLTE/js/jquery.min.js') }}"></script>
  <script src=" {{ URL::asset('adminLTE/js/sparkline.js') }}"></script>

  <script src=" {{ URL::asset('adminLTE/js/jquery.vmap.min.js') }}"></script>
  <script src=" {{ URL::asset('adminLTE/js/daterangepicker.js') }}"></script>


  <script src=" {{ URL::asset('adminLTE/js/jquery.vmap.usa.js') }}"></script>
  <script src=" {{ URL::asset('adminLTE/js/jquery.knob.min.js') }}"></script>


  <script src=" {{ URL::asset('adminLTE/js/moment.min.js') }}"></script>
  <script src=" {{ URL::asset('adminLTE/js/tempusdominus-bootstrap-4.min.js') }}"></script>

  <script src=" {{ URL::asset('adminLTE/js/jquery-ui.min.js') }}"></script>


  <script src=" {{ URL::asset('adminLTE/js/summernote-bs4.min.js') }}"></script>
  <script src=" {{ URL::asset('adminLTE/js/jquery.overlayScrollbars.min.js') }}"></script>
  <script src=" {{ URL::asset('adminLTE/js/dashboard.js') }}"></script>

  <script src=" {{ URL::asset('adminLTE/js/demo.js') }}"></script>
  <script src=" {{ URL::asset('adminLTE/js/adminlte.js') }}"></script>


  <!-- Page level plugins -->
  <script src=" {{ URL::asset('dash/vendor/chart.js/Chart.min.js') }}"></script>

  <!-- Page level custom scripts -->
  <script src=" {{ URL::asset('dash/js/demo/chart-area-demo.js') }}"></script>
  <script src=" {{ URL::asset('dash/js/demo/chart-pie-demo.js') }}"></script>

  <!-- script for showing or hiding parents forms -->
  <script src=" {{ URL::asset('show_hide_script.js') }}"></script>

   <!-- script for validating parent forms -->
   <script src=" {{ URL::asset('validate_parent.js') }}"></script>

  <!-- script for validating student forms -->
   <script src=" {{ URL::asset('validate_student.js') }}"></script>
  
  <!-- script for validating address form -->
  <script src=" {{ URL::asset('validate_address.js') }}"></script>
	
  
  <!-- script for validating teacher form -->
  <script src=" {{ URL::asset('validate_teacher.js') }}"></script>

  <!-- script for validating teacher form -->
  <script src=" {{ URL::asset('validate_staff.js') }}"></script>

  <!-- script for validating change password form -->
  <script src=" {{ URL::asset('validate_passwords.js') }}"></script>

  <script src=" {{ URL::asset('validate_new_dorm.js') }}"></script>
  <script src=" {{ URL::asset('validate_dorm_edit.js') }}"></script>

  <!-- including script that performs different general functions -->
  <script src=" {{ URL::asset('general_script.js') }}"></script>

    <!-- including script that validate students marks-->
    <script src=" {{ URL::asset('validate_marks.js') }}"></script>

    <!-- including script that validate fee structure form-->
    <script src=" {{ URL::asset('validate_fee_structure.js') }}"></script>


    <!-- including script that validate fee update form-->
    <script src=" {{ URL::asset('validate_fee_update.js') }}"></script>

     <!-- including script that validate fee input form-->
     <script src=" {{ URL::asset('validate_fee_input.js') }}"></script>

     <!-- including script that validate dormitory input form-->
     <script src=" {{ URL::asset('validate_dormitories.js') }}"></script>

     <script src=" {{ URL::asset('validate_dormRoom.js') }}"></script>

     <script src=" {{ URL::asset('validate_allocate_room.js') }}"></script>

     <script src=" {{ URL::asset('class_promotion.js') }}"></script>

      <!--script for datatables -->
     <script src=" {{ URL::asset('https://code.jquery.com/jquery-3.4.0.js') }}"></script>

     <script src=" {{ URL::asset('teachers_datatables.js') }}"></script>

     <script src=" {{ URL::asset('https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js') }}"></script>


  
  
</body>
</html>