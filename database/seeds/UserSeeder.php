<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        $user = new User([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => md5('123123'),
            'role' => 1,
            'avatar' => 'defaultAvatar.png'
        ]);
        $user->save();
    }
}
