<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Doctrine\DBAL\Types\ObjectType;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class NotificationController extends Controller
{
    public function index() {
        $user = Session::get('sUser');
        $notifications = DB::table('notifications')
            ->select('notifications.*', 'users.name', 'posts.title')
            ->join('users', 'notifications.fuser_id', '=', 'users.id')
            ->join('posts', 'notifications.post_id', '=', 'posts.id')
            ->where('notifications.user_id', $user->id)
            ->orderBy('notifications.created_at', 'desc')
            ->get();
        return view('notifications.index')->with('notifications', $notifications);
        return $notifications;
    }

    public function show($id) {
        $notification = Notification::find($id);
        $post = Post::find($notification->post_id);
        
        if(!isset($post)){
            echo "Have bug!!!";
        } else {
            $allComments = DB::table('comments')->join('users', 'comments.user_id', '=', 'users.id')
                ->select('comments.*', 'users.*')->where('post_id', '=', $post->id)->get();
            // $allComments = Comment::where('post_id', '=', $post->id)->get();
            return view('posts.screen13-show-post')
                ->with('post', $post)
                ->with('allComments', $allComments);
        }
        return 0;
    }
}
