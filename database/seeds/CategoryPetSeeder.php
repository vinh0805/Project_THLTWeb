<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\CategoryPet;

class CategoryPetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category_pet')->delete();
        $names = ['DOG', 'CAT', 'OTHERS'];
        foreach ($names as $name) {
            $category_pet = new CategoryPet;
            $category_pet->name = $name;
            $category_pet->save();
        }
    }
}
