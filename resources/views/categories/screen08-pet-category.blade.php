@extends('layout')
@section('content')
    <?php
    use Illuminate\Support\Facades\Session;
    $message = Session::get('message');
    if(isset($message)) {
        echo '<span id="loginError">' . $message . '</span>';
        Session::put('message', null);
    }
    $user = \Illuminate\Support\Facades\Session::get('sUser');
    $i = 0;
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
                    <div class="content-foot">
                        <div>{{$likePostArray[$i]}}  <i class="fas fa-paw"></i></div>
                        <div>{{$commentPostArray[$i]}}  <i class="fas fa-comment-dots"></i></div>
                        <div class="content-foot-user">Posted by <a href="{{url('user/' . $post->user_id . '/info')}}">{{$post->name}}</a> at {{$post->created_at}}</div>
                    </div>
                </div>
                <?php $i++ ?>
            @endforeach
        </div>
    </section>
@endsection
