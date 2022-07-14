<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategoryPet;
use App\Models\Comment;
use App\Models\LikeComment;
use App\Models\LikePost;
use App\Models\Notification;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    public function showPostsHomePage()
    {
        $allCategoryPet = CategoryPet::all();
        $allCategory = Category::all();
        $hotPosts = DB::table('posts')
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->select('posts.*', 'users.name', 'users.avatar')
            ->whereIn('posts.id', $this->findHotPosts())->get();
        $hotPostLikeArray = [];
        $hotPostCommentArray = [];
        $countPost = [];
        $countComment = [];
        $newestPostList = [];
        $i = 0;
        foreach ($allCategoryPet as $categoryPet) {
            foreach ($allCategory as $category) {
                $countPost[$i] = count(Post::where('category_pet_id', '=', $categoryPet->id)
                    ->where('category_id', '=', $category->id)->where('status', '=', 1)->get());
                $countComment[$i] = count(DB::table('posts')
                    ->join('comments', 'posts.id', '=', 'comments.post_id')
                    ->where('category_pet_id', '=', $categoryPet->id)
                    ->where('category_id', '=', $category->id)
                    ->where('status', '=', 1)->get());
                $newestPostList[$i] = Post::where('category_pet_id', '=', $categoryPet->id)
                    ->where('category_id', '=', $category->id)->where('status', '=', 1)
                    ->orderBy('created_at', 'desc')->first();
                $i++;
            }
        }
        $i2 = 0;
        foreach ($hotPosts as $post) {
            $hotPostLikeArray[$i2] = count(LikePost::where('post_id', '=', $post->id)->get());
            $hotPostCommentArray[$i2] = count(Comment::where('post_id', '=', $post->id)->get());
            $i2++;
        }

        return view('screen04-home-page')->with('allCategoryPet', $allCategoryPet)
            ->with('allCategory', $allCategory)->with('hotPosts', $hotPosts)
            ->with('countPost', $countPost)->with('countComment', $countComment)
            ->with('newestPostList', $newestPostList)
            ->with('hotPostLikeArray', $hotPostLikeArray)
            ->with('hotPostCommentArray', $hotPostCommentArray);
    }

    public function findHotPosts()
    {
        $allPosts = Post::all();
        $hotPostList = [];
        $hotPostIdList = [];

        foreach ($allPosts as $post) {
            $likePostNumber = count(LikePost::where('post_id', '=', $post->id)->get());
            $commentPostNumber = count(Comment::where('post_id', '=', $post->id)->get());
            $hotPostPoint = $likePostNumber + 3 * $commentPostNumber;
            if ($hotPostPoint > 0) {
                array_push($hotPostList, (object)[
                    'id' => $post->id,
                    'point' => $hotPostPoint
                ]);
            }
        }
        usort($hotPostList, function ($a, $b) {
            return $a->point < $b->point;
        });
        $bestHotPosts = array_slice($hotPostList, 0, 5);
        foreach ($bestHotPosts as $bestHotPost) {
            array_push($hotPostIdList, $bestHotPost->id);
        }
        return $hotPostIdList;
    }

    public function createPost()
    {
        $this->authLogin();
        $allCategoryPet = CategoryPet::all();
        $allCategory = Category::all();
        return view('posts.screen18-create-post')->with('allCategoryPet', $allCategoryPet)
            ->with('allCategory', $allCategory);
    }

    public function authLogin()
    {
        if (Session::get('sUser')) {
            return redirect('me');
        } else {
            return redirect('login')->send();
        }
    }

    public function savePost(Request $request)
    {
        $this->authLogin();
        $data = $request->all();
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;

            $request->file('upload')->move(public_path('posts'), $fileName);

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('posts/' . $fileName);
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
        $admin = User::where('role', 1)->first();
        $content = Session::get('sUser')->name . '\'s Post need approve';
        $currentPost = Post::orderBy('id', 'desc')->first();
        if ($admin->id != Session::get('sUser')->id) {
            $newNotification = new Notification([
                'post_id' => $currentPost->id,
                'user_id' => $admin->id,
                'fuser_id' => Session::get('sUser')->id,
                'content' => $content,
            ]);
            $newNotification->save();
        }
        return redirect('post/' . $currentPost->id);
    }

    public function showPost($postId)
    {
        $user = Session::get('sUser');
        $post = DB::table('posts')
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->select('posts.*', 'users.name', 'users.avatar')
            ->where('posts.id', '=', $postId)->first();
        if (!isset($post)) {
            echo "Have bug!!!";
        } else {
            $likePostNumber = count(LikePost::where('post_id', '=', $post->id)->get());
            $allComments = DB::table('comments')
                ->join('users', 'comments.user_id', '=', 'users.id')
                ->select('comments.*', 'users.name', 'users.avatar')
                ->where('post_id', '=', $post->id)
                ->paginate(10);
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
            if (isset($user)) {
                $likePost = LikePost::where('user_id', '=', $user->id)->where('post_id', '=', $post->id)->first();
                $postIsLiked = isset($likePost) ? 1 : 0;
                return view('posts.screen13-show-post')->with('likeArray', $likeArray)
                    ->with('post', $post)->with('allComments', $allComments)->with('likePostNumber', $likePostNumber)
                    ->with('postIsLiked', $postIsLiked)->with('commentIsLikedArray', $commentIsLikedArray);
            } else {
                return view('posts.screen13-show-post')->with('likeArray', $likeArray)
                    ->with('post', $post)->with('allComments', $allComments)->with('likePostNumber', $likePostNumber);
            }
        }
        return 0;
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            if ($request['title'] == '' || $request['title'] == null) {
                $output = '';
            } else {
                $posts = Post::where('title', 'LIKE', '%' . $request['title'] . '%')
                    ->where('status', '=', '1')->get();
                $output = '';

                if (count($posts) > 0) {
                    $output = '<ul class="list-group" style="display: block; position: relative; z-index: 1">';
                    foreach ($posts as $post) {
                        $output .= '<li class="list-group-item"><a href="post/' . $post->id . '">' . $post->title . '</a></li>';
                    }
                    $output .= '</ul>';
                } else {
                    $output .= '<li class="list-group-item">' . 'No results' . '</li>';
                }
            }
            return $output;
        }
    }

    public function searchByCategory(Request $request)
    {
        if ($request->ajax()) {
            if ($request['title'] == '' || $request['title'] == null) {
                $output = '';
            } else {
                $posts = Post::where('title', 'LIKE', '%' . $request['title'] . '%')
                    ->where('category_id', '=', $request['category'])
                    ->where('category_pet_id', '=', $request['categoryPet'])
                    ->where('status', '=', '1')->get();
                $output = '';

                if (count($posts) > 0) {
                    $output = '<ul class="list-group" style="display: block; position: relative;
                                                             z-index: 1; overflow: hidden">';
                    foreach ($posts as $post) {
                        $output .= '<li class="list-group-item"><a href="post/' . $post->id . '">' . $post->title . '</a></li>';
                    }
                    $output .= '</ul>';
                } else {
                    $output .= '<li class="list-group-item">' . 'No results' . '</li>';
                }
            }
            return $output;
        }
    }

    public function showRequestPostList()
    {
        if ($this->isAdmin()) {
            $allRequestPosts = Post::where('status', '=', '0')->get();
            return view('posts.screen19-request-post-list')->with('allRequestPosts', $allRequestPosts);
        } else return redirect('home');
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

    public function reviewPost(Request $request, $postId)
    {
        if ($this->isAdmin()) {
            $post = Post::find($postId);
            if (isset($post)) {
                $acceptance = $request['submitButton'];
                if ($acceptance) {
                    $post->status = 1;
                    $post->save();
                    $newNotification = new Notification([
                        'user_id' => $post->user_id,
                        'fuser_id' => Session::get('sUser')->id,
                        'post_id' => $post->id,
                        'content' => 'Admin approved your post',
                    ]);
                    $newNotification->save();
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
