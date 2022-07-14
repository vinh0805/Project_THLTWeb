<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\LikeComment;
use App\Models\LikePost;
use App\Models\Notification;
use App\Models\Post;
use Illuminate\Support\Facades\Session;

class LikeController extends Controller
{
    public function updateLikeStatus($postId)
    {
        $user = Session::get('sUser');
        if (isset($user)) {
            $post = Post::find($postId);
            $likePost = LikePost::where([
                ['user_id', '=', $user->id],
                ['post_id', '=', $postId],
            ])->first();
            if (isset($likePost)) {
                LikePost::destroy($likePost->id);
                $notification = Notification::where('post_id', '=', $postId)
                    ->where('user_id', '=', $post->user_id)
                    ->where('fuser_id', '=', $user->id)
                    ->where('content', '=', $user->name . ' liked your status')->first();
                if (isset($notification)) {
                    Notification::destroy($notification->id);
                }
            } else {
                $likePost = new LikePost([
                    'user_id' => $user->id,
                    'post_id' => $postId,
                ]);
                $likePost->save();
                $notification = Notification::where('post_id', '=', $postId)
                    ->where('user_id', '=', $post->user_id)
                    ->where('fuser_id', '=', $user->id)
                    ->where('content', '=', $user->name . ' liked your status')->first();
                if (!isset($notification)) {
                    if ($post->user_id != $user->id) {
                        $newNotification = new Notification([
                            'user_id' => $post->user_id,
                            'fuser_id' => $user->id,
                            'post_id' => $post->id,
                            'content' => $user->name . ' liked your status',
                        ]);
                        $newNotification->save();
                    }
                }
            }
            if (!isset($post)) {
                Session::put('message', "Have something wrong!");
                return redirect('home');
            } else {
                $likePostNumber = count(LikePost::where('post_id', '=', $postId)->get());
                return response()->json($likePostNumber);
            }
        } else return redirect('home');
    }

    public function updateLikeCommentStatus($commentId)
    {
        $user = Session::get('sUser');
        if (isset($user)) {
            $comment = Comment::find($commentId);
            $likeComment = LikeComment::where([
                ['user_id', '=', $user->id],
                ['comment_id', '=', $commentId],
            ])->first();
            if (isset($likeComment)) {
                likeComment::destroy($likeComment->id);
                $notification = Notification::where('comment_id', '=', $commentId)
                    ->where('post_id', '=', $comment->post_id)
                    ->where('user_id', '=', $comment->user_id)
                    ->where('fuser_id', '=', $user->id)
                    ->where('content', '=', $user->name . ' liked your comment')->first();
                Notification::destroy($notification->id);
            } else {
                $likeComment = new likeComment([
                    'user_id' => $user->id,
                    'comment_id' => $commentId
                ]);
                $likeComment->save();
                $notification = Notification::where('comment_id', '=', $commentId)
                    ->where('post_id', '=', $comment->post_id)
                    ->where('user_id', '=', $comment->user_id)
                    ->where('fuser_id', '=', $user->id)
                    ->where('content', '=', $user->name . ' liked your comment')->first();
                if (!$notification) {
                    if ($comment->user_id != $user->id) {
                        $newNotification = new Notification([
                            'user_id' => $comment->user_id,
                            'fuser_id' => $user->id,
                            'post_id' => $comment->post_id,
                            'comment_id' => $comment->id,
                            'content' => $user->name . ' liked your comment',
                        ]);
                        $newNotification->save();
                    }
                }
            }
            $comment = Comment::find($commentId);
            if (!isset($comment)) {
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
