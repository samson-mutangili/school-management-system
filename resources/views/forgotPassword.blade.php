
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login V2</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href=" {{ URL::asset('login/images/icons/favicon.ico') }}"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href=" {{ URL::asset('login/vendor/bootstrap/css/bootstrap.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href=" {{ URL::asset('login/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href=" {{ URL::asset('login/fonts/iconic/css/material-design-iconic-font.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href=" {{ URL::asset('login/vendor/animate/animate.css') }}">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href=" {{ URL::asset('login/vendor/css-hamburgers/hamburgers.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href=" {{ URL::asset('login/vendor/animsition/css/animsition.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href=" {{ URL::asset('login/vendor/select2/select2.min.css') }}">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href=" {{ URL::asset('login/vendor/daterangepicker/daterangepicker.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href=" {{ URL::asset('login/css/util.css') }}">
	<link rel="stylesheet" type="text/css" href=" {{ URL::asset('login/css/main.css') }}">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">

				<div style="margin-top: 15px;">
                    @if ( Session::get('password_reset_successfully') != null)
                
                    <div class="alert alert-success alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Success</strong> : {{ Session::get('password_reset_successfully')}}
                    </div>
                
                    @endif
                </div>  

                <div style="margin-top: 15px;">
                    @if ( Session::get('no_internet') != null)
                
                    <div class="alert alert-danger alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Failed</strong> : {{ Session::get('no_internet')}}
                    </div>
                
                    @endif
                </div>  

				
				<form action="/forgot_password_submit" method="post" class="login100-form validate-form" name="forgot_password_form">
					@csrf
					<span class="login100-form-title p-b-26">
						Reset password
					</span>
					
                    <p style="color: black; margin-bottom: 25px;"> Whoops!! Do not worry. Just a few steps to reset your password.</p>

					<div>
                        
    
                        @if ( Session::get('invalid_user') != null)
                            <p style="color: red;">{{ Session::get('invalid_user')  }}</p>
                        @endif
				 </div>
				 
				 <div class="offset-lg-1 offset-xl-1">
					@if( Session::get('no_user') != null)
					<p style="color: red;">{{ Session::get('no_user') }}</p>
					@endif

			 </div>

			 <div class="validate-input" data-validate="Select user category">
				 <label>Select user category</label>
				 <ul>
					 <li>
						 <input type="radio" id="staff" name="user_category" value="staff">
						<label for="staff">Staff</label></li>
					 <li>
						<input type="radio" id="parent" name="user_category" value="parent">
						<label for="parent">Parent</label>
					 </li>
				 </ul>
				 <div id="user_category_error" style="margin-bottom: 15px;"></div>
				 
			 </div>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is: a@b.c" style="margin-bottom: 0; padding-bottom: 0;" >
						<input class="input100" type="email" name="email" id="email" value="{{ Session::get('email') }}" @if(Session::get('email') != null) placeholder="Enter email address" @endif/>
						@if (Session::get('email') == "")
						<span class="focus-input100" data-placeholder="Enter email address"  id="email_div"  data-symbol="&#xf206;"></span>
						
						@else
						
						@endif
					</div>
					<div id="email_error" style="margin-top: 0; padding-top: 0;"></div>
					


					<div class="container-login100-form-btn" style="margin-top: 25px;">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button type="submit" class="login100-form-btn" onclick="return validateLogin()">
								Send
							</button>
						</div>
					</div>

					<div class="text-center p-t-30">
						<p>Are you a staff? Click <a href="/signin" style="color: blue;">here</a> to login</p>
						{{-- <span class="txt1">
							Forgor your password? Click 
						</span>

						<a href="#">
							here
						</a> --}}
					</div>

					<div class="text-center p-t-30">
						<p>Are you a parent? Click <a href="/parentlogin" style="color: blue;">here</a> to log in as a parent</p>
						{{-- <span class="txt1">
							Forgor your password? Click 
						</span>

						<a href="#">
							here
						</a> --}}
					</div>
					<div class="text-center p-t-30">
						 <a href="/" style="color: blue;">Back home</a>
						{{-- <span class="txt1">
							Forgor your password? Click 
						</span>

						<a href="#">
							here
						</a> --}}
					</div>
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src=" {{  URL::asset('login/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
<!--===============================================================================================-->
	<script src=" {{  URL::asset('login/vendor/animsition/js/animsition.min.js') }}"></script>
<!--===============================================================================================-->
	<script src=" {{  URL::asset('login/vendor/bootstrap/js/popper.js') }}"></script>
	<script src=" {{  URL::asset('login/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<!--===============================================================================================-->
	<script src=" {{  URL::asset('login/vendor/select2/select2.min.js') }}"></script>
<!--===============================================================================================-->
	<script src=" {{  URL::asset('login/vendor/daterangepicker/moment.min.js') }}"></script>
	<script src=" {{  URL::asset('login/vendor/daterangepicker/daterangepicker.js') }}"></script>
<!--===============================================================================================-->
	<script src=" {{  URL::asset('login/vendor/countdowntime/countdowntime.js') }}"></script>
<!--===============================================================================================-->
	<script src=" {{  URL::asset('login/js/main.js') }}"></script>

	<script src=" {{  URL::asset('validate_forgotPassword.js') }}"></script>

</body>
</html>