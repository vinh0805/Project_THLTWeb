@extends('layout')
@section('content')
<div class="info-box">
<div class="signup-box" id=info-avatar-box>
    <img src="{{url('frontend/images/avatars/' . $user->avatar)}}" id="avatar">
</div>
<div class="signup-box" id=profile-box> <!-- Đồng bộ với class style của phần signup -->
    <form role="form" method="post" id="editProfileForm" action="{{url('update-profile/' . $user->id)}}"
          enctype="multipart/form-data">
        {{csrf_field()}}
        <h2>My information</h2> <br>
        <div id="changePassButton" class = "info-button">
            <a href="{{url('me/password/')}}">
                Change password
            </a>
        </div>

        <div class="input-field">
            <label for="exampleInputEmail1">Name</label>
            <label class="option">required</label>
            <label for="inputName"></label>
            <input type="text" class="form-control" id="inputName" placeholder="Name" value="{{$user->name}}"
                   maxlength="16" data-msg-required="Bạn phải nhập trường này!" required name="name">
        </div>
        <div class="input-field">
            <label for="exampleInputEmail1">Email address</label>
            <label for="inputEmail1"></label>
            <input type="email" class="form-control" id="inputEmail1" placeholder="Enter email" value="{{$user->email}}" name="email">
        </div>
        <!-- Checkbox for sex -->
        <div class="input-field" id="info-sex">
            <label class="container">Male
                <input type="radio" name="gender" id="male" value="1"
                    @if($user->gender == 1)
                        checked
                    @endif
                >
                <span class="checkmark"></span>
            </label>
            <label class="container">Female
                <input type="radio" name="gender" id="female" value="2"
                    @if($user->gender == 2)
                        checked
                    @endif
                >
                <span class="checkmark"></span>
            </label>
        </div>

        <br><br> <!-- End checkbox for sex -->
        <div class="input-field">
            <label for="inputBirthday">Date of birth</label>
            <?php
            $date = (isset($_POST["datepicker"])) ? $_POST["datepicker"] : $user->birthday;
            ?>
            <label for="datepicker"></label>
            <input class="form-control" readonly="readonly" id="datepicker" name="datepicker" placeholder="Birthday"
                   value="<?php echo $date; ?>">
        </div>
        <div class="input-field">
            <label for="exampleInputEmail1">Address</label>
            <label for="inputAddress"></label>
            <input type="text" maxlength="255" class="form-control" id="inputAddress"
                   placeholder="Enter address" value="{{$user->address}}" name="address">
        </div>
        <div class="input-field" id="info-add-avatar">
            <label for="exampleInputFile">Avatar</label>
            <label for="exampleInputFile"></label>
            <input type="file" class="form-control" id="exampleInputFile" name="avatar" accept="image/x-png,image/gif,image/jpeg">
        </div>
        <br>
        <div class="input-field">
            <?php
            use Illuminate\Support\Facades\Session;
            $message = Session::get('message');
            if($message) {
                echo '<div id="updateSuccessfullyMessage"><span>' . $message . '</span></div>';
                Session::put('message', null);
            }
            ?>
        </div>
        <div class="input-field" id="endButtonsDiv">
            <button type="submit" id="submitButton" class="info-button">Update profile</button>
        </div>
        <!-- /.card-body -->
    </form>
</div>
</div>
@endsection
