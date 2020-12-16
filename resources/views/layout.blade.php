<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Pet Forum</title>
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
    <link rel="stylesheet" href="{{asset('frontend/fonts/font.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/jquery-ui.css')}}">
    <link rel="stylesheet" href="{{asset('backend/js/jquery-validation-1.19.2/demo/css/screen.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/stylesheet.css')}}">
</head>
<body class="hold-transition login-page">
<section class="menu-top" id="header">
    {{--    Menu--}}
    <ul class="menu">
        <li class="menu logo"><a href="{{url('/home')}}" ><img src="{{url('frontend/images/pet_logo.PNG')}}" alt="Logo"></a></li>
        <li class="menu dropdown">
            <a href="{{url('/pets-category/dog')}}">Dog</a>
            <div class="dropdown-content">
                <a href="{{url('/pets-category/dog/show-off')}}">Show off</a>
                <a href="{{url('/pets-category/dog/experience')}}">Experience</a>
                <a href="{{url('/pets-category/dog/give')}}">Give</a>
                <a href="{{url('/pets-category/dog/relief')}}">Relief</a>
                <a href="{{url('/pets-category/dog/meme')}}">meme</a>
            </div>
        </li>
        <li class="menu dropdown">
            <a href="{{url('/pets-category/cat')}}">Cat</a>
            <div class="dropdown-content">
                <a href="{{url('/pets-category/dog/show-off')}}">Show off</a>
                <a href="{{url('/pets-category/dog/experience')}}">Experience</a>
                <a href="{{url('/pets-category/dog/give')}}">Give</a>
                <a href="{{url('/pets-category/dog/relief')}}">Relief</a>
                <a href="{{url('/pets-category/dog/meme')}}">Meme</a>
            </div>
        </li>
        <li class="menu dropdown">
            <a href="{{url('/pets-category/others')}}">Others</a>
            <div class="dropdown-content">
                <a href="{{url('/pets-category/dog/show-off')}}">Show off</a>
                <a href="{{url('/pets-category/dog/experience')}}">Experience</a>
                <a href="{{url('/pets-category/dog/give')}}">Give</a>
                <a href="{{url('/pets-category/dog/relief')}}">Relief</a>
                <a href="{{url('/pets-category/dog/meme')}}">Meme</a>
            </div>
        </li>
        <li class="menu avatar"><img src="{{url('frontend/images/avatars/' . Illuminate\Support\Facades\Session::get('sUser')->avatar)}}" alt="avatar" id="avatar"></li>
        <li class="menu dropdown name">
            <a href="{{url('logout')}}">
                <?php
                use Illuminate\Support\Facades\Session;
                $user = Session::get('sUser');
                if(isset($user)) {
                    echo $user->name;
                }
                ?>
            </a>
            <div class="dropdown-content">
                <a href="{{url('/create-post')}}">New post</a>
                <a href="{{url('/me')}}">Your information</a>
                <a href="{{url('/me/notification')}}">Notifications</a>
                <a href="{{url('/me/password')}}">Change password</a>
                <a href="{{url('/logout')}}">Log out</a>
            </div>
        </li>
    </ul>
</section>

{{--Content--}}
@yield('content')

<!-- jQuery -->
<script src="{{asset('frontend/css/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('frontend/css/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('frontend/css/dist/js/adminlte.min.js')}}"></script>

<script src="{{asset('frontend/js/jquery-1.12.4.js')}}"></script>
<script src="{{asset('backend/js/jquery-validation-1.19.2/lib/jquery.mockjax-2.2.1.js')}}"></script>
<script src="{{asset('frontend/js/jquery-ui.js')}}"></script>
<script>
    $(function() {
        $( "#datepicker" ).datepicker({
            dateFormat: "dd/mm/yy",
            defaultDate: "0d",
            changeYear: true,
            changeMonth: true,
            yearRange: "1980:2020"
        });
    });
</script>

<script src="{{asset('backend/js/jquery-validation-1.19.2/dist/jquery.validate.js')}}"></script>
<script>
    $("#editProfileForm").validate();
    $().ready(function () {
        $("#changePasswordForm").validate({
            rules: {
                password: "required",
                new_password: {
                    required: true,
                    strongPassword: true
                },
                confirm_new_password: {
                    required: true,
                    strongPassword: true,
                    equalTo: "#new_password"
                }
            }
        })

        $("#editDeviceForm").validate({
            rules: {
                devicePrice: {
                    required: true,
                    number: true
                }
            }
        })

        $("#AddEditRequestForm").validate({
            rules: {
                reasonOfRequest: {
                    required: true,
                    minlength: 8
                }
            }
        })
    })
</script>
<script src="{{asset('backend/js/jquery-validation-1.19.2/src/localization/messages_vi.js')}}"></script>
<script src="{{asset('backend/js/jquery-validation-1.19.2/src/additional/strongPassword.js')}}"></script>
</body>
</html>
