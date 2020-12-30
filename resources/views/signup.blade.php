<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sign up</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('frontend/css/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset('frontend/css/ionicons.min.css')}}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{asset('frontend/css/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('frontend/css/dist/css/adminlte.min.css')}}">
    <!-- Google Font: Source Sans Pro -->
    <link href="{{asset('frontend/fonts/font.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('frontend/css/stylesheet.css')}}">

</head>
<body class="hold-transition">
	<div class="page_wrapper">
		<div class="header">
			<div class = "logo-field">
				<a href="{{url('home')}}">
					<div>
					<img class="logo" src="{{asset('frontend/images/Logo.png')}}" alt="logo">
					<img src="{{asset('frontend/images/PETforum.svg')}}" alt="logo">
					</div>
				</a>
			</div>
			<nav class = "nav-bar">
			</nav>
			<div class = "account">
				<div class="social">
					<a href="#"><img src="{{asset('frontend/images/Facebook.svg')}}" alt="facebook"></a>
					<a href="#"><img src="{{asset('frontend/images/Twitter.svg')}}" alt="twitter"></a>
					<a href="#"><img src="{{asset('frontend/images/Instagram.svg')}}" alt="instagram"></a>
				</div>
				<div class="acc">
					<a class="login-acc" href="{{url('login')}}">SIGN IN</a>
					<!--
					<a class="signup-acc" href="{{url('signup')}}">SIGN UP?</a>
					-->
				</div>
			</div>
		</div>
		<!-- /.header -->
		<div class="signup-box">
		<form role="form" method="post" id="signUpForm" action="{{url('signup-submit')}}" enctype="multipart/form-data">
			{{csrf_field()}}
			<div class="card-body">
				<div class="form-group">
					<?php
					use Illuminate\Support\Facades\Session;
					$message = Session::get('message');
					if($message) {
					    if ($message == 'THIS EMAIL IS USED BY ANOTHER USER!'){
                            echo '<div id="updateSuccessfullyMessage" style="color: red"><span>' . $message . '</span></div>';
                        } else {
                            echo '<div id="updateSuccessfullyMessage"><span>' . $message . '</span></div>';
                        }
						Session::put('message', null);
					}
					?>
				</div>
				<div class="input-field">
					<div>
						<label for="exampleInputEmail1">Username:</label>
						<span class="br"></span>
						<label class="option">required</label>
						<label for="inputName"></label>
					</div>
					<input type="text" class="input-form" id="inputName"
						   maxlength="16" required name="name">
				</div>
				<div class="input-field">
					<div>
						<label for="exampleInputEmail1">Email:</label>
						<span class="br"></span>
						<label class="option">required</label>
						<label for="inputEmail1"></label>
					</div>
					<input type="email" class="input-form" id="inputEmail1" required name="email">
				</div>
				<div class="input-field">
					<div>
						<label for="exampleInputEmail1">Password</label>
						<span class="br"></span>
						<label class="option">required</label>
						<label for="password"></label>
					</div>
					<input type="password" class="input-form" id="password" data-validation="length"
						   minlength="6" name="password">
				</div>
				<div class="input-field">
					<div>
						<label for="exampleInputEmail1">Confirm password:</label>
						<span class="br"></span>
						<label class="option">required</label>
						<label for="confirm_password"></label>
					</div>
					<input type="password" class="input-form" id="confirm_password" data-validation="length"
						   data-validation-length="min6" name="confirm_password">
				</div>

				<div class="input-field">
					<label class="container">Male
						<input type="radio" name="gender" id="male" value="1">
						<span class="checkmark"></span>
					</label>
					<label class="container">Female
						<input type="radio" name="gender" id="female" value="2">
						<span class="checkmark"></span>
					</label>
				</div>
				<div class="submit-button" id="endButtonsDiv">
					<input type="submit" id="submitButton" class="sign-button" value = "SIGN UP">
				</div>
			</div>

			<!-- /.card-body -->
		</form>

		<div class="help-box">
			<a href="#">
				<div>
					<img src="{{asset('frontend/images/help.png')}}" alt="help">
					<p>Need help?</p>
				</div>
			</a>
			</div>
		</div>
		<!-- Sign up box -->
		<footer>
			<div></div>
		</footer>

		<!-- jQuery -->
		<script>
			$().ready(function () {
				$("#signUpForm").validate({
					rules: {
						password: {
							required: true,
							strongPassword: true
						},
						confirm_password: {
							required: true,
							strongPassword: true,
							equalTo: "#password"
						},
					}
				})
			})
		</script>

		<script src="{{asset('frontend/css/plugins/jquery/jquery.min.js')}}"></script>
		<!-- Bootstrap 4 -->
		<script src="{{asset('frontend/css/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
		<!-- AdminLTE App -->
		<script src="{{asset('frontend/css/dist/js/adminlte.min.js')}}"></script>

	</div>
</body>
</html>
