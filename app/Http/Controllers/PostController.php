<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategoryPet;
use Illuminate\Http\Request;
use App\Repositories\CategoryRepository;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function showPostsHomePage()
    {
        $hotPosts = $this->findHotPosts();
        $allCategoryPet = CategoryPet::all();
        $allCategory = Category::all();

        return view('screen04-home-page')->with('allCategoryPet', $allCategoryPet)->with('allCategory', $allCategory)
            ->with('hotPosts', $hotPosts);
    }

    public function findHotPosts()
    {
        $hotPostList = [1, 2, 3];
        return $hotPostList;
    }
}
