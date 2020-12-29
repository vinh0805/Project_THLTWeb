<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategoryPet;
use App\Models\Comment;
use App\Models\LikePost;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function showPostOfCategoryPet($categoryPetName, $categoryName)
    {
        $categoryPet = CategoryPet::where('name', $categoryPetName)->first();
        $category = Category::where('name', $categoryName)->first();
        $likePostArray = [];
        $commentPostArray = [];
        $i = 0;
        if(isset($categoryPet) && isset($category)){
            $allPosts = DB::table('posts')
                ->join('users', 'posts.user_id', '=', 'users.id')
                ->select('posts.*', 'users.name', 'users.avatar')
                ->where('category_pet_id', $categoryPet->id)
                ->where('category_id', $category->id)
                ->where('status', 1)->get();
            foreach ($allPosts as $post) {
                $likePostArray[$i] = count(LikePost::where('post_id', '=', $post->id)->get());
                $commentPostArray[$i] = count(Comment::where('post_id', '=', $post->id)->get());
                $i++;
            }
            return view('categories.screen08-pet-category')
                ->with('allPosts', $allPosts)->with('categoryPet', $categoryPet)
                ->with('category', $category)->with('likePostArray', $likePostArray)
                ->with('commentPostArray', $commentPostArray);
        }
        return 0;
    }
}
