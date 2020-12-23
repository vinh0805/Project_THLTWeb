<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Category;

class categorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->delete();
        $names = ['show-off', 'experience', 'give', 'relief', 'meme'];
        foreach ($names as $name) {
            $category = new Category;
            $category->name = $name;
            $category->save();
        }
    }
}
