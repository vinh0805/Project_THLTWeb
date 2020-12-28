@extends('layout')
@section('content')
    <?php
    use Illuminate\Support\Facades\Session;
    $message = Session::get('message');
    if(isset($message)) {
        echo '<span id="loginError">' . $message . '</span>';
        Session::put('message', null);
    }
    $user = \Illuminate\Support\Facades\Session::get('sUser');
    ?>

    <hr>
    {{--    Show posted user--}}
    <div>
        <h4>Posted by:</h4>
        {{--        avatar--}}
        <img class="avatar" src="{{url('frontend/images/avatars/' . $post->avatar)}}" alt="avatar">
        <div><a href="{{url('user/' . $user->id . '/info')}}">{{$user->name}}</a></div>
    </div>
    <hr>

    <div class="post-sw-body">
        <section id="showPost">
            <h1 id="showPostTitle"><b>{{$post->title}}</b></h1>
            <div id="showPostContent">{!! $post->content !!}</div>
        </section>
        <hr>

        @if($post->status == 1)
            <i id="likePostButton" class="far fa-thumbs-up fa-3x"
                @if(isset($postIsLiked) && $postIsLiked == 1) style="color: #006cfa" liked="1"
                @else style="color: #1a1c1b" liked="0" @endif
                data-post-id="{{$post->id}}">  {{$likePostNumber}}</i>
            <hr>
            <section id="show-comment">
                <h2><b>Comment</b></h2>
                <?php $i = 0; ?>
                @foreach($allComments as $comment)
                    <div class="comment">
                        <div class="left-comment">
                            <img class="avatar" src="{{url('frontend/images/avatars/' . $comment->avatar)}}" alt="avatar">
                            <b class="user-name"><a href="{{url('user/' . $comment->user_id . '/info')}}">{{$comment->name}}</a></b>
                        </div>
                        <div class="right-comment">
                            <header class="right-top-comment">
                                <div class="comment-created-at">{{$comment->created_at}}</div>
                                <i class="like-comment-button far fa-thumbs-up fa-2x"
                                   @if(isset($commentIsLikedArray[$i]) && $commentIsLikedArray[$i] == 1)
                                        style="color: #006cfa" liked="1"
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
            </section>
            @if(isset($user))
                <section id="writeComment">
                    <form action="{{url('post/' . $post->id . '/write-comment')}}" method="post">
                        @csrf
                        <textarea id="commentContent" name="commentContent" placeholder="Write comment here..."></textarea>
                        <button type="submit" id="writeCommentButton">Comment</button>
                    </form>
                </section>
            @endif
        @elseif($post->status == 0)
            <div class = "request">
            <form action="{{url('review-post/' . $post->id)}}" method="post">
                @csrf
                <button class="accept" type="submit" onclick="return confirm('Do you want to accept?')"
                        name="submitButton" value="1">Accept this post</button>
                <button class = "decline" type="submit" onclick="return confirm('Do you want to delete?')"
                        name="submitButton" value="0">Delete this post</button>
            </form>
            </div>
        @endif
    </div>
@endsection
