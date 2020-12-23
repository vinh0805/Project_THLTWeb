@extends('layout')
@section('content')
    <section>
        <h1>{{$categoryPet->name}}__{{$category->name}}</h1>
        @foreach($allPosts as $post)
            <div>
                <a href="{{url('post/' . $post->id)}}">{{$post->title}}</a>
            </div>
        @endforeach
    </section>
@endsection
