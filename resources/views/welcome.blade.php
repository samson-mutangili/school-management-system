<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login -School management system</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="{{ URL::asset('../Login_v8/images/icons/favicon.ico') }}"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('../Login_v8/vendor_login/bootstrap/css/bootstrap.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('../Login_v8/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('../Login_v8/vendor_login/animate/animate.css') }}">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('../Login_v8/vendor_login/css-hamburgers/hamburgers.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('../Login_v8/vendor_login/animsition/css/animsition.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('../Login_v8/vendor_login/select2/select2.min.css') }}">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('../Login_v8/vendor_login/daterangepicker/daterangepicker.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('../Login_v8/css/util.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('../Login_v8/css/main.css') }}">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100 main_class_style main_body">
			<div class="wrap-login100">
				<form class="login100-form validate-form p-l-55 p-r-55 p-t-178" action="/login" method="POST">
					<span class="login100-form-title">
						Sign In
					</span>

					<div class="wrap-input100 validate-input m-b-16" data-validate="Please enter username">
						<select class="input100" name="user_category">
							<option value="" disabled selected hidden>Select category</option>
							<option value="admin" >Admin</option>
							<option value="principal">Principal</option>
							<option value="deputy_principal">Deputy principal</option>
							<option value="examination_and_student_admission">Examination and student admission</option>
							<option value="teacher">Teacher</option>
							<option value="bursar">Bursar</option>
							<option value="boardind_department">Boarding department</option>
						 </select>
						<span class="focus-input100"></span>
					</div>
					@csrf
					<div class="wrap-input100 validate-input m-b-16" data-validate="Please enter username">
						<input class="input100" type="text" name="email" placeholder="Enter your email">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Please enter password">
						<input class="input100" type="password" name="password" placeholder="Enter your password">
						<span class="focus-input100"></span>
					</div>

					

					<div class="container-login100-form-btn m-t-20 m-b-20">
						<button class="login100-form-btn" type="submit">
							Sign in
						</button>
					</div>

					<div class="text-center p-t-13 p-b-23">
						
						<p> Forget password?? Click <a href="/forgotPassword" class="txt2">
							here
						</a> to reset.</p>
					</div>

				</form>
			</div>
		</div>
	</div>
	
	
<!--===============================================================================================-->
	<script src="{{ URL::asset('../Login_v8/vendor_login/jquery/jquery-3.2.1.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ URL::asset('../Login_v8/vendor_login/animsition/js/animsition.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ URL::asset('../Login_v8/vendor_login/bootstrap/js/popper.js') }}"></script>
	<script src="{{ URL::asset('../Login_v8/vendor_login/bootstrap/js/bootstrap.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ URL::asset('../Login_v8/vendor_login/select2/select2.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ URL::asset('../Login_v8/vendor_login/daterangepicker/moment.min.js') }}"></script>
	<script src="{{ URL::asset('../Login_v8/vendor_login/daterangepicker/daterangepicker.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ URL::asset('../Login_v8/vendor_login/countdowntime/countdowntime.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ URL::asset('../Login_v8/js/main.js') }}"></script>

</body>
</html>