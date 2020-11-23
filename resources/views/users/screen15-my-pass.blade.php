@extends('layout')
@section('content')
    <h1>Screen 03</h1>
    <form role="form" method="post" id="changePasswordForm" action="{{url('update-password/' . $user->id)}}"
          enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="card-body">
            <div class="form-group" id="formHeader">
                <label><h2>Thay đổi mật khẩu</h2></label>
                <span id="changePassSpan">
                <button class="btn btn-primary" id="changePassButton">
                    <a href="{{url('me/')}}">
                        Thông tin của tôi
                    </a>
                </button>
            </span>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Mật khẩu cũ</label>
                <label class="star"> (*)</label>
                <label for="password"></label><input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Mật khẩu mới</label>
                <label class="star"> (*)</label>
                <label for="new_password"></label>
                <input type="password" class="form-control" id="new_password" data-validation="length"
                       minlength="6" data-msg-minlength="Ít nhất 6 ký tự!" name="new_password">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Nhập lại mật khẩu</label>
                <label for="confirm_new_password"></label>
                <input type="password" class="form-control" id="confirm_new_password" data-validation="length"
                       data-validation-length="min6" data-validation-error-msg="Ít nhất 6 ký tự, ít nhất 1 ký tự hoa,
                       1 ký tự đặc biệt!" name="confirm_new_password">
            </div>

            <div class="form-group">
                <?php
                use Illuminate\Support\Facades\Session;
                $message = Session::get('message');
                if($message == 'Cập nhật mật khẩu thành công!') {
                    echo '<div id="updateSuccessfullyMessage"><span>' . $message . '</span></div>';
                } else {
                    echo '<div id="updateFailMessage"><span>' . $message . '</span></div>';
                }
                Session::put('message', null);
                ?>
            </div>

            <div class="form-group" id="endButtonsDiv">
                <button type="submit" id="submitButton" class="btn btn-primary">Thay đổi</button>
            </div>
        </div>
        <!-- /.card-body -->
    </form>
@endsection
