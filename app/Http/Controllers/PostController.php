<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategoryPet;
use App\Models\Comment;
use App\Models\LikeComment;
use App\Models\LikePost;
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

    public function isAdmin()
    {
        $this->authLogin();
        $user = Session::get('sUser');
        if (isset($user->role)) {
            if ($user->role == 1)
                return 1;
        }
        return 0;
    }


    public function showPostsHomePage()
    {
        $allCategoryPet = CategoryPet::all();
        $allCategory = Category::all();
        $hotPosts = Post::find($this->findHotPosts());
        $countPost = [];
        $countLike = [];
        $newestPostList = [];
        $i = 0;
        foreach ($allCategoryPet as $categoryPet) {
            foreach ($allCategory as $category) {
                $countPost[$i] = count(Post::where('category_pet_id', '=', $categoryPet->id)
                    ->where('category_id', '=', $category->id)->where('status', '=', 1)->get());
                $countLike[$i] = count(DB::table('posts')
                    ->join('like_post', 'posts.id', '=', 'like_post.post_id')
                    ->where('category_pet_id', '=', $categoryPet->id)
                    ->where('category_id', '=', $category->id)
                    ->where('status', '=', 1)->get());
                $newestPostList[$i] = Post::where('category_pet_id', '=', $categoryPet->id)
                    ->where('category_id', '=', $category->id)->where('status', '=', 1)
                    ->orderBy('created_at', 'desc')->first();
                $i++;
            }
        }

        return view('screen04-home-page')->with('allCategoryPet', $allCategoryPet)
            ->with('allCategory', $allCategory)->with('hotPosts', $hotPosts)
            ->with('countPost', $countPost)->with('countLike', $countLike)
            ->with('newestPostList', $newestPostList);
    }

    public function findHotPosts()
    {
        $allPosts = Post::all();
        $hotPostList = [];
        $hotPostIdList = [];

        foreach ($allPosts as $post) {
            $likePostNumber = count(LikePost::where('post_id', '=', $post->id)->get());
            $commentPostNumber = count(Comment::where('post_id', '=', $post->id)->get());
            $hotPostPoint = $likePostNumber + 3*$commentPostNumber;
            if($hotPostPoint > 0) {
                array_push($hotPostList, (object)[
                    'id' => $post->id,
                    'point' => $hotPostPoint
                ]);
            }
        }
        usort($hotPostList, function($a, $b) {
            return $a->point < $b->point;
        });
        $bestHotPosts = array_slice($hotPostList, 0, 5);
        foreach ($bestHotPosts as $bestHotPost) {
            array_push($hotPostIdList, $bestHotPost->id);
        }
        return $hotPostIdList;

        // return view('test-view')->with('hotPostList', $hotPostIdList);
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
        if($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName.'_'.time().'.'.$extension;

            $request->file('upload')->move(public_path('posts'), $fileName);

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('posts/'.$fileName);
            $msg = 'Image uploaded successfully';
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

            @header('Content-type: text/html; charset=utf-8');
            echo $response;
        }
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
        $user = Session::get('sUser');
        $post = Post::find($postId);
        if(!isset($post)){
            echo "Have bug!!!";
        } else {
            $likePostNumber = count(LikePost::where('post_id', '=', $post->id)->get());
            $allComments = DB::table('comments')->join('users', 'comments.user_id', '=', 'users.id')
                ->select('comments.*', 'users.name', 'users.avatar')->where('post_id', '=', $post->id)->get();
            $likeArray = [];
            $commentIsLikedArray = [];
            $i = 0;
            foreach ($allComments as $comment) {
                $likeArray[$i] = count(LikeComment::where('comment_id', '=', $comment->id)->get());
                if (isset($user)) {
                    $likeComment = LikeComment::where('user_id', '=', $user->id)->where('comment_id', '=', $comment->id)->first();
                    $commentIsLikedArray[$i] = isset($likeComment) ? 1 : 0;
                }
                $i++;
            }
            $user = Session::get('sUser');
            if (isset($user)){
                $likePost = LikePost::where('user_id', '=', $user->id)->where('post_id', '=', $post->id)->first();
                $postIsLiked = isset($likePost) ? 1 : 0;
                return view('posts.screen13-show-post')->with('likeArray' ,$likeArray)
                    ->with('post', $post)->with('allComments', $allComments)->with('likePostNumber', $likePostNumber)
                    ->with('postIsLiked', $postIsLiked)->with('commentIsLikedArray', $commentIsLikedArray);
            } else {
                return view('posts.screen13-show-post')->with('likeArray' ,$likeArray)
                    ->with('post', $post)->with('allComments', $allComments)->with('likePostNumber', $likePostNumber);
            }
        }
        return 0;
    }

    public function search(Request $request){
        if($request->ajax()) {
            if ($request['title'] == '' || $request['title'] == null) {
                $output = '';
            } else {
                $posts = Post::where('title', 'LIKE', '%'.$request['title'].'%')
                    ->where('status', '=', '1')->get();
                $output = '';

                if (count($posts) > 0) {
                    $output = '<ul class="list-group" style="display: block; position: relative; z-index: 1">';
                    foreach ($posts as $post){
                        $output .= '<li class="list-group-item"><a href="post/' . $post->id . '">'.$post->title.'</a></li>';
                    }
                    $output .= '</ul>';
                } else {
                    $output .= '<li class="list-group-item">'.'No results'.'</li>';
                }
            }
            return $output;
        }
    }

    public function showRequestPostList()
    {
        if($this->isAdmin()){
            $allRequestPosts = Post::where('status', '=', '0')->get();
            return view('posts.screen19-request-post-list')->with('allRequestPosts' ,$allRequestPosts);
        } else return redirect('home');
    }

    public function reviewPost(Request $request, $postId)
    {
        if($this->isAdmin()){
            $post = Post::find($postId);
            if (isset($post)) {
                $acceptance = $request['submitButton'];
                if ($acceptance){
                    $post->status = 1;
                    $post->save();
                    Session::put('message', "This post is accepted!");
                    return redirect('post/' . $postId);
                } else {
                    Post::destroy($postId);
                    Session::put('message', "This post is deleted!");
                    return redirect('requests/post/list');
                }
            } else {
                Session::put('message', "Something wrong here!");
                return redirect('home');
            }
        } else return redirect('home');
    }
}
