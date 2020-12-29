<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SIGN UP SUCCESSFULLY</title>
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
				<img class="logo" src="{{asset('frontend/images/Logo.png')}}" alt="logo">
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
		</div>
	</div>
	<!-- /.header -->
	<div class="box">
        <div class="box-message">
            <?php
			use Illuminate\Support\Facades\Session;
			$message = Session::get('message');
			if($message) {
				echo '<h2>' . $message . '</h2>';
			}
			?>
            <p>Wait web page redirects after <p id="countdown">5<p> seconds.</p>
            <p>Or <a href="{{url('home')}}">click here</a></p>
        </div>

	</div>
	<!-- /.box -->
</div>

<!-- jQuery -->
<script src="{{asset('frontend/css/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('frontend/css/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('frontend/css/dist/js/adminlte.min.js')}}"></script>
<script>
    var count=4;
    setTimeout(function(){
       window.location.href = '{{url('/')}}'
    }, 5000);
    setInterval(function(){
        document.getElementById("countdown").innerHTML=count--;
    }, 1000);
 </script>
</body>
</html>

{{--</form>--}}
