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

    <section id="showPost">
        <h1 id="showPostTitle">{{$post->title}}</h1>
        <div id="showPostContent">{!! $post->content !!}</div>
    </section>

    @if($post->status == 1)
        <section id="showComment">
            <h2><b>Comment</b></h2>
            @foreach($allComments as $comment)
                <div class="userComment"><b>{{$comment->name}}</b>: </div>
                <div>{{$comment->content}}</div>
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
        <form action="{{url('review-post/' . $post->id)}}" method="post">
            @csrf
            <button type="submit" name="submitButton" value="1">Accept this post</button>
            <button type="submit" name="submitButton" value="0">Delete this post</button>
        </form>
    @endif
@endsection
