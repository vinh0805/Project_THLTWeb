<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategoryPet;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Repositories\CategoryRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    public function authLogin()
    {
        if (Session::get('sUser')) {
            return redirect('me');
        } else {
            return redirect('login')->send();
        }
    }

    public function showPostsHomePage()
    {
        $hotPosts = $this->findHotPosts();
        $allCategoryPet = CategoryPet::all();
        $allCategory = Category::all();

        return view('screen04-home-page')->with('allCategoryPet', $allCategoryPet)->with('allCategory', $allCategory)
            ->with('hotPosts', $hotPosts);
    }

    public function findHotPosts()
    {
        $hotPostList = [1, 2, 3];
        return $hotPostList;
    }

    public function createPost()
    {
        $this->authLogin();
        $allCategoryPet = CategoryPet::all();
        $allCategory = Category::all();
        return view('posts.screen18-create-post')->with('allCategoryPet', $allCategoryPet)
            ->with('allCategory', $allCategory);
    }

    public function savePost(Request $request)
    {
        $this->authLogin();
        $data = $request->all();
        $newPost = new Post([
            'user_id' => Session::get('sUser')->id,
            'title' => $data['postTitle'],
            'category_pet_id' => $data['postCategoryPet'],
            'category_id' => $data['postCategory'],
            'content' => $data['postContent'],
            'status' => 0
        ]);
        $newPost->save();
        $currentPost = Post::orderBy('id', 'desc')->first();
        return redirect('post/' . $currentPost->id);
    }

    public function showPost($postId)
    {
        $post = Post::find($postId);
        if(!isset($post)){
            echo "Have bug!!!";
        } else {
            $allComments = DB::table('comments')->join('users', 'comments.user_id', '=', 'users.id')
                ->select('comments.*', 'users.*')->where('post_id', '=', $post->id)->get();
            // $allComments = Comment::where('post_id', '=', $post->id)->get();
            return view('posts.screen13-show-post')
                ->with('post', $post)->with('allComments', $allComments);
        }
        return 0;
    }
}
