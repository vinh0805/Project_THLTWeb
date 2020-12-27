<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\LikeComment;
use App\Models\LikePost;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LikeController extends Controller
{
    public function updateLikeStatus($postId) {
        $user = Session::get('sUser');
        if (isset($user)) {
            $likePost = LikePost::where('user_id', '=', $user->id)->where('post_id', '=', $postId)->first();
            if (isset($likePost)) {
                LikePost::destroy($likePost->id);
            } else {
                $likePost = new LikePost([
                    'user_id' => $user->id,
                    'post_id' => $postId
                ]);
                $likePost->save();
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
            $likeComment = LikeComment::where('user_id', '=', $user->id)
                ->where('comment_id', '=', $commentId)->first();
            if (isset($likeComment)) {
                likeComment::destroy($likeComment->id);
            } else {
                $likeComment = new likeComment([
                    'user_id' => $user->id,
                    'comment_id' => $commentId
                ]);
                $likeComment->save();
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
