@extends('layout')
@section('content')
    <div class = "category-list">
        <h1><b>Review post List</b></h1>
        <hr>
        @foreach($allRequestPosts as $post)
            <div class = "category-post">
                <a href="{{url('post/' . $post->id)}}">{{$post->title}}</a>
            </div>
            <hr>
        @endforeach
    </div>
@endsection
