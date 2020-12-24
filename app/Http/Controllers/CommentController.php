<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CommentController extends Controller
{
    public function writeComment(Request $request, $postId)
    {
        $data = $request->all();
        $newComment = new Comment([
            'post_id' => $postId,
            'user_id' => Session::get('sUser')->id,
            'content' => $data['commentContent']
        ]);
        $newComment->save();
        return redirect('post/' . $postId)->with('message', "Add comment successfully!");
    }
}
