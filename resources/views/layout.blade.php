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
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Luckiest+Guy&display=swap" rel="stylesheet">
    <!--<link rel="stylesheet" href="{{asset('frontend/css/homestyle.css')}}"> -->
    {{-- Bootstrap --}}
    <link rel="stylesheet" href="{{asset('frontend/css/plugin/bootstrap/css/bootstrap.min.css')}}">
</head>
<body class="hold-transition login-page" style = "background: #FFF6EA;">

<section class="header" id="header">
    {{--    Menu--}}
        <div class = "logo-field">
			<a href="{{url('home')}}">
                <div>
                    <img class="logo" src="{{asset('frontend/images/Logo.png')}}" alt="logo">
                    <img src="{{asset('frontend/images/PETforum.svg')}}" alt="logo">
                </div>
			</a>
		</div>
        <nav class = "nav-bar">
        <li class="menu dropdown">
            <div class = "dropdown-img">
                <a href="{{url('#')}}">
                    <img class = "catego" src="{{asset('frontend/images/dog.png')}}" alt="Dog">
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
            <div class = "dropdown-img">
                <a href="{{url('#')}}">
                    <img class = "catego" src="{{asset('frontend/images/cat.png')}}" alt="Cat">
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
            <div class = "dropdown-img">
                <a href="{{url('#')}}">
                    <img class = "catego" src="{{asset('frontend/images/others.png')}}" alt="Others">
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
        <div class = "account">
            <div class="social">
				<a href="#"><img src="{{asset('frontend/images/Facebook.svg')}}" alt="facebook"></a>
				<a href="#"><img src="{{asset('frontend/images/Twitter.svg')}}" alt="twitter"></a>
				<a href="#"><img src="{{asset('frontend/images/Instagram.svg')}}" alt="instagram"></a>
			</div>
            <div class="acc">
                <?php
                    $user = \Illuminate\Support\Facades\Session::get('sUser');
                    if(isset($user)) {
                ?>
                    <li class="menu avatar"><img src="{{url('frontend/images/avatars/' . $user->avatar)}}" alt="avatar" id="avatar"></li>
                    <li class="menu dropdown name">
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
                            ?>
                            <a href="{{url('/me/notifications')}}">
                                Notifications
                                <p class = "notify"> {{$totalNotification}} </p>   <!--  Notification amount  -->
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
<script src="{{asset('frontend/css/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('frontend/css/dist/js/adminlte.min.js')}}"></script>

<script src="{{asset('frontend/js/jquery-1.12.4.js')}}"></script>
<script src="{{asset('backend/js/jquery-validation-1.19.2/lib/jquery.mockjax-2.2.1.js')}}"></script>
<script src="{{asset('frontend/js/jquery-ui.js')}}"></script>

<script>
    $('.carousel').carousel();
</script>

@if(isset($user))
    <script>
        $("#likePostButton").click(function (){
            $.ajax({
                type: "get",
                url: $(this).data('post-id') + '/update-like',
                dataType: 'json',
                success: function (response){
                    if ($("#likePostButton").attr("liked") == '0') {
                        console.log('liked!');
                        $("#likePostButton").attr('liked', "1");
                        $("#likePostButton").css("color", "#006cfa");
                    } else if ($("#likePostButton").attr("liked") == '1') {
                        console.log('unliked!');
                        $("#likePostButton").attr('liked', "0");
                        $("#likePostButton").css("color", "#1a1c1b");
                    }
                    $("#likePostButton").html("  " + response);
                }
            });
        });

        $(".like-comment-button").click(function (){
            $.ajax({
                type: "get",
                url: $(this).attr('id') + '/update-like-comment',
                dataType: 'json',
                success: function (response){
                    console.log(response);
                    if ($("#" + response.commentId).attr("liked") == '0') {
                        console.log('liked!');
                        $("#" + response.commentId).attr('liked', "1");
                        $("#" + response.commentId).css("color", "#006cfa");
                    } else if ($("#" + response.commentId).attr("liked") == '1') {
                        console.log('unliked!');
                        $("#" + response.commentId).attr('liked', "0");
                        $("#" + response.commentId).css("color", "#1a1c1b");
                    }
                    $("#" + response.commentId).html("  " + response.likeCommentNumber);
                }
            });
        })
    </script>
@endif

<script type="text/javascript">
    $(document).ready(function () {
        $('#searchInput').on('keyup',function() {
            let query = $(this).val();
            $.ajax({
                url: 'search',
                type: 'get',
                data: {'title': query},
                success:function (data) {
                    $('#searchedPosts').html(data);
                }
            })
            // end of ajax call
        });
        $('#searchButton').click(function (){
            let query = $("#searchInput").val();
            $.ajax({
                url: 'search',
                type: 'get',
                data: {'title': query},
                success:function (data) {
                    $('#searchedPosts').html(data);
                }
            })
            // end of ajax call
        });
    });
</script>

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
                    required: true
                    // strongPassword: true
                },
                confirm_new_password: {
                    required: true,
                    // strongPassword: true
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
@if(isset($message))
    <script>alert({{$message}})</script>
@endif
<script src="{{asset('backend/js/jquery-validation-1.19.2/src/localization/messages_vi.js')}}"></script>
{{--<script src="{{asset('backend/js/jquery-validation-1.19.2/src/additional/strongPassword.js')}}"></script>--}}
<script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('postContent', {
        filebrowserUploadUrl: "{{route('ckeditor.upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });
</script>
</body>
<footer>
    <div class="footer-left">
        <header>
            <img src="{{asset('frontend/images/PETforum.svg')}}" alt="logo">
        </header>
        <div class = "left-left">
            <h>“A Forum created for pet lover and people who interested about pet”</h>
            <img src="{{asset('frontend/images/vinh.svg')}}" alt="logo" class = "ruler">
            <p class = "ruler_name">- Vinh.M ( Founder of PETforum )</p>
        </div>
        <div class = "left-right">
            <h>“Life without Ricardo is meaning less”</h>
            <img src="{{asset('frontend/images/vinh2.jpg')}}" alt="logo" class = "ruler">
            <p class = "ruler_name">- Still Vinh but actually Ngôn Phi</p>
        </div>
        <!--
        <label>Forum created by Team 5</label>
        <div><a href="https://www.facebook.com/emquen.ten.5/"><b>Ngo Thu Huyen</b></a></div>
        <div><a href="https://www.facebook.com/chung.levan.334839/">Le Van Chung</a></div>
        <div><a href="https://www.facebook.com/balduusavage/">Nguyen Bao Duc</a></div>
        <div><a href="https://www.facebook.com/phongdk29101999/">Do Kim Phong</a></div>
        <div><a href="https://www.facebook.com/trannhatthong99/">Tran Nhat Thong</a></div>
        <div><a href="https://www.facebook.com/vinhemt/">Mau Tien Vinh</a></div>
        <div><a></a></div>
        -->
    </div>
    <div class="footer-right">
    <div class = "left-left">
            <h>About us</h>
            <div><a href=#>About PETforum</a></div>
            <div><a href=#>Contact us</a></div>
            <div><a href=#>Features</a></div>
            <div><a href=#>Careers</a></div>
        </div>
        <div class = "left-right">
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
