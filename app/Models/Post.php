<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    protected $fillable = ['id', 'user_id', 'title', 'category_pet_id', 'category_id', 'content', 'status'];
}
