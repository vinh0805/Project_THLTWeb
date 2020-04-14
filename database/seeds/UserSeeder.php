<?php

use Illuminate\Database\Seeder;

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
        $password = 'kiai@123';
        $user = new User;
        $user->name = "Admin";
        $user->email = "admin@kiaisoft.com";
        $user->password = $password;
        $user->save();
    }
}
