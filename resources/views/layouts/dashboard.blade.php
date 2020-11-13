<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Shiners High School</title>
  <link href= " {{ URL::asset('vendor/fontawesome-free/css/all.min.css') }} " rel="stylesheet" type="text/css">
  <script src= " {{ URL::asset('https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js') }}"></script>
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ URL::asset('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css') }}">
<link rel="stylesheet" href=" {{ URL::asset('dashboard_styles/fontawesome/all.min.css') }} " type="text/css">
  <!-- IonIcons -->
  <link rel="stylesheet" href=" {{ URL::asset('http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css') }}"type="text/css" >
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ URL::asset('dashboard_styles/css/adminlte.min.css') }}" type="text/css">
  <!-- Google Font: Source Sans Pro -->
  <link href="{{ URL::asset('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700') }}" rel="stylesheet" type="text/css">
  <link rel="stylesheet" type="text/css" href=" {{ URL::asset('css/bootstrap.css') }}">
  {{-- <link rel="stylesheet" type="text/css" href=" {{ URL::asset('css/basic.css') }}"> --}}
  <link rel="stylesheet" type="text/css" href=" {{ URL::asset('https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css') }}">
  <script src = "{{ URL::asset('https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js') }}"></script>
  <!--link for datatables-->
  <link rel="stylesheet" type="text/css" href=" {{ URL::asset('https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css') }}">
  
  <link rel="stylesheet" type="text/css" href=" {{ URL::asset('css/new_styles.css') }}">
  
  <script src=" {{ URL::asset('https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js') }}"></script>
  
  
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to to the body tag
to get the desired effect
|---------------------------------------------------------|
|LAYOUT OPTIONS | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="/docs/help" class="nav-link" style="color:blue;">Need help??</a>
      </li>
      {{-- <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li> --}}
    </ul>

    {{-- <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form> --}}

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

     
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          
          <span style="color: green;">{{Session::get('username')}}</span>
          <span class="badge">

            @if (session::get('profile_pic') != null)
                <img class="img-profile rounded-circle" style="width: 36px; height: 36px;" src="{{URL::asset('images/'.session::get('profile_pic'))}}"> 
            @else
            <img class="img-profile rounded-circle" style="width: 36px; height: 36px;" src="{{URL::asset('images/default_profile_pic.png')}}"> 

            @endif
              
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <div class="dropdown-divider"></div>
          <a href="/users/profile" class="dropdown-item">
            <i class="fas fa-users-cog mr-2"></i> Profile
          </a>
          <div class="dropdown-divider"></div>
          <a href="/settings/change_password" class="dropdown-item">
            <i class="fas fa-cogs fa-sm fa-fw mr-2 "></i> Settings
          </a>
          <div class="dropdown-divider"></div>
          <a href="/users/logout" class="dropdown-item">
            <i class="fas fa-sign-out-alt fa-sm fa-fw "></i> Log out
          </a>
          <div class="dropdown-divider"></div>
        </div>
      </li>
      
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
      {{-- <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8"> --}}
      <strong>Shiners High school</strong>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
                @if (session::get('profile_pic') != null)
                <img class="img-circle elevation-2" style="width: 36px; height: 36px;" src="{{URL::asset('images/'.session::get('profile_pic'))}}" alt="image"> 
            @else
            <img class="img-circle elevation-2"style="width: 36px; height: 36px;" src="{{URL::asset('images/default_profile_pic.png')}}" alt="image"> 

            @endif
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Session::get('username')}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          

               @if(Session::get('is_principal') || Session::get('is_deputy_principal') || Session::get('is_admin'))
               <li class="nav-item">
                    <a href="/admin/dashboard" class="nav-link active">
                      <i class="nav-icon fas fa-tachometer-alt"></i>
                      <p>
                       
                        Dashboard
                        <span class="right badge badge-danger"></span>
                      </p>
                    </a>
                  </li>
                @endif

                @if(Session::get('is_parent'))
               <li class="nav-item">
                    <a href="/parents/children/{{Session::get('parent_id')}}" class="nav-link active">
                      <i class="nav-icon fas fa-child"></i>
                      <p>
                       
                        Children
                        <span class="right badge badge-danger"></span>
                      </p>
                    </a>
                  </li>
                @endif

                @if(Session::get('is_normal_teacher') && (!Session::get('is_boarding_master')))
                <li class="nav-item">
                        <a href="/teachers/dashboard" class="nav-link active">
                          <i class="nav-icon fas fa-tachometer-alt"></i>
                          <p>
                            Dashboard
                            <span class="right badge badge-danger"></span>
                          </p>
                        </a>
                      </li>
                @endif


                @if (Session::get('staff_category') == "bursar")
                 <li class="nav-item">
                    <a href="/finance_department" class="nav-link active">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                        <span class="right badge badge-danger"></span>
                    </p>
                    </a>
                </li>

                <!--links for taking fees-->
                <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-dollar-sign"></i>
                          <p>
                            Take fees
                            <i class="right fas fa-angle-right"></i>
                          </p>
                        </a>
                        <ul class="nav nav-treeview">
                          
                          <li class="nav-item">
                            <a href="/finance_department/take_fees/1E" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Form 1E</p>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="/finance_department/take_fees/1W" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Form 1W</p>
                            </a>
                          </li>
            
                          <li class="nav-item">
                            <a href="/finance_department/take_fees/2E" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Form 2E</p>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="/finance_department/take_fees/2W" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Form 2W</p>
                            </a>
                          </li>
            
                          <li class="nav-item">
                            <a href="/finance_department/take_fees/3E" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Form 3E</p>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="/finance_department/take_fees/3W" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Form 3W</p>
                            </a>
                          </li>
            
                          <li class="nav-item">
                            <a href="/finance_department/take_fees/4E" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Form 4E</p>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="/finance_department/take_fees/4W" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Form 4W</p>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="/finance_department/alumni/take_fees/" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Alumni</p>
                            </a>
                          </li>
                        </ul>
                      </li>

                      <!--links for fee balances-->
                <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-money"></i>
                          <p>
                            Fees Balances
                            <i class="right fas fa-angle-right"></i>
                          </p>
                        </a>
                        <ul class="nav nav-treeview">
                          
                          <li class="nav-item">
                            <a href="/finance_department/fee_balances/1E" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Form 1E</p>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="/finance_department/fee_balances/1W" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Form 1W</p>
                            </a>
                          </li>
            
                          <li class="nav-item">
                            <a href="/finance_department/fee_balances/2E" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Form 2E</p>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="/finance_department/fee_balances/2W" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Form 2W</p>
                            </a>
                          </li>
            
                          <li class="nav-item">
                            <a href="/finance_department/fee_balances/3E" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Form 3E</p>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="/finance_department/fee_balances/3W" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Form 3W</p>
                            </a>
                          </li>
            
                          <li class="nav-item">
                            <a href="/finance_department/fee_balances/4E" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Form 4E</p>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="/finance_department/fee_balances/4W" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Form 4W</p>
                            </a>
                          </li>
                        </ul>
                      </li>

                      <!--links for Clean students-->
                <li class="nav-item has-treeview">
                  <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-money"></i>
                    <p>
                      Clean students
                      <i class="right fas fa-angle-right"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    
                    <li class="nav-item">
                      <a href="/finance_department/clean_students/form1" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Form 1</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="/finance_department/clean_students/form2" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Form 2</p>
                      </a>
                    </li>
      
                    <li class="nav-item">
                      <a href="/finance_department/clean_students/form3" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Form 3</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="/finance_department/clean_students/form4" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Form 4</p>
                      </a>
                    </li>     
                    
                  </ul>
                </li>

                 <!--links for fee statements-->
                 <li class="nav-item has-treeview">
                  <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-money"></i>
                    <p>
                      Fees Statements
                      <i class="right fas fa-angle-right"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    
                    <li class="nav-item">
                      <a href="/finance_department/fee_statements/1E" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Form 1E</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="/finance_department/fee_statements/1W" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Form 1W</p>
                      </a>
                    </li>
      
                    <li class="nav-item">
                      <a href="/finance_department/fee_statements/2E" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Form 2E</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="/finance_department/fee_statements/2W" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Form 2W</p>
                      </a>
                    </li>
      
                    <li class="nav-item">
                      <a href="/finance_department/fee_statements/3E" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Form 3E</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="/finance_department/fee_statements/3W" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Form 3W</p>
                      </a>
                    </li>
      
                    <li class="nav-item">
                      <a href="/finance_department/fee_statements/4E" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Form 4E</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="/finance_department/fee_statements/4W" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Form 4W</p>
                      </a>
                    </li>

                    <li class="nav-item">
                        <a href="/finance_department/alumni/fee_statement" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Alumni</p>
                        </a>
                      </li>
                  </ul>
                </li>

                 <!--links for fee statements-->
                 <li class="nav-item has-treeview">
                  <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-money"></i>
                    <p>
                      Reports
                      <i class="right fas fa-angle-right"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">

                      <li class="nav-item">
                          <a href="/finance_department/reports" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>General class Report</p>
                          </a>
                        </li>
                    
                    <li class="nav-item">
                      <a href="/finance_department/fee_transactions/reports" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Fee transactions</p>
                      </a>
                    </li>
                    
                  </ul>
                </li>


                

                @endif

                <!-- links for boarding master-->
                @if (Session::get('is_boardingMaster'))

                <li class="nav-item">
                  <a href="/accommodation_facility/dashboard" class="nav-link active">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                      Dashboard
                      <span class="right badge badge-danger"></span>
                    </p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="/accommodation_facility/dormitories" class="nav-link">
                    <i class="nav-icon fas fa-home"></i>
                    <p>
                      Dormitories
                      <span class="right badge badge-danger"></span>
                    </p>
                  </a>
                </li>

                <!--links for fee statements-->
                <li class="nav-item has-treeview">
                  <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-money"></i>
                    <p>
                      Student rooms
                      <i class="right fas fa-angle-right"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    
                    <li class="nav-item">
                      <a href="/accommodation_facility/studentRooms/1E" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Form 1E</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="/accommodation_facility/studentRooms/1W" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Form 1W</p>
                      </a>
                    </li>
      
                    <li class="nav-item">
                      <a href="/accommodation_facility/studentRooms/2E" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Form 2E</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="/accommodation_facility/studentRooms/2W" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Form 2W</p>
                      </a>
                    </li>
      
                    <li class="nav-item">
                      <a href="/accommodation_facility/studentRooms/3E" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Form 3E</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="/accommodation_facility/studentRooms/3W" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Form 3W</p>
                      </a>
                    </li>
      
                    <li class="nav-item">
                      <a href="/accommodation_facility/studentRooms/4E" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Form 4E</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="/accommodation_facility/studentRooms/4W" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Form 4W</p>
                      </a>
                    </li>
                  </ul>
                </li>

                <li class="nav-item">
                  <a href="/accommodation_facility/report" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Accomodation Report</p>
                  </a>
                </li>

                @endif

                @if (Session::get('is_principal'))

                <li class="nav-item has-treeview">
                  <a href="#" class="nav-link">
                    <i class="nav-icon fa fa-user"></i>
                    <p>
                      Teachers
                      <i class="fas fa-angle-right right"></i>
                      <span class="badge badge-info right"></span>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <a href="/teachers_details" class="nav-link">
                        <p>Teachers details</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="/addTeacher" class="nav-link">
                        <p>Add new teacher</p>
                      </a>
                    </li>

                    <li class="nav-item">
                      <a href="/teachers/archived" class="nav-link">
                        <p>Archived teachers</p>
                      </a>
                    </li>
                    
                  </ul>
                </li>

                @endif
         
                @if (Session::get('is_teacher'))
                <li class="nav-item">
                  <a href="/teachers/myTeachingClasses" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                      My teaching classes
                      <span class="right badge badge-danger"></span>
                    </p>
                  </a>
                </li>

                @endif

                @if (Session::get('is_principal') || Session::get('is_deputy_principal') || Session::get('is_in_examination_and_student_admission'))
                <li class="nav-item has-treeview">
                  <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-user"></i>
                    <p>
                      Students
                      <i class="right fas fa-angle-right"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <a href="/add_student" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Add new student</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="/students_details/1E" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Form 1E</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="/students_details/1W" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Form 1W</p>
                      </a>
                    </li>
      
                    <li class="nav-item">
                      <a href="/students_details/2E" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Form 2E</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="/students_details/2W" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Form 2W</p>
                      </a>
                    </li>
      
                    <li class="nav-item">
                      <a href="/students_details/3E" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Form 3E</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="/students_details/3W" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Form 3W</p>
                      </a>
                    </li>
      
                    <li class="nav-item">
                      <a href="/students_details/4E" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Form 4E</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="/students_details/4W" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Form 4W</p>
                      </a>
                    </li>

                    @if (Session::get('is_principal') || Session::get('is_deputy_principal'))
                    
                    <li class="nav-item">
                      <a href="/students/outOfSession" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Out of session</p>
                      </a>
                    </li>

                      <li class="nav-item">
                        <a href="/students/alumni" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Alumni</p>
                        </a>
                      </li>

                      <li class="nav-item">
                        <a href="/students/reports" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Reports</p>
                        </a>
                      </li>
                    @endif
                  </ul>
                </li>

                <li class="nav-item">
                  <a href="/students/parents" class="nav-link">
                    <i class="nav-icon fas fa-user-friends"></i>
                    <p>
                      Students parents
                      <span class="right badge badge-danger"></span>
                    </p>
                  </a>
                </li>
                
                @endif
          

                @if (Session::get('is_principal') || Session::get('is_deputy_principal'))
                <!--LINKS FOR COMMUNICATION -->
                <li class="nav-item has-treeview">
                  <a href="#" class="nav-link">
                    <i class="nav-icon fa fa-envelope"></i>
                    <p>
                      Communications
                      <i class="fas fa-angle-right right"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <a href="/communications/Form1" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Form 1</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="/communications/Form2" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Form 2</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="/communications/Form3" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Form 3</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="/communications/Form4" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Form 4</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="/communications/general/report" class="nav-link">
                        <i class="fa fa-print nav-icon"></i>
                        <p>Report</p>
                      </a>
                    </li>
                    </li>
                  </ul>
                </li>

                <li class="nav-item has-treeview">
                  <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-user-friends"></i>
                    <p>
                      Non teaching staff
                      <i class="fas fa-angle-right right"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <a href="/nonTeachingStaffDetails" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>All staff</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="/addStaff" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Add new</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="/alumniStaff" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Alumni</p>
                      </a>
                    </li>
                  </ul>
                </li>

                <li class="nav-item has-treeview">
                  <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-table"></i>
                    <p>
                      Fee structures
                      <i class="fas fa-angle-right right"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">

                      @if (Session::get('is_principal'))
                        <li class="nav-item">
                            <a href="/new_fee_structure" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Add new</p>
                            </a>
                          </li>
                    @endif
                    
                    <li class="nav-item">
                      <a href="/current_fee_structures" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Current fee structure</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="/all_fee_structures" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>All fee structures</p>
                      </a>
                    </li>
                  </ul>
                </li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                      <i class="nav-icon fas fa-table"></i>
                      <p>
                        Term sessions
                        <i class="fas fa-angle-right right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="/term_sessions/new" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Add new session</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="/term_sessions/current_session" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Current session</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="/term_sessions/older" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Older</p>
                        </a>
                      </li>
                    </ul>
                  </li>


                @endif
          

                @if (Session::get('is_teacher'))

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                      <i class="nav-icon far fa-edit"></i>
                      <p>
                        Marks Entry
                        <i class="fas fa-angle-right right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="/marks_entry/1E" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Form 1E</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="/marks_entry/1W" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Form 1W</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="/marks_entry/2E" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Form 2E</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="/marks_entry/2W" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Form 2W</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="/marks_entry/3E" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Form 3E</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="/marks_entry/3W" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Form 3W</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="/marks_entry/4E" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Form 4E</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="/marks_entry/4W" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Form 4W</p>
                        </a>
                      </li>
                    </ul>
                  </li>


                @endif
          

                @if (Session::get('is_principal') || Session::get('is_deputy_principal') || Session::get('is_in_examination_and_student_admission'))
                  
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                      <i class="nav-icon fa fa-list-ol"></i>
                      <p>
                        Merit Lists
                        <i class="fas fa-angle-right right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                     <li class="nav-item">
                        <a href="/viewMeritListForm1" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Form 1</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="/viewMeritListForm2" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Form 2</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="/viewMeritListForm3" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Form 3</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="/viewMeritListForm4" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Form 4</p>
                        </a>
                      </li>
                    </ul>
                  </li>


                  <li class="nav-item has-treeview">
                      <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                          Result slips
                          <i class="fas fa-angle-right right"></i>
                        </p>
                      </a>
                      <ul class="nav nav-treeview">
                       <li class="nav-item">
                          <a href="/report_forms/1E" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Form 1E</p>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="/report_forms/1W" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Form 1W</p>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="/report_forms/2E" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Form 2E</p>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="/report_forms/2W" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Form 2W</p>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="/report_forms/3E" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Form 3E</p>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="/report_forms/3W" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Form 3W</p>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="/report_forms/4E" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Form 4E</p>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="/report_forms/4W" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Form 4W</p>
                          </a>
                        </li>
                      </ul>
                    </li>

                @endif

                @if (Session::get('is_teacher'))

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                      <i class="nav-icon fa fa-exclamation-circle"></i>
                      <p>
                        Disciplinary
                        <i class="fas fa-angle-right right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                        
                      @if (Session::get('is_principal') || Session::get('is_deputy_principal'))
                      <li class="nav-item">
                          <a href="/disciplinary/cases/current_cases" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Current cases</p>
                          </a>
                        </li>

                      @endif
                      <li class="nav-item">
                        <a href="/disciplinary/1E" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Form 1E</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="/disciplinary/1W" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Form 1W</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="/disciplinary/2E" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Form 2E</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="/disciplinary/2W" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Form 2W</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="/disciplinary/3E" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Form 3E</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="/disciplinary/3W" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Form 3W</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="/disciplinary/4E" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Form 4E</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="/disciplinary/4W" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Form 4W</p>
                        </a>
                      </li>

                      @if (Session::get('is_principal') || Session::get('is_deputy_principal'))
                      <li class="nav-item">
                          <a href="/disciplinary_cases/reports" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Report</p>
                          </a>
                        </li>

                      @endif
                      
                      
                    </ul>
                  </li>

                @endif
         
         
          


         
          

          {{-- <li class="nav-item">
            <a href="pages/calendar.html" class="nav-link">
              <i class="nav-icon fas fa-calendar-alt"></i>
              <p>
                Calendar
                <span class="badge badge-info right">2</span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="pages/gallery.html" class="nav-link">
              <i class="nav-icon far fa-image"></i>
              <p>
                Gallery
              </p>
            </a>
          </li> --}}
          
          
          
          
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    {{-- <div class="content-header" >
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <p class="m-0 text-dark">Dashboard v3</p>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="">{{  request()->path()}}</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div> --}}
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content" >
      <div class="container-fluid">
        <div id="page-inner">
 <!-- get the username-->
            @yield('content')

        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  {{-- <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside> --}}
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2020 <a href="#">Shiners high school</a>.</strong>
    All rights reserved.
   
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{ URL::asset('dashboard_styles/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ URL::asset('dashboard_styles/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE -->
<script src="{{ URL::asset('dashboard_styles/js/adminlte.js') }}"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="{{ URL::asset('dashboard_styles/js/Chart.min.js') }}"></script>
<script src="{{ URL::asset('dashboard_styles/js/demo.js') }}"></script>
<script src="{{ URL::asset('dashboard_styles/js/dashboard3.js') }}"></script>

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

 <script src=" {{ URL::asset('checkRegistrationData.js') }}"></script>


 <!-- including script that validate fee update form-->
 <script src=" {{ URL::asset('validate_fee_update.js') }}"></script>

  <!-- including script that validate fee input form-->
  <script src=" {{ URL::asset('validate_fee_input.js') }}"></script>

  <!-- including script that validate dormitory input form-->
  <script src=" {{ URL::asset('validate_dormitories.js') }}"></script>

  <script src=" {{ URL::asset('validate_dormRoom.js') }}"></script>

  <script src=" {{ URL::asset('validate_allocate_room.js') }}"></script>

  <script src=" {{ URL::asset('class_promotion.js') }}"></script>
  <script src=" {{ URL::asset('validate_feePayInput.js') }}"></script>

   <!--script for datatables -->
  <script src=" {{ URL::asset('https://code.jquery.com/jquery-3.4.0.js') }}"></script>

  <script src=" {{ URL::asset('teachers_datatables.js') }}"></script>

  <script src=" {{ URL::asset('https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js') }}"></script>


</body>
</html>