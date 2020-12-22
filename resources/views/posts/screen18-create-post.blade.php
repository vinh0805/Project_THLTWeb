@extends('layout')
@section('content')
    <h1>Create a new post</h1>
    <form action="{{url('post/save')}}" method="post">
        @csrf
        <div>
            <label for="postTitle">Title</label>
            <input id="postTitle" name="postTitle" placeholder="...">
        </div>
        <div>
            <label for="postCategoryPet">Pet</label>
            <select id="postCategoryPet" name="postCategoryPet">
                @foreach($allCategoryPet as $categoryPet)
                    <option value="{{$categoryPet->id}}">{{$categoryPet->name}}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="postCategory">Category</label>
            <select id="postCategory" name="postCategory">
                @foreach($allCategory as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="postContent">Content</label>
            <textarea id="postContent" name="postContent"></textarea>
        </div>
        <button type="submit" id="createPostSubmitButton">Create</button>
    </form>
@endsection
