@extends('layout')
@section('content')
    <?php
    use Illuminate\Support\Facades\Session;
    $message = Session::get('message');
    if(isset($message)) {
        echo '<span id="loginError">' . $message . '</span>';
        Session::put('message', null);
    }
    ?>
    <div class = "post-sw-body">
    <section id="showPost">
        <h1 id="showPostTitle">{{$post->title}}</h1>
        <div id="showPostContent">{!! $post->content !!}</div>
    </section>

    @if($post->status == 1)
        <section id="showComment">
            <h2><b>Comment</b></h2>
            @foreach($allComments as $comment)
                <div class = "usercmt">
                    <img class = "cmt-user-avat" src="{{url('frontend/images/avatars/' . $comment->avatar)}}" alt="avatar" id="avatar">
                    <div class = "cmt-info">
                        <div class="userComment"><b>{{$comment->name}}:</b> </div>
                        <div class = "cmt-content">{{$comment->content}}</div>
                    </div>
                </div>
            @endforeach
        </section>
        <?php $user = \Illuminate\Support\Facades\Session::get('sUser')?>
        @if(isset($user))
            <section id="writeComment">
                <form action="{{url('post/' . $post->id . '/write-comment')}}" method="post">
                    @csrf
                    <label>
                        <textarea id="commentContent" name="commentContent" placeholder="Write comment here..."></textarea>
                    </label>
                    <button type="submit" id="writeCommentButton">Write comment</button>
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
