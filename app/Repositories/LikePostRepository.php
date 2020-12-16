<?php

namespace App\Repositories;

use App\Models\LikePost;

class LikePostRepository extends BaseRepository
{
    public function getModel()
    {
        return LikePost::class;
    }

}
