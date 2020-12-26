@extends('layout')
@section('content')
<div class="signup-box">  <!-- Dùng luôn class style của phần signup --> 
    <form role="form" method="post" id="changePasswordForm" action="{{url('update-password/' . $user->id)}}"
          enctype="multipart/form-data">
        {{csrf_field()}}
            <h2>Change password</h2> <br>
            <div class="input-field" id="formHeader">
                
                <span id="changePassSpan">
                <button id="changePassButton" class = "sign-button">
                    <a href="{{url('me/')}}">
                        My information
                    </a>
                </button>
            </span>
            </div>
            <div class="input-field">
                <div>
					<label for="exampleInputEmail1">Current password:</label>
					<span class="br"></span>
					<label class="option">required</label>
					<label for="inputName"></label>
				</div>
                <input type="password" class="input-form" id="password" name="password">
            </div>
            <div class="input-field">
                <div>
					<label for="exampleInputEmail1">New password:</label>
					<span class="br"></span>
					<label class="option">required</label>
					<label for="inputName"></label>
				</div>
                <input type="password" class="input-form" id="new_password" data-validation="length"
                       minlength="6" data-msg-minlength="Ít nhất 6 ký tự!" name="new_password">
            </div>
            <div class="input-field">
                <div>
					<label for="exampleInputEmail1">Confirm password:</label>
					<span class="br"></span>
					<label class="option">required</label>
					<label for="inputName"></label>
				</div>
                <input type="password" class="input-form" id="confirm_new_password" data-validation="length"
                       data-validation-length="min6" data-validation-error-msg="Ít nhất 6 ký tự, ít nhất 1 ký tự hoa,
                       1 ký tự đặc biệt!" name="confirm_new_password">
            </div>

            <div class="input-field">
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

            <div class="submit-button" id="endButtonsDiv">
                <button type="submit" id="submitButton" class="sign-button">Save Change</button>
            </div>
            <br> <br>
        <!-- /.card-body -->
    </form>
</div>
@endsection
