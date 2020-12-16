<?php

namespace App\Repositories;

use App\Models\Post;

class PostRepository extends BaseRepository
{
    public function getModel()
    {
        return Post::class;
    }

}
