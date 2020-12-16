<?php

namespace App\Repositories;

use App\Models\LikeComment;

class LikeCommentRepository extends BaseRepository
{
    public function getModel()
    {
        return LikeComment::class;
    }

}
