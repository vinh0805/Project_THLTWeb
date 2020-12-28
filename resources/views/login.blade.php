<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 3 | Log in</title>
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
	<style>
		
	</style>
	
</head>
<body class="hold-transition ">
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
				<!--
				<a class="login-acc" href="{{url('login')}}">SIGN IN</a>
				-->
				<a class="signup-acc" href="{{url('signup')}}">SIGN UP?</a>
			</div>
		</div>
	</div>
	<!-- /.header -->
	
	<div class="login-box">
		<div class="login-card">
			<?php
			use Illuminate\Support\Facades\Session;
			$message = Session::get('message');
			if($message) {
				echo '<span id="loginError">' . $message . '</span>';
				Session::put('message', null);
			}
			?>

			<div class="login-body">
				<form action="{{url('login-confirm')}}" method="post">
					{{csrf_field()}}
					<div class="input-field">
						<label>Email:</label>
						<input type="email" class="input-form" name="email">
						
					</div>
					<div class="input-field">
						<label>Password:</label>
						<input type="password" class="input-form" name="password">
						
					</div>
					<div class="submit-button">
							<input type="submit" class="login-button" id="loginButton" value = "SIGN IN">
					</div>
					
				</form>
				
			</div>
			<!-- /.login-card-body -->
		</div>
		<div class="help-box">
			<a href="#">
				<div>
					<img src="{{asset('frontend/images/help.png')}}" alt="help">
					<p>Need help?</p>
				</div>
			</a>
		</div>
	</div>
	<!-- /.login-box -->
</div>

<!-- jQuery -->
<script src="{{asset('frontend/css/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('frontend/css/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('frontend/css/dist/js/adminlte.min.js')}}"></script>
</body>
</html>

{{--</form>--}}
