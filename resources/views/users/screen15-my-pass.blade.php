@extends('layout')
@section('content')
<div class="signup-box">  <!-- Dùng luôn class style của phần signup -->
    <form role="form" method="post" id="changePasswordForm" action="{{url('update-password/' . $user->id)}}"
          enctype="multipart/form-data">
        {{csrf_field()}}
            <h2>Change password</h2> <br>
            <div id="changePassButton" class = "info-button">
                <a href="{{url('me/')}}">
                    My information
                </a>
            </div>
            <div class="input-field">
                <div>
					<label for="exampleInputEmail1">Current password:</label>
					<span class="br"></span>
					<label class="option">required</label>
					<label for="inputName"></label>
				</div>
                <input type="password" class="input-form" id="password" data-validation="length"
                       maxlength="32" data-msg-maxlength="Max 32 characters!"
                       minlength="6" data-msg-minlength="At least 6 characters!" name="password">
            </div>
            <div class="input-field">
                <div>
					<label for="exampleInputEmail1">New password:</label>
					<span class="br"></span>
					<label class="option">required</label>
					<label for="inputName"></label>
				</div>
                <input type="password" class="input-form" id="new_password" data-validation="length"
                       maxlength="32" data-msg-maxlength="Max 32 characters!"
                       minlength="6" data-msg-minlength="At least 6 characters!" name="new_password">
            </div>
            <div class="input-field">
                <div>
					<label for="exampleInputEmail1">Confirm password:</label>
					<span class="br"></span>
					<label class="option">required</label>
					<label for="inputName"></label>
				</div>
                <input type="password" class="input-form" id="confirm_new_password" data-validation="length"
                       maxlength="32" data-msg-maxlength="Max 32 characters!"
                       minlength="6" data-msg-minlength="At least 6 characters!" name="confirm_new_password">
            </div>

            <div class="input-field">
                <?php
                use Illuminate\Support\Facades\Session;
                $message = Session::get('message');
                if($message == 'UPDATE PASSWORD SUCCESSFULLY!') {
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
