<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\Post;

class NotificationController extends Controller
{
    public function index() {
        $notifications = Notification::orderBy('created_at', 'desc')->paginate(10);
        return view('notifications.index')->with('notifications', $notifications);
    }

    public function show($id) {
        $notification = Notification::find($id);
        $postId = $notification->post_id;
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
