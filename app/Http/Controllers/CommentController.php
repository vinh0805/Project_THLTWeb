<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Notification;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CommentController extends Controller
{
    public function writeComment(Request $request, $postId)
    {
        $data = $request->all();
        $user = Session::get('sUser');
        if(!$data['commentContent']) {
            return redirect('post/' . $postId)->with('message', "Cannot add blank comment!");
        }
        $newComment = new Comment([
            'post_id' => $postId,
            'user_id' => $user->id,
            'content' => $data['commentContent']
        ]);
        $newComment->save();
        $comment = Comment::orderBy('id', 'desc')->first();
        $cmtList = Comment::where([
            ['postId', $comment->post_id],
            ['user_id', '!=',$comment->user_id],
        ]);
        $post = Post::where('id', $comment->post_id)->first();
        $userPost = User::where('id', $post->user_id)->first();
        $status = false;
        foreach ($cmtList as $cmt) {
            if ($cmt->user_id == $post->user_id){
                $status = true; //if status = false, User who create post doesn't comment -> here is not notification for this user
                $content = $user->name . ' created comment in your post';
            } else {
                $content = $user->name . ' created comment in ' . $userPost->name . ' \'s post';
            }
                $newNotification = new Notification([
                    'user_id' => $cmt->user_id,
                    'fuser_id' => $user->id,
                    'post_id' => $post->id,
                    'comment_id' => $comment->id,
                    'content' => $content,
                ]);
                $newNotification->save();
        }
        if ($status == false) {
            $newNotification = new Notification([
                'user_id' => $post->user_id,
                'fuser_id' => $user->id,
                'post_id' => $post->id,
                'comment_id' => $comment->id,
                'content' => $user->name . ' created comment in your post',
            ]);
            $newNotification->save();
        }
        return redirect('post/' . $postId)->with('message', "Add comment successfully!");
    }
}
