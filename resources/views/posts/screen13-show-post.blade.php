@extends('layout')
@section('content')
    <section id="showPost">
        <h1 id="showPostTitle">{{$post->title}}</h1>
        <div id="showPostContent">{!! $post->content !!}</div>
    </section>

    <section id="showComment" @if($post->status == 0) hidden @endif>
        @foreach($allComments as $comment)
            <div class="userComment">{{$comment->name}}</div>
            <div>{{$comment->content}}</div>
        @endforeach
    </section>
@endsection
