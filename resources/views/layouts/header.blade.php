<!DOCTYPE html>
<html lang="en">
<head>
	<title>School management system</title>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

  <link href= " {{ URL::asset('dash/vendor/fontawesome-free/css/all.min.css') }} " rel="stylesheet" type="text/css">
  <link href= " {{ URL::asset(' https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i') }}" rel="stylesheet">
 
<link rel="stylesheet" type="text/css" href=" {{ URL::asset('css/bootstrap.css') }}">

<link rel="stylesheet" type="text/css" href=" {{ URL::asset('css/new_styles.css') }}">
<link rel="stylesheet" type="text/css" href=" {{ URL::asset('css/basic.css') }}">
<link rel="stylesheet" type="text/css" href=" {{ URL::asset('bootstrap4/css/bootstrap.min.css') }}">
<link rel="stylesheet" type="text/css" href=" {{ URL::asset('mdbootstrap/css/bootstrap.min.css') }}">
<link rel="stylesheet" href=" {{ URL::asset('https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css') }}" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src=" {{ URL::asset('https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js') }}" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<link href="{{ URL::asset('https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.11.0/css/mdb.min.css') }}" rel="stylesheet">
</head>
<body>


<nav class="navbar navbar-expand-lg navbar-dark  navbar-fixed fixed-top " style="overflow: hidden; background-color: grey;" >
        <a class="navbar-brand" href="#">SHINERS HIGH SCHOOL</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="#">About </a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="#">Contact</a>
            </li>
          </ul>
          <span class="navbar-text">
            <a href="/signin"  style="padding-right: 30px;">Login</a>

            <a href="/forgotPassword"  style="padding-right: 30px;">Forgot password?</a>
          </span>
        </div>
      </nav>

      <div>
          @yield('content')

      </div>


      <!-- Footer -->
<footer class="page-footer font-small blue-grey lighten-5">


  <!-- Footer Links -->
  <div class="container text-center text-md-left mt-5" style=" padding-top: 20px;" >

    <!-- Grid row -->
    <div class="row mt-3 dark-grey-text">

      <!-- Grid column -->
      <div class="col-md-3 col-lg-4 col-xl-3 mb-4">

        <!-- Content -->
        <h6 class="text-uppercase font-weight-bold">School MOTTO</h6>
        <hr class="teal accent-3 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
        <p style=" color:black; font-size:">
          
          Strive For Excellence
        </p>

      </div>
      <!-- Grid column -->

      <!-- Grid column -->
      <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">

        <!-- Links -->
        <h6 class="text-uppercase font-weight-bold">School Vision</h6>
        <hr class="teal accent-3 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
        <p>
          To Be a model school of excellence both in academic and character building
        </p>

      </div>
      <!-- Grid column -->

      <!-- Grid column -->
      <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">

        <!-- Links -->
        <h6 class="text-uppercase font-weight-bold">School Mission</h6>
        <hr class="teal accent-3 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
        <p>
          To facilitate Teaching, Learning and 
          pprovide Guidance and Counselling Based on Spiritual Teaching
          To come up with an all Round person
        </p>
        

      </div>
      <!-- Grid column -->

      <!-- Grid column -->
      <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">

        <!-- Links -->
        <h6 class="text-uppercase font-weight-bold">Contact us</h6>
        <hr class="teal accent-3 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
        <p>
          <i class="fas fa-home mr-3"></i> Njoro, 73-10012, KENYA</p>
        <p>
          <i class="fas fa-envelope mr-3"></i> shinersschool@info.co.ke</p>
        <p>
          <i class="fas fa-phone mr-3"></i> + 254 789 966 212</p>
        <p>
          <i class="fas fa-print mr-3"></i> + 254 703 838 823</p>

      </div>
      <!-- Grid column -->

    </div>
    <!-- Grid row -->

  </div>
  <!-- Footer Links -->

  <!-- Copyright -->
  <div class="footer-copyright text-center text-black-50 py-3">© 2020 Copyright:
    <a class="dark-grey-text" href="#"> Shiners School</a>
  </div>
  <!-- Copyright -->

</footer>
<!-- Footer -->


      {{-- <!-- Footer -->
<footer class="page-footer font-small grey sticky-footer fixed-bottom"  >

        <!-- Copyright -->
        <div class="footer-copyright text-center py-3" style="color: #fff;">© 2020 Copyright:
          Shiners high school management system
        </div>
        <!-- Copyright -->
      
      </footer>
      <!-- Footer --> --}}

    
          <!-- End of Footer -->
      <script src="{{  URL::asset('mdbootstrap/js/bootstrap.min.js') }}"></script>

      <script src="{{  URL::asset('bootstrap4/js/bootstrap.min.js') }}"></script>
      <script src="{{  URL::asset('validate_login.js') }}"></script>
      <script src="{{  URL::asset('validate_code.js') }}"></script>
      <script src="{{  URL::asset('updatePassword_validate.js') }}"></script>



      <script src="{{  URL::asset('https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js') }}"></script>
</body>
</html>

