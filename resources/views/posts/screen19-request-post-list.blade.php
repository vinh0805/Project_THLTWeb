@extends('layout')
@section('content')
    <section class="category-body">
        <div class = "category-list">
            <h1><b>Review post List</b></h1>
            <hr>
            @foreach($allRequestPosts as $post)
                <div class = "request-post">
                    <a href="{{url('post/' . $post->id)}}">{{$post->title}}</a>
                </div>
                <hr>
            @endforeach
        </div>
    </section>
@endsection
