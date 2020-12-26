<?php

namespace App\Http\Controllers;

use App\Models\LikePost;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LikeController extends Controller
{
    public function updateLikeStatus($postId, $userId) {
        $user = Session::get('sUser');
        if (isset($user)) {
            $likePost = LikePost::where('user_id', '=', $userId)->where('post_id', '=', $postId)->first();
            if (isset($likePost)) {
                LikePost::destroy($likePost->id);
            } else {
                $likePost = new LikePost([
                    'user_id' => $userId,
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
}
