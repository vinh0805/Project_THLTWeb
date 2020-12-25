<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategoryPet;
use App\Models\Post;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function showPostOfCategoryPet($categoryPetName, $categoryName)
    {
        $categoryPet = CategoryPet::where('name', $categoryPetName)->first();
        $category = Category::where('name', $categoryName)->first();
        if(isset($categoryPet) && isset($category)){
            $allPosts = Post::where('category_pet_id', $categoryPet->id)
                ->where('category_id', $category->id)->where('status', 1)->get();
            return view('categories.screen08-pet-category')
                ->with('allPosts', $allPosts)->with('categoryPet', $categoryPet)
                ->with('category', $category);
        }
        return 0;
    }
}
