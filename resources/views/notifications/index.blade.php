@extends('layout')
{{-- @extends('screen04-home-page') --}}
@section('content')
    <link rel="stylesheet" href="{{asset('frontend/css/notification.css')}}">
    <div class="notifications">
        <h1>Notifications</h1>
    @if (count($notifications) > 0)
        @foreach ($notifications as $notification)
        <div class="new_notification" id="<?= $notification->status == 0 ? '': 'seen' ?>">
            <a href="{{url('/me/notifications/' . $notification->id)}}">
                <div>
                    <div class="comment-text">
                        <span class="username">
                            <div class = "request_user">
                            <span class="text-muted float-right" id="noti-time">{{$notification->created_at}}</span>
                            <span class="user float-left" id="noti-from">
                            From:
                                <img class="request_user_avt" src="{{url('frontend/images/avatars/' . $notification->avatar)}}" alt="User Image">
                            </span>
                            <span class="user float-left" id=noti-name>{{$notification->name}}</span>
                            <br><hr>
                            </div>
                            <span class="reply" id="noti-title">Re: {{$notification->title}}</span>
                        </span><!-- /.username -->
                        <p id=noti-content>{{$notification->content}}</p>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
        {{$notifications->links()}}
    @else
        <p class = "none">No notifications found</p>
    @endif
    </div>
@endsection
