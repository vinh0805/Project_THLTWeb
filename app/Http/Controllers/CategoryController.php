<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategoryPet;
use App\Models\Comment;
use App\Models\LikePost;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    public function showPostOfCategoryPet($categoryPetName, $categoryName)
    {
        $categoryPet = CategoryPet::where('name', $categoryPetName)->first();
        $category = Category::where('name', $categoryName)->first();
        $likePostArray = [];
        $commentPostArray = [];
        $i = 0;
        if (isset($categoryPet) && isset($category)) {
            $allPosts = DB::table('posts')
                ->join('users', 'posts.user_id', '=', 'users.id')
                ->select('posts.*', 'users.name', 'users.avatar')
                ->where('category_pet_id', $categoryPet->id)
                ->where('category_id', $category->id)
                ->where('status', 1)->get();
            $topUsers = DB::table('like_post')
                ->leftJoin('posts', 'posts.id', '=', 'like_post.post_id')
                ->leftJoin('users', 'users.id', '=', 'posts.user_id')
                ->select('like_post.id as id', 'like_post.post_id as post_id',
                    'posts.user_id as user_id', 'users.name as user_name',
                    'users.avatar as avatar', DB::raw('count(*) as user_count'))
                ->groupBy('posts.user_id')
                ->orderBy('user_count', 'desc')
                ->take(5)->get();
            $topUsers2 = DB::table('like_post')
                ->leftJoin('posts', 'posts.id', '=', 'like_post.post_id')
                ->leftJoin('users', 'users.id', '=', 'posts.user_id')
                ->select('like_post.id as id', 'like_post.post_id as post_id',
                    'posts.user_id as user_id', 'users.name as user_name',
                    'posts.category_pet_id', 'posts.category_id',
                    'users.avatar as avatar', DB::raw('count(*) as user_count'))
                ->where('posts.category_id', '=', $category->id)
                ->where('posts.category_pet_id', '=', $categoryPet->id)
                ->groupBy('posts.user_id')
                ->orderBy('user_count', 'desc')
                ->take(5)->get();
            $you = Session::get('sUser');
            if (isset($you)) {
                $you = DB::table('like_post')
                    ->leftJoin('posts', 'posts.id', '=', 'like_post.post_id')
                    ->leftJoin('users', 'users.id', '=', 'posts.user_id')
                    ->select('like_post.id as id', 'like_post.post_id as post_id',
                        'posts.user_id as user_id', 'users.name as user_name',
                        'users.avatar as avatar', DB::raw('count(*) as user_count'))
                    ->groupBy('posts.user_id')
                    ->where('posts.user_id', '=', Session::get('sUser')->id)
                    ->first();
                $you2 = DB::table('like_post')
                    ->leftJoin('posts', 'posts.id', '=', 'like_post.post_id')
                    ->leftJoin('users', 'users.id', '=', 'posts.user_id')
                    ->select('like_post.id as id', 'like_post.post_id as post_id',
                        'posts.user_id as user_id', 'users.name as user_name',
                        'posts.category_pet_id', 'posts.category_id',
                        'users.avatar as avatar', DB::raw('count(*) as user_count'))
                    ->where('posts.category_id', '=', $category->id)
                    ->where('posts.category_pet_id', '=', $categoryPet->id)
                    ->groupBy('posts.user_id')
                    ->where('posts.user_id', '=', Session::get('sUser')->id)
                    ->first();
            } else {
                $you = null;
                $you2 = null;
            }
            foreach ($allPosts as $post) {
                $likePostArray[$i] = count(LikePost::where('post_id', '=', $post->id)->get());
                $commentPostArray[$i] = count(Comment::where('post_id', '=', $post->id)->get());
                $i++;
            }
            return view('categories.screen08-pet-category')
                ->with('allPosts', $allPosts)->with('categoryPet', $categoryPet)
                ->with('category', $category)->with('likePostArray', $likePostArray)
                ->with('topUsers', $topUsers)->with('commentPostArray', $commentPostArray)
                ->with('topUsers2', $topUsers2)->with('you', $you)->with('you2', $you2);
        }
        return 0;
    }
}
