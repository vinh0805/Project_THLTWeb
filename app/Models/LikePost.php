<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LikePost extends Model
{
    protected $table = 'like_post';
    protected $fillable = ['id', 'post_id', 'user_id'];
}
