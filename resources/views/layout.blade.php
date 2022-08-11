<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

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
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Luckiest+Guy&display=swap" rel="stylesheet">
    <!--<link rel="stylesheet" href="{{asset('frontend/css/homestyle.css')}}"> -->
    {{-- Bootstrap --}}
    <link rel="stylesheet" href="{{asset('frontend/css/plugins/bootstrap/css/bootstrap.min.css')}}">

    {{--Style--}}
    @yield('styles')
</head>
<body class="hold-transition login-page" style="background: #FFF6EA;">

<section class="header" id="header">
    {{--    Menu--}}
    <div class="logo-field">
        <a href="{{url('home')}}">
            <div>
                <img class="logo" src="{{asset('frontend/images/Logo.png')}}" alt="logo">
                <img src="{{asset('frontend/images/PETforum.svg')}}" alt="logo">
            </div>
        </a>
    </div>
    <nav class="nav-bar">
        <li class="menu dropdown">
            <div class="dropdown-img">
                <a href="{{url('#')}}" title="DOGS">
                    <img class="catego" src="{{asset('frontend/images/dog.png')}}" alt="Dog">
                </a>
            </div>
            <div class="dropdown-content">
                <a href="{{url('/pets-category/dog/show-off')}}">Show off</a>
                <a href="{{url('/pets-category/dog/experience')}}">Experience</a>
                <a href="{{url('/pets-category/dog/give')}}">Give</a>
                <a href="{{url('/pets-category/dog/relief')}}">Relief</a>
                <a href="{{url('/pets-category/dog/meme')}}">meme</a>
            </div>
        </li>
        <li class="menu dropdown">
            <div class="dropdown-img">
                <a href="{{url('#')}}" title="CATS">
                    <img class="catego" src="{{asset('frontend/images/cat.png')}}" alt="Cat">
                </a>
            </div>
            <div class="dropdown-content">
                <a href="{{url('/pets-category/cat/show-off')}}">Show off</a>
                <a href="{{url('/pets-category/cat/experience')}}">Experience</a>
                <a href="{{url('/pets-category/cat/give')}}">Give</a>
                <a href="{{url('/pets-category/cat/relief')}}">Relief</a>
                <a href="{{url('/pets-category/cat/meme')}}">Meme</a>
            </div>
        </li>
        <li class="menu dropdown">
            <div class="dropdown-img">
                <a href="{{url('#')}}" title="OTHERS">
                    <img class="catego" src="{{asset('frontend/images/others.png')}}" alt="Others">
                </a>
            </div>
            <div class="dropdown-content">
                <a href="{{url('/pets-category/others/show-off')}}">Show off</a>
                <a href="{{url('/pets-category/others/experience')}}">Experience</a>
                <a href="{{url('/pets-category/others/give')}}">Give</a>
                <a href="{{url('/pets-category/others/relief')}}">Relief</a>
                <a href="{{url('/pets-category/others/meme')}}">Meme</a>
            </div>
        </li>
    </nav>
    <div class="account">
        <div class="social">
            <a href="#"><img src="{{asset('frontend/images/Facebook.svg')}}" alt="facebook"></a>
            <a href="#"><img src="{{asset('frontend/images/Twitter.svg')}}" alt="twitter"></a>
            <a href="#"><img src="{{asset('frontend/images/Instagram.svg')}}" alt="instagram"></a>
        </div>
        <div class="acc">
            <?php
            use Illuminate\Support\Facades\Session;
            $user = Session::get('sUser');
            if(isset($user)) {
            ?>
            <li class="menu avatar">
                <img src="{{url('frontend/images/avatars/' . $user->avatar)}}" alt="avatar" id="avatar">
            </li>
            <li class="menu dropdown name px-2">
                <a href="{{url('user/' . $user->id . '/info')}}">
                    <h1> {{$user->name}} </h1>
                </a>
                <div class="dropdown-content">

                    <a href="{{url('/post/create')}}">New post</a>
                    @if($user->role == 1)
                        <a href="{{url('requests/post/list')}}">Review post</a>
                    @endif
                    <a href="{{url('/me')}}">Your information</a>
                    <?php
                    $totalNotification = App\Models\Notification::where([
                        ['status', 0],
                        ['user_id', $user->id],
                    ])->count();
                    $totalMessages = \App\Models\Message::where([
                        ['read', 0],
                        ['to', $user->id],
                    ])->count();
                    ?>
                    <a href="{{url('/me/notifications')}}">
                        <div>Notifications</div>
                        <p class="notify"> {{$totalNotification}} </p>   <!--  Notification amount  -->
                    </a>
                    <a href="{{url('/chat')}}">
                        <div>Messages</div>
                        <p class="notify"> {{$totalMessages}} </p>   <!--  Notification amount  -->
                    </a>
                    <a href="{{url('/me/password')}}">Change password</a>
                    <a href="{{url('/logout')}}">Log out</a>
                </div>
            </li>
            <?php
            } else {
            ?>
            <a class="login-acc" href="{{url('login')}}">SIGN IN</a>
            <a class="signup-acc" href="{{url('signup')}}">SIGN UP?</a>
            <?php
            }
            ?>
        </div>
    </div>
</section>

{{--Content--}}
@yield('content')

<!-- jQuery -->
<script src="{{asset('frontend/css/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<!-- AdminLTE App -->
<script src="{{asset('frontend/css/dist/js/adminlte.min.js')}}"></script>

<script src="{{asset('frontend/js/jquery-1.12.4.js')}}"></script>
<script src="{{asset('backend/js/jquery-validation-1.19.2/lib/jquery.mockjax-2.2.1.js')}}"></script>
<script src="{{asset('frontend/js/jquery-ui.js')}}"></script>
<script src="{{asset('frontend/css/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
{{--Footer--}}
@yield('script')

<script src="{{asset('frontend/css/plugins/jquery-validation/jquery.validate.js')}}"></script>
{{--<script src="{{asset('backend/js/jquery-validation-1.19.2/src/localization/messages_vi.js')}}"></script>--}}
{{--<script src="{{asset('backend/js/jquery-validation-1.19.2/src/additional/strongPassword.js')}}"></script>--}}
</body>
<footer>
    <div class="footer-left">
        <header>
            <img src="{{asset('frontend/images/PETforum.svg')}}" alt="logo">
        </header>
        <div class="left-left">
            <h>“A Forum created for pet lover and people who interested about pet”</h>
            <img src="{{asset('frontend/images/vinh.svg')}}" alt="logo" class="ruler">
            <p class="ruler_name">- Vinh.M ( Founder of PETforum )</p>
        </div>
        <div class="left-right">
            <h>“Life without Ricardo is meaning less”</h>
            <img src="{{asset('frontend/images/vinh2.jpg')}}" alt="logo" class="ruler">
            <p class="ruler_name">- Still Vinh but actually Ngôn Phi</p>
        </div>
    </div>
    <div class="footer-right">
        <div class="left-left">
            <h>About us</h>
            <div><a href=#>About PETforum</a></div>
            <div><a href=#>Contact us</a></div>
            <div><a href=#>Features</a></div>
            <div><a href=#>Careers</a></div>
        </div>
        <div class="left-right">
            <h>Get in touch</h>
            <div><a href="https://www.facebook.com/emquen.ten.5/"><b>Ngo Thu Huyen</b></a></div>
            <div><a href="https://www.facebook.com/chung.levan.334839/">Le Van Chung</a></div>
            <div><a href="https://www.facebook.com/balduusavage/">Nguyen Bao Duc</a></div>
            <div><a href="https://www.facebook.com/phongdk29101999/">Do Kim Phong</a></div>
            <div><a href="https://www.facebook.com/trannhatthong99/">Tran Nhat Thong</a></div>
            <div><a href="https://www.facebook.com/vinhemt/">Mau Tien Vinh</a></div>
        </div>
    </div>
</footer>
</html>
