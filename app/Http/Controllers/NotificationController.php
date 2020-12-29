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
            ->select('notifications.*', 'users.name', 'users.avatar','posts.title')
            ->join('users', 'notifications.fuser_id', '=', 'users.id')
            ->join('posts', 'notifications.post_id', '=', 'posts.id')
            ->where('notifications.user_id', $user->id)
            ->orderBy('notifications.created_at', 'desc')
            ->paginate(5);
        return view('notifications.index')->with('notifications', $notifications);
    }

    public function show($id) {
        $notification = Notification::find($id);
        $notification->status = 1;
        $notification->save();
        $post = Post::find($notification->post_id);

        if(!isset($post)){
            Session::put('message', "Can't find post!");
            return redirect('/');
        } else {
            return redirect('post/' . $post->id);
        }
    }
}
