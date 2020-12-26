@extends('layout')
@section('content')
    <?php
    use Illuminate\Support\Facades\Session;
    $message = Session::get('message');
    if(isset($message)) {
        echo '<span id="loginError">' . $message . '</span>';
        Session::put('message', null);
    }
    $user = \Illuminate\Support\Facades\Session::get('sUser')
    ?>
    <div class = "post-sw-body">
    <section id="showPost">
        <h1 id="showPostTitle">{{$post->title}}</h1>
        <div id="showPostContent">{!! $post->content !!}</div>
    </section>

    @if($post->status == 1)
        @if(isset($user))
        @endif
        <section id="show-comment">
            <h2><b>Comment</b></h2>
            @foreach($allComments as $comment)
                <div class="comment">
                    <div class="left-comment">
                        <img class="avatar" src="{{url('frontend/images/avatars/' . $comment->avatar)}}" alt="avatar">
                        <b class="user-name">{{$comment->name}}</b>
                    </div>
                    <div class="right-comment">
                        <header class="right-top-comment">
                            <div class="comment-created-at">{{$comment->created_at}}</div>
                            <label class="like-button"><i class="far fa-thumbs-up fa-2x"></i></label>
                        </header>
                        <div class="comment-content">{{$comment->content}}</div>
                    </div>
                </div>
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
            <button class = "accept" type="submit" name="submitButton" value="1">Accept this post</button>
            <button class = "decline" type="submit" name="submitButton" value="0">Delete this post</button>
        </form>
        </div>
    @endif
    </div>
@endsection
