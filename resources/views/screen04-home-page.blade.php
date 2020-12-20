@extends('layout')
@section('content')
    <section id="advertisement">
        Advertisement
    </section>

    <section id="content">
        <div id="search">
            <label for="searchInput"></label>
            <input type="text" id="searchInput" placeholder="..." name="searchInput">
            <input type="button" value="Search">
        </div>

        <div id="hotPosts">
            <h3>Hot</h3>

        </div>
        <div id="Category">
            <table>
                @foreach($allCategoryPet as $categoryPet)
                    <tr><th><a href="{{url('pets-category/' . $categoryPet->name)}}">{{$categoryPet->name}}</a></th></tr>
                    @if($categoryPet->name == 'dog')
                        @foreach($allDogCategory as $dogCategory)
                            <tr>
                                <td><a href="{{url('pets-category/' . $categoryPet->name . '/' .$dogCategory->name)}}">
                                        {{$dogCategory->name}}</a></td>
                            </tr>
                        @endforeach
                    @elseif($categoryPet->name == 'cat')
                        @foreach($allCatCategory as $catCategory)
                            <tr>
                                <td><a href="{{url('pets-category/' . $categoryPet->name . '/' . $catCategory->name)}}">
                                        {{$catCategory->name}}</a></td>
                            </tr>
                        @endforeach
                    @elseif($categoryPet->name == 'others')
                        @foreach($allOthersCategory as $othersCategory)
                            <tr>
                                <td><a href="{{url('pets-category/' . $categoryPet->name .'/' . $othersCategory->name)}}">
                                        {{$othersCategory->name}}</a></td>
                            </tr>
                        @endforeach
                    @endif
                @endforeach
            </table>
        </div>
    </section>
@endsection
