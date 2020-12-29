@extends('layout')
@section('content')
<div class = "post-crt-body">
    <h1 class = "PostCreateTitle">Create a new post</h1>
    <form action="{{url('post/save')}}" method="post">
        @csrf
        <div class = "post-option">
            <div class = "option">
                <label for="postTitle">Title</label>
                <input id="postTitle" class="input-form" name="postTitle" placeholder="..." required>
            </div>
            <div class = "option">
                <label for="postCategoryPet">Pet</label>
                <select id="postCategoryPet" class="input-form" name="postCategoryPet">
                    @foreach($allCategoryPet as $categoryPet)
                        <option value="{{$categoryPet->id}}">{{$categoryPet->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class = "option">
                <label for="postCategory">Category</label>
                <select id="postCategory" class="input-form" name="postCategory">
                    @foreach($allCategory as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class = "post-submit">
            <button type="submit" id="createPostSubmitButton" class="post-button">Create</button>
        </div>
        <div>
            <label for="postContent">Content</label>
            <textarea id="postContent" name="postContent" class = "post-content"></textarea>
        </div>
    </form>
</div>
@endsection
