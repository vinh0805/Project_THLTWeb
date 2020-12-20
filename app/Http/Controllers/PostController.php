<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategoryPet;
use Illuminate\Http\Request;
use App\Repositories\CategoryRepository;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
//    /**
//     * Display a listing of the resource.
//     *
//     * @return \Illuminate\Http\Response
//     */
//    public function index()
//    {
//        //
//    }
//
//    /**
//     * Show the form for creating a new resource.
//     *
//     * @return \Illuminate\Http\Response
//     */
//    public function create()
//    {
//        //
//    }
//
//    /**
//     * Store a newly created resource in storage.
//     *
//     * @param  \Illuminate\Http\Request  $request
//     * @return \Illuminate\Http\Response
//     */
//    public function store(Request $request)
//    {
//        //
//    }
//
//    /**
//     * Display the specified resource.
//     *
//     * @param  int  $id
//     * @return \Illuminate\Http\Response
//     */
//    public function show($id)
//    {
//        //
//    }
//
//    /**
//     * Show the form for editing the specified resource.
//     *
//     * @param  int  $id
//     * @return \Illuminate\Http\Response
//     */
//    public function edit($id)
//    {
//        //
//    }
//
//    /**
//     * Update the specified resource in storage.
//     *
//     * @param  \Illuminate\Http\Request  $request
//     * @param  int  $id
//     * @return \Illuminate\Http\Response
//     */
//    public function update(Request $request, $id)
//    {
//        //
//    }
//
//    /**
//     * Remove the specified resource from storage.
//     *
//     * @param  int  $id
//     * @return \Illuminate\Http\Response
//     */
//    public function destroy($id)
//    {
//        //
//    }

    public function showPostsHomePage()
    {
        $hotPosts = $this->findHotPosts();
        $allCategoryPet = CategoryPet::all();
        $allCategory = Category::all();
        $allDogCategory = DB::table('categories')->join('category_pet', 'categories.category_pet_id',
            '=', 'category_pet.id')->where('category_pet.name', '=', 'dog')
            ->select('categories.*', 'category_pet.name as category_pet_name')->get();
        $allCatCategory = DB::table('categories')->join('category_pet', 'categories.category_pet_id',
            '=', 'category_pet.id')->where('category_pet.name', '=', 'cat')
            ->select('categories.*', 'category_pet.name as category_pet_name')->get();
        $allOthersCategory = DB::table('categories')->join('category_pet', 'categories.category_pet_id',
            '=', 'category_pet.id')->where('category_pet.name', '=', 'others')
            ->select('categories.*', 'category_pet.name as category_pet_name')->get();

        return view('screen04-home-page')->with('allCategoryPet', $allCategoryPet)->with('allCategory', $allCategory)
            ->with('allDogCategory', $allDogCategory)->with('allCatCategory', $allCatCategory)
            ->with('allOthersCategory', $allOthersCategory)->with('hotPosts', $hotPosts);
    }

    public function findHotPosts()
    {
        $hotPostList = [1, 2, 3];
        return $hotPostList;
    }
}
