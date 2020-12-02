<!DOCTYPE html>
<html lang="en">
<head>
	<title>Shiners high school parents login</title>
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
                        @if ( Session::get('password_reset_failed') != null)
                    
                        <div class="alert alert-danger alert-dismissible">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>Failed</strong> : {{ Session::get('password_reset_failed')}}
                        </div>
                    
                        @endif
                    </div>  
				
				<form action="/reset_pass" method="post" class="login100-form validate-form" name="update_password_form">
					@csrf
					<span class="login100-form-title p-b-26">
						Reset Password
					</span>

                    <input type="hidden" name="email" value="{{ $user_email}}" />
					

					<div class="wrap-input100 validate-input" data-validate = "Valid email is: a@b.c" style="margin-bottom: 0; padding-bottom: 0;" >
						<input class="input100" type="password" name="password" id="password"/>
						
						<span class="focus-input100" data-placeholder="Enter new password"    data-symbol="&#xf206;"></span>
						
					</div>
					<div id="password_error" style="margin-top: 0; padding-top: 0;"></div>
					

					<div class="wrap-input100 validate-input" style="margin-bottom: 0; padding-bottom: 0; margin-top: 15px;" >
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
						<input class="input100" type="password" name="password_confirm" id="password_confirm" >
						<span class="focus-input100" data-placeholder="Confirm new password"></span>
						
					</div>
					<div id="password_confirm_error" style="margin-top: 0; padding-top: 0;"></div>
					

					<div class="container-login100-form-btn" style="margin-top: 25px;">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button type="submit" class="login100-form-btn" onclick="return validateNewPassword()">
								Submit
							</button>
						</div>
					</div>


					<div class="text-center p-t-30">
                        <p>Click <a href="/signin"  style="color: blue;">here</a> to log in as staff</p>						{{-- <span class="txt1">
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

	<script src=" {{  URL::asset('updatePassword_validate.js') }}"></script>

</body>
</html>