<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LikeComment extends Model
{
    protected $table = 'like_comment';
    protected $fillable = ['id', 'comment_id', 'user_id'];
}
