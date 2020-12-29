@extends('layout')
@section('content')
    <?php
    use Illuminate\Support\Facades\Session;
    $message = Session::get('message');
    if(isset($message)) {
        echo '<span id="loginError">' . $message . '</span>';
        Session::put('message', null);
    }
    $i = $i2 = 0;
    ?>
    <section id="advertisement">
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="{{url('frontend/images/slider01.png')}}" alt="First slide">
                    <div class="carousel-caption d-none d-md-block">
                        <h1 class="advertisement-link"><a href="#">Advertisement 01</a></h1>
                        <p>...</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="{{url('frontend/images/slider02.png')}}" alt="Second slide">
                    <div class="carousel-caption d-none d-md-block">
                        <h1 class="advertisement-link"><a href="#">Advertisement 02</a></h1>
                        <p>...</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="{{url('frontend/images/slider03.png')}}" alt="Third slide">
                    <div class="carousel-caption d-none d-md-block">
                        <h1 class="advertisement-link"><a href="#">Advertisement 03</a></h1>
                        <p>...</p>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </section>

    <section id="content">
        <div id="search">
            <label for="searchInput"></label>
            <input type="text" id="searchInput" placeholder="     Search post..." name="searchInput">
            <input type="button" value="Search" id="searchButton">
            <div id="searchedPosts"></div>
        </div>

        <div id="hotPosts">
            <div class = "category-list">
                <h2><b>Hot</b></h2>
                @if(isset($hotPosts))
                    <hr>
                    @foreach($hotPosts as $hotPost)
                        <div class = "category-post">
                            <a href="{{url('post/' . $hotPost->id)}}">{{$hotPost->title}}</a>
                            <hr>
                            <div class="content-foot">
                                <div>{{$hotPostLikeArray[$i2]}}  <i class="fas fa-paw"></i></div>
                                <div>{{$hotPostCommentArray[$i2]}}  <i class="fas fa-comment-dots"></i></div>
                                <div class="content-foot-user">Posted by <a href="{{url('user/' . $hotPost->user_id . '/info')}}">{{$hotPost->name}}</a> at {{$hotPost->created_at}}</div>
                            </div>
                        </div>
                        <?php $i2++; ?>
                    @endforeach
                @endif
            </div>
        </div>

        <div id="Category">
            <table class="table">
                @foreach($allCategoryPet as $categoryPet)
                    <tr>
                        <th class="col-sm-4"><a href="#">{{$categoryPet->name}}</a></th>
                        <th class="col-sm-4 newest-post">Newest Post</th>
                        <th class="col-sm-1">Posts</th>
                        <th class="col-sm-1">Likes</th>
                    </tr>
                    @foreach($allCategory as $category)
                        <tr>
                            <td class="col-sm-4"><a href="{{url('pets-category/' . $categoryPet->name . '/' .$category->name)}}">
                                    {{$category->name}}
                                </a></td>
                            <td class="col-sm-4 newest-post">
                                @if(isset($newestPostList[$i]))
                                    <a href="{{url('post/' . $newestPostList[$i]->id)}}">
                                        <p>{{$newestPostList[$i]->title}}</p>
                                        <p class="post-created-at">{{$newestPostList[$i]->created_at}}</p>
                                    </a>
                                @endif
                            </td>
                            <td class="col-sm-1"><label>{{$countPost[$i]}}</label></td>
                            <td class="col-sm-1"><label>{{$countLike[$i]}}</label></td>
                            <?php $i++ ?>
                        </tr>
                    @endforeach
                @endforeach
            </table>
        </div>
    </section>
@endsection
