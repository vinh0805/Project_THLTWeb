@extends('layout')
@section('content')
    <section class = "category-body">
        <div class = "category-list">
            <h1>{{$categoryPet->name}} {{$category->name}}</h1>
            <hr>
            @foreach($allPosts as $post)
                <div class = "category-post">
                    <a href="{{url('post/' . $post->id)}}">{{$post->title}}</a>
                </div>
                <hr>
            @endforeach
        </div>
    </section>
@endsection
