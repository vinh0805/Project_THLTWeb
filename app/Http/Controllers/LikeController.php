<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\LikeComment;
use App\Models\LikePost;
use App\Models\Post;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Mockery\Matcher\Not;

class LikeController extends Controller
{
    public function updateLikeStatus($postId) {
        $user = Session::get('sUser');
        if (isset($user)) {
            $likePost = LikePost::where([
                ['user_id', '=', $user->id],
                ['post_id', '=', $postId],
            ])->first();
            if (isset($likePost)) {
                LikePost::destroy($likePost->id);
                $notification = Notification::where([
                    ['fuser_id' => $user->id],
                    ['post_id' => $postId],
                ])->first();
                Notification::destroy($notification->id);
            } else {
                $likePost = new LikePost([
                    'user_id' => $user->id,
                    'post_id' => $postId,
                ]);
                $likePost->save();
                $post = Post::where('id', $postId)->first();
                $newNotification = new Notification([
                    'user_id' => $post->user_id,
                    'fuser_id' => $user->id,
                    'post_id' => $post->id,
                    'content' => $user->name . ' liked your status',
                ]);
                $newNotification->save();
            }
            $post = Post::find($postId);
            if(!isset($post)){
                Session::put('message', "Have something wrong!");
                return redirect('home');
            } else {
                $likePostNumber = count(LikePost::where('post_id', '=', $post->id)->get());
                return response()->json($likePostNumber);
            }
        } else return redirect('home');
    }

    public function updateLikeCommentStatus($commentId)
    {
        $user = Session::get('sUser');
        if (isset($user)) {
            $likeComment = LikeComment::where([
                ['user_id', '=', $user->id],
                ['comment_id', '=', $commentId],
            ])->first();
            if (isset($likeComment)) {
                likeComment::destroy($likeComment->id);
                $notification = Notification::where([
                    ['fuser_id' => $user->id],
                    ['comment_id' => $commentId],
                ])->first();
                Notification::destroy($notification->id);
            } else {
                $likeComment = new likeComment([
                    'user_id' => $user->id,
                    'comment_id' => $commentId
                ]);
                $likeComment->save();
                $comment = Comment::where('id', $commentId)->first();
                $newNotification = new Notification([
                    'user_id' => $comment->user_id,
                    'fuser_id' => $user->id,
                    'post_id' => $comment->post_id,
                    'comment_id' => $comment->id,
                    'content' => $user->name . ' liked your comment',
                ]);
                $newNotification->save();
            }
            $comment = Comment::find($commentId);
            if(!isset($comment)){
                Session::put('message', "Have something wrong!");
                return redirect('home');
            } else {
                $likeCommentNumber = count(likeComment::where('comment_id', '=', $comment->id)->get());
                return response()->json([
                    'likeCommentNumber' => $likeCommentNumber,
                    'commentId' => $commentId
                ]);
            }
        } else return redirect('home');
    }
}
