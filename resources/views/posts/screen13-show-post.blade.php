@extends('layout')
@section('content')
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
    @endif
@endsection
