<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository extends BaseRepository
{
    public function getModel()
    {
        return User::class;
    }

    public function getLastAddedUser()      // use when create new user - UserController
    {
        return User::orderBy('id', 'desc')->first();
    }

    public function findUserByEmail($email)
    {
        return User::where('email', $email)->first();
    }
}
