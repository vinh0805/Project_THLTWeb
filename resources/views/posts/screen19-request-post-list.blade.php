@extends('layout')
@section('content')
    <?php
    use Illuminate\Support\Facades\Session;
    $message = Session::get('message');
    if (isset($message)) {
        echo '<span id="loginError">' . $message . '</span>';
        Session::put('message', null);
    }
    $user = \Illuminate\Support\Facades\Session::get('sUser')
    ?>

    <section class="category-body">
        <div class="category-list">
            <h1><b>Review post List</b></h1>
            <hr>
            @foreach($allRequestPosts as $post)
                <div class="request-post">
                    <a href="{{url('post/' . $post->id)}}">{{$post->title}}</a>
                </div>
                <hr>
            @endforeach
        </div>
    </section>
@endsection
