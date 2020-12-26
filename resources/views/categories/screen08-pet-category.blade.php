@extends('layout')
@section('content')
    <section class = "category-body">
        <h1>{{$categoryPet->name}} {{$category->name}}</h1>
        <div class = "category-list"> 
            <hr>
            @foreach($allPosts as $post)
                <div class = "category-post">
                    <a href="{{url('post/' . $post->id)}}">{{$post->title}}</a>
                    <div class = "content">
                        <p>{!! $post->content !!} </p>
                    </div>
                    <hr>
                </div>
            @endforeach
        </div>
    </section>
@endsection
