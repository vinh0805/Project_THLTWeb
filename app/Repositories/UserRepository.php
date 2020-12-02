<?php

namespace App\Repositories;

use App\Models\Users;

class UserRepository extends BaseRepository
{
    public function getModel()
    {
        return Users::class;
    }

    public function getLastAddedUser()      // use when create new user - UserController
    {
        return Users::orderBy('id', 'desc')->first();
    }

    public function findUserByEmail($email)
    {
        return Users::where('email', $email)->first();
    }
}
