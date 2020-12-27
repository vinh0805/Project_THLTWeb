@extends('layout')
@section('content')
    <section id="advertisement">
        Advertisement
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
                        </div>
                        <hr>
                    @endforeach
                @endif
            </div>
        </div>

        <div id="Category">
            <table class="table">
                <?php $i = 0 ?>
                @foreach($allCategoryPet as $categoryPet)
                    <tr>
                        <th class="col-4"><a href="#">{{$categoryPet->name}}</a></th>
                        <th class="col-1">Posts</th>
                    </tr>
                    @foreach($allCategory as $category)
                        <tr>
                            <td class="col-4"><a href="{{url('pets-category/' . $categoryPet->name . '/' .$category->name)}}">
                                    {{$category->name}}
                                </a></td>
                            <td class="col-1"><label>{{$countPost[$i]}}</label></td>
                            <?php $i++ ?>
                        </tr>
                    @endforeach
                @endforeach
            </table>
        </div>
    </section>
@endsection
