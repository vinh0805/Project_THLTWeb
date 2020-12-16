<?php

namespace App\Repositories;

use App\Models\Notification;

class NotificationRepository extends BaseRepository
{
    public function getModel()
    {
        return Notification::class;
    }

}
