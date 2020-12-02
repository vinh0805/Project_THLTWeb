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
<body class="hold-transition login-page">
    <h1>Đăng ký</h1>
    <form role="form" method="post" id="signUpForm" action="{{url('signup-submit')}}" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="card-body">
            <div class="form-group">
                <?php
                use Illuminate\Support\Facades\Session;
                $message = Session::get('message');
                if($message) {
                    echo '<div id="updateSuccessfullyMessage"><span>' . $message . '</span></div>';
                    Session::put('message', null);
                }
                ?>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Tên</label>
                <label class="star"> (*)</label>
                <label for="inputName"></label>
                <input type="text" class="form-control" id="inputName" placeholder="Name"
                       maxlength="32" data-msg-required="Bạn phải nhập trường này!" required name="name">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Địa chỉ email</label>
                <label class="star"> (*)</label>
                <label for="inputEmail1"></label>
                <input type="email" class="form-control" id="inputEmail1" placeholder="Email" required name="email">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Mật khẩu</label>
                <label class="star"> (*)</label>
                <label for="password"></label>
                <input type="password" class="form-control" id="password" data-validation="length"
                       minlength="6" data-msg-minlength="Ít nhất 6 ký tự!" name="password">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Nhập lại mật khẩu</label>
                <label class="star"> (*)</label>
                <label for="confirm_password"></label>
                <input type="password" class="form-control" id="confirm_password" data-validation="length"
                       data-validation-length="min6" data-validation-error-msg="Ít nhất 6 ký tự!" name="confirm_password">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Giới tính</label>
            </div>
            <div class="form-group">
                <label for="male"></label>
                <input type="radio" class="radioGender" name="gender" id="male" value="1">
                <label class="radioLabel">Nam</label>
                <label for="female"></label>
                <input type="radio" class="radioGender" name="gender" id="female" value="2">
                <label class="radioLabel">Nữ</label>
            </div>
            <div class="form-group" id="endButtonsDiv">
                <button type="submit" id="submitButton" class="btn btn-primary">Đăng ký</button>
            </div>
        </div>
        <!-- /.card-body -->
    </form>
    <a href="{{url('login')}}">Login</a>

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
                    }
                }
            })
        })
    </script>

    <script src="{{asset('frontend/css/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('frontend/css/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('frontend/css/dist/js/adminlte.min.js')}}"></script>
</body>
</html>
