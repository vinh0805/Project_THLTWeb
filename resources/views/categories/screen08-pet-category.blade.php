@extends('layout')
@section('content')
    <?php
    use Illuminate\Support\Facades\Session;
    $message = Session::get('message');
    if(isset($message)) {
        echo '<span id="loginError">' . $message . '</span>';
        Session::put('message', null);
    }
    $user = Session::get('sUser');
    $i = 0;
    ?>

    <section class = "category-body">
        <div id="categoryLeft">
            <h4 id="searchTitle">Search</h4>
            <label for="searchInputCategory"></label>
            <div id="searchInput2">
                <i class="fas fa-search"></i>
                <input type="text" id="searchInputCategory" placeholder="search..." name="searchInputCategory"
                       data-category="{{$category->id}}" data-category2="{{$category->name}}"
                       data-category-pet="{{$categoryPet->id}}"
                       data-category-pet2="{{$categoryPet->name}}">
            </div>
            <hr>
            <div id="searchedCategoryPosts"></div>
        </div>
        <div id="categoryMid">
            <h1>{{$categoryPet->name}} {{$category->name}}</h1>
            <div class = "category-list">
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
                            <div class="content-foot-user">Posted by <a class="user-name-mini" href="{{url('user/' . $post->user_id . '/info')}}">{{$post->name}}</a> at {{$post->created_at}}</div>
                        </div>
                    </div>
                    <?php $i++ ?>
                @endforeach
            </div>
        </div>
        <div id="categoryRight">
            <a href="{{url('/post/create')}}">
                <button id="createPost"> + Create a post here </button>
            </a>
            <hr>
            <h4 id="searchTitle">Top Users</h4>
            @foreach($topUsers as $topUser)
                <div class="top-user">
                    <a href="{{url('user/' . $topUser->user_id . '/info')}}">
                        <img class="avatar-mini" src="{{url('frontend/images/avatars/' . $topUser->avatar)}}" alt="miniAvatar">
                        <span class="user-name-mini">{{$topUser->user_name}}</span>
                    </a>
                    <div class="like-number">
                        <span>{{$topUser->user_count}}</span>
                        <i class="fas fa-paw"></i>
                    </div>
                </div>
            @endforeach
            <hr>
            @if(isset($you))
            <div class="top-user">
                <a href="{{url('user/' . $you->user_id . '/info')}}">
                    <img class="avatar-mini" src="{{url('frontend/images/avatars/' . $you->avatar)}}" alt="miniAvatar">
                    <span class="user-name-mini">{{$you->user_name}}</span>
                </a>
                <div class="like-number">
                    <span>{{$you->user_count}}</span>
                    <i class="fas fa-paw"></i>
                </div>
            </div>
            @endif

        </div>
    </section>
@endsection
