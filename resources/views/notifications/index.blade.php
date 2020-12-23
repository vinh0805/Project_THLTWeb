@extends('layout')
{{-- @extends('screen04-home-page') --}}
@section('content')
    <link rel="stylesheet" href="{{asset('frontend/css/notification.css')}}">
    <div class="notifications">
        <h1>List Notifications</h1>     
    @if (count($notifications) > 0)
        @foreach ($notifications as $notification)
        <div class="notification" id="<?= $notification->status == 0 ? '': 'seen' ?>">
            <a href="/me/notifications/{{$notification->id}}">
                <div>
                    <div class="comment-text">
                        <span class="username">
                            <span class="text-muted float-right">{{$notification->created_at}}</span>
                            <span class="user float-left">
                                <img class="img-circle img-sm" src="{{url('frontend/images/Logo.png')}}" alt="User Image">
                                From: {{$notification->name}}
                            </span>
                            <br>
                            <span class="reply">Re: {{$notification->title}}</span>
                        </span><!-- /.username -->
                        <p>{{$notification->content}}</p>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
        {{$notifications->links()}}
    @else
        <p>No notifications found</p>
    @endif
    </div>
@endsection