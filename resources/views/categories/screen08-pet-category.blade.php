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
