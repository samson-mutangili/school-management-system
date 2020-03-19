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


<nav class="navbar navbar-expand-lg navbar-dark bg-primary navbar-fixed fixed-top " style="overflow: hidden;" >
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
<footer class="page-footer font-small grey sticky-footer fixed-bottom"  >

        <!-- Copyright -->
        <div class="footer-copyright text-center py-3" style="color: #fff;">© 2020 Copyright:
          Shiners high school management system
        </div>
        <!-- Copyright -->
      
      </footer>
      <!-- Footer -->

    
          <!-- End of Footer -->
      <script src="{{  URL::asset('mdbootstrap/js/bootstrap.min.js') }}"></script>

      <script src="{{  URL::asset('bootstrap4/js/bootstrap.min.js') }}"></script>
      <script src="{{  URL::asset('validate_login.js') }}"></script>
      <script src="{{  URL::asset('validate_code.js') }}"></script>
      <script src="{{  URL::asset('updatePassword_validate.js') }}"></script>



      <script src="{{  URL::asset('https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js') }}"></script>
</body>
</html>

