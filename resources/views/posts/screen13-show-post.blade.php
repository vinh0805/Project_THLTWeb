@extends('layout')
@section('styles')
    <style>
        .post-sw-body #showPostContent input[type="image"] {
            max-width: 100%;
        }
    </style>
@endsection
@section('content')
    <?php
    use Illuminate\Support\Facades\Session;
    $message = Session::get('message');
    if (isset($message)) {
        echo '<span id="loginError">' . $message . '</span>';
        Session::put('message', null);
    }
    $user = \Illuminate\Support\Facades\Session::get('sUser');
    ?>
    {{--    Show posted user--}}
    <div class="post-sw-body">
        <div class="author">
            {{--        avatar--}}
            <img class="avatar" src="{{url('frontend/images/avatars/' . $post->avatar)}}" alt="avatar">
            <div class="post_info">
                <a href="{{url('user/' . $post->user_id . '/info')}}">{{$post->name}}</a> <br>
                <span class="text-muted" id="noti-time">{{$post->created_at}}</span>
            </div>
        </div>
        <br>
        <section id="showPost">
            <div id="showPostTitle"><b>{{$post->title}}</b></div>
            @if($post->status == 1)
                <i id="likePostButton" class="fas fa-paw fa-4x"
                   @if(isset($postIsLiked) && $postIsLiked == 1) style="color: #FF9800" liked="1"
                   @else style="color: #1a1c1b" liked="0" @endif
                   data-post-id="{{$post->id}}">  {{$likePostNumber}}</i>
            @endif
            <div id="showPostContent">{!! $post->content !!}</div>
        </section>

        @if($post->status == 1)
            <section id="show-comment">
                <h2><b>Comment</b></h2>
                <?php $i = 0; ?>
                @foreach($allComments as $comment)
                    <div class="comment">
                        <div class="left-comment">
                            <img class="avatar" src="{{url('frontend/images/avatars/' . $comment->avatar)}}"
                                 alt="avatar">
                            <a href="{{url('user/' . $comment->user_id . '/info')}}"><b
                                    class="user-name">{{$comment->name}}</b></a>
                        </div>
                        <div class="right-comment">
                            <header class="right-top-comment">
                                <div class="comment-created-at">{{$comment->created_at}}</div>
                                <i class="like-comment-button fas fa-paw fa-2x"
                                   @if(isset($commentIsLikedArray[$i]) && $commentIsLikedArray[$i] == 1)
                                   style="color: #FF9800" liked="1"
                                   @elseif(isset($commentIsLikedArray[$i]) && $commentIsLikedArray[$i] == 0)
                                   style="color: #1a1c1b" liked="0"
                                   @endif
                                   id="{{$comment->id}}"
                                >  {{$likeArray[$i]}}</i>
                            </header>
                            <div class="comment-content">{{$comment->content}}</div>
                        </div>
                    </div>
                    <?php $i++ ?>
                @endforeach
                {{ $allComments->links() }}
            </section>
            @if(isset($user))
                <section id="writeComment">
                    <form action="{{url('post/' . $post->id . '/write-comment')}}" method="post">
                        @csrf
                        <textarea minlength="3" id="commentContent" name="commentContent"
                                  placeholder="Write comment here..."></textarea>
                        <button type="submit" id="writeCommentButton">Comment</button>
                    </form>
                </section>
            @endif
        @elseif($post->status == 0 && $user->role == 1)
            <div class="request">
                <form action="{{url('review-post/' . $post->id)}}" method="post">
                    @csrf
                    <button class="accept" type="submit" onclick="return confirm('Do you want to accept?')"
                            name="submitButton" value="1">Accept this post
                    </button>
                    <button class="decline" type="submit" onclick="return confirm('Do you want to delete?')"
                            name="submitButton" value="0">Delete this post
                    </button>
                </form>
            </div>
        @endif
    </div>
@endsection
@section('script')
    @if(isset($user))
        <script>
            let like_post_button = $("#likePostButton");
            like_post_button.click(function () {
                $.ajax({
                    type: "get",
                    url: $(this).data('post-id') + '/update-like',
                    dataType: 'json',
                    success: function (response) {
                        if (like_post_button.attr("liked") == '0') {
                            like_post_button.attr('liked', "1");
                            like_post_button.css("color", "#FF9800");
                        } else if (like_post_button.attr("liked") == '1') {
                            like_post_button.attr('liked', "0");
                            like_post_button.css("color", "#1a1c1b");
                        }
                        like_post_button.html("  " + response);
                    }
                });
            });

            $(".like-comment-button").click(function () {
                $.ajax({
                    type: "get",
                    url: $(this).attr('id') + '/update-like-comment',
                    dataType: 'json',
                    success: function (response) {
                        if (!response.commentId) {
                            return;
                        }

                        let response_el = $("#" + response.commentId);
                        if (response_el.attr("liked") == '0') {
                            response_el.attr('liked', "1");
                            response_el.css("color", "#FF9800");
                        } else if (response_el.attr("liked") == '1') {
                            response_el.attr('liked', "0");
                            response_el.css("color", "#1a1c1b");
                        }
                        response_el.html("  " + response.likeCommentNumber);
                    }
                });
            })
        </script>
    @endif
@endsection
