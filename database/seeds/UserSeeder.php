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
        $password = '123123';
        $user = new User;
        $user->name = "Admin";
        $user->email = "admin@gmail.com";
        $user->password = md5($password);
        $user->role = "1";
        $user->save();
    }
}
