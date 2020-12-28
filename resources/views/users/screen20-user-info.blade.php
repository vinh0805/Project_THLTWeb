@extends('layout')
@section('content')
    <div class="info-box" id=user-cardbody>
{{--        avatar--}}
        <div class="signup-box" id=user-avatar-box>
            <img src="{{url('frontend/images/avatars/' . $user->avatar)}}" alt="avatar">
        </div>
{{--        info--}}
        <div class="signup-box" id=user-profile-box>
            <!-- User name -->
            <h2>{{$user->name}} @if($user->role == 1)(admin)@endif</h2>
             <!-- User gender -->
            @if($user->gender == 1)
                <div class="input-field">Sex: Male</div>
            @else
                <div class="input-field">Sex: Female</div>
            @endif
            <!-- address -->
            <div class="input-field">Address: {{$user->address}}</div>
            <!-- email -->
            <div class="input-field">Email: {{$user->email}}</div>
        </div>
{{--        number post & comment--}}
        <div class="signup-box" id=user-status>
            <div class="white-box">
            <h3>User status</h3>
            <div class="input-field">{{$postNumber}} Posts</div>
            <div class="input-field">{{$commentNumber}} Comments</div>
            </div>
        </div>
    </div>
@endsection
