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


</head>
<body id="page-top">
<!-- Page Wrapper -->
<div id="wrapper">

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
  
   <!-- Nav Item - Pages Collapse Menu -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#trips" aria-expanded="true" aria-controls="collapseTwo">
      <span>Teachers</span>
    </a>
    <div id="trips" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
         <a class="collapse-item" href="/teachers_details">Teachers details</a>
        <a class="collapse-item" href="/addTeacher">Add new teacher</a>
        <a class="collapse-item" href="#">Assign roles</a>
      </div>
    </div>
  </li>
  
  <!-- Nav Item - Pages Collapse Menu -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#bookingRequests" aria-expanded="true" aria-controls="collapseTwo">
      <span>Students</span>
    </a>
    <div id="bookingRequests" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="/students_details">Students details</a>
        <a class="collapse-item" href="/add_student">Add new student</a>
        <!--  <a class="collapse-item" href="ViewLocalBookings.jsp">Local use requests</a>-->
      </div>
    </div>
  </li>


  <!-- Nav Item - Pages Collapse Menu -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
      <span>Non teaching staff</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
      
        <a class="collapse-item" href="/nonTeachingStaffDetails">All staff</a>
        <a class="collapse-item" href="/addStaff">Add new</a>
        <a class="collapse-item" href="/alumniStaff">Alumni staff</a>
      </div>
    </div>
  </li>

  <!-- Nav Item - Utilities Collapse Menu -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
      <span>Result slips</span>
    </a>
    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item" href="#">Form 1</a>
        <a class="collapse-item" href="#">Form 2</a>
        <a class="collapse-item" href="#">Form 3</a>
        <a class="collapse-item" href="#">Form 4</a>
        
      </div>
    </div>
  </li>

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
            


            <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ $user_first_name ?? '' }}</span>
            <!-- <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60"> -->
          </a>
          <!-- Dropdown - User Information -->
          <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
             <!--<a class="dropdown-item" href="#">
               <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
              Profile
            </a>
            <a class="dropdown-item" href="#">
              <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
              Settings
            </a>
            <a class="dropdown-item" href="#">
              <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
              Activity Log
            </a> -->
             <div class="dropdown-divider"></div>
          
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="">
            <span class="focus-input100" data-placeholder="&#xf191;"></span>
              Change password
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="">
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
    
    @yield('content')



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

  <!-- including script that performs different general functions -->
  <script src=" {{ URL::asset('general_script.js') }}"></script>
	
</body>
</html>