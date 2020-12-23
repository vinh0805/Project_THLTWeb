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
                    @foreach($allCategory as $category)
                        <tr>
                            <td><a href="{{url('pets-category/' . $categoryPet->name . '/' .$category->name)}}">
                                    {{$category->name}}</a></td>
                        </tr>
                    @endforeach
                @endforeach
            </table>
        </div>
    </section>
@endsection