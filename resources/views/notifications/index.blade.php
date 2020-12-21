@extends('layout')
@section('content')
    <h1>List Notifications</h1>     
    @if (count($notifications) > 0)
        @foreach ($notifications as $notification)
            <div class="notification" id="<?= $notification->status == 0 ? '': 'seen' ?>">
                    <p><a href="/me/notifications/{{$notification->id}}">{{$notification->content}}</a></p>
                    <small>{{$notification->created_at}}</small>
            </div>
        @endforeach
        {{$notifications->links()}}
    @else
        <p>No notifications found</p>
    @endif
@endsection
