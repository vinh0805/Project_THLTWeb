@extends('layout')
@section('content')
    <div>
{{--        avatar--}}
        <div>
            <img src="{{url('frontend/images/avatars/' . $user->avatar)}}" alt="avatar">
        </div>

{{--        info--}}
        <div>
            <div>{{$user->name}} @if($user->role == 1)(admin)@endif</div>
            @if($user->gender == 1)
                <div>Male</div>
            @else
                <div>Female</div>
            @endif
            <div>{{$user->address}}</div>
            <div>{{$user->email}}</div>
        </div>

{{--        number post & comment--}}
        <div>
            <div>{{$postNumber}} Posts</div>
            <div>{{$commentNumber}} Comments</div>
        </div>
    </div>
@endsection
