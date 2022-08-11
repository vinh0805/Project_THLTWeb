@section('styles')
    <style>
        .cfg-btn {
            background-color: white;
        }
        .cfg-btn:hover {
            background-color: #FFDEAE;
        }
        .fl-r {
            float: right;
        }
    </style>
@endsection
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
            <h2 class="pt-0">{{$user->name}} @if($user->role == 1)<i class="far fa-check-circle"></i>@endif
                @if(@$user)
                    @if(!@$request_friend && !$requested_friend)
                        <button class="btn mr-4 add-friend-btn fl-r cfg-btn">
                            <i class="fas fa-user mt-1 mr-1"></i>
                            +Friend
                        </button>
                    @elseif(@$request_friend['status'] === 0)
                        <button class="btn mr-4 add-friend-btn fl-r cfg-btn" disabled>
                            <i class="fas fa-user mt-1 mr-1"></i>
                            Request is sent
                        </button>
                    @elseif(@$request_friend['status'] === 1 || @$requested_friend['status'] === 1)
                        <button class="btn btn-danger mr-4 delete-friend-btn fl-r">
                            <i class="fas fa-user mt-1 mr-1"></i>
                            UnFriend
                        </button>
                    @elseif(@$requested_friend['status'] === 0)
                        <button class="btn mr-4 reply-friend-btn fl-r cfg-btn" data-accept="1">
                            <i class="fas fa-user mt-1 mr-1"></i>
                            Accept
                        </button>
                        <button class="btn btn-danger reply-friend-btn mr-4 fl-r" data-accept="2">
                            <i class="fas fa-user mt-1 mr-1"></i>
                            Decline
                        </button>
                    @endif
                @endif
            </h2>
            <!-- User gender -->
            @if($user->gender == 1)
                <div class="input-field">Gender: Male</div>
            @else
                <div class="input-field">Gender: Female</div>
        @endif
        <!-- address -->
            <div class="input-field">Address: {{$user->address}}</div>
            <!-- email -->
            <div class="input-field">Email: {{$user->email}}</div>
        </div>
        {{--        number post & comment--}}
        <div class="signup-box" id=user-status>
            <div class="white-box">
                <br>
                <div class="input-field" id=status-tittle>User status</div>
                <div class="input-field">{{$postNumber}} Posts</div>
                <div class="input-field">{{$commentNumber}} Comments</div>
                <div class="input-field">Like: {{$likeNumber}}</div>
                <div class="input-field">Is liked: {{$isLikedNumber->user_count}}</div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        let to = {!! (int)@$user['id'] !!};
        let send_request_url = '{!! url('friend/send-request') !!}';
        let delete_request_url = '{!! url('friend/delete') !!}';
        let reply_request_url = '{!! url('friend/reply') !!}';
        let is_friend = {!! (int)(@$request_friend['status'] == 1) !!};
        console.log(is_friend)
        let html = '<i class="fas fa-user mt-1 mr-1"></i>';
        if (is_friend) {
            html += '+Friend';
        } else {
            html += 'Request is sent';
        }
        console.log(html)

        $(document).ready(function() {
            let add_friend_btn = $('.add-friend-btn');
            let delete_friend_btn = $('.delete-friend-btn');
            let reply_friend_btn = $('.reply-friend-btn');
            add_friend_btn.click(function() {
                $.ajax({
                    url: send_request_url,
                    type: 'POST',
                    data: {
                        to: to
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: (res) => {
                        alert(res.msg);
                        if (res && res.success) {
                            add_friend_btn.html(html);
                        }
                        if (!is_friend) {
                            add_friend_btn.prop('disabled', true);
                        }
                    }
                })
            });
            delete_friend_btn.click(function() {
                $.ajax({
                    url: delete_request_url,
                    type: 'POST',
                    data: {
                        to: to
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: (res) => {
                        alert(res.msg);
                        if (res.success) {
                            location.reload();
                        }
                    }
                })
            });
            reply_friend_btn.click(function() {
                let accept = $(this).data('accept');
                console.log('accept')
                console.log(accept)
                $.ajax({
                    url: reply_request_url,
                    type: 'POST',
                    data: {
                        from: to,
                        accept: accept
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: (res) => {
                        alert(res.msg);
                        if (res.success) {
                            location.reload();
                        }
                    }
                })
            });
        });
    </script>
@endsection
