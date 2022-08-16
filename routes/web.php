<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/login', 'LoginController@login');
// Route::post('/login', 'Auth\LoginController@postLogin');
Route::post('/login-confirm', 'LoginController@loginConfirm');
Route::get('/logout', 'LoginController@logout');
Route::get('/signup', 'LoginController@signup');
Route::get('/signup/success', 'UserController@signupSuccess');

Route::get('/', 'PostController@showPostsHomePage');
Route::get('/home', 'PostController@showPostsHomePage');
Route::post('/signup-submit', 'UserController@createNewUser');
// User
Route::get('/me', 'UserController@showProfile');
Route::post('/update-profile/{userId}', 'UserController@updateProfile');
Route::get('/user/{userId}/info', 'UserController@showUserInfo');

Route::get('/me/password', 'UserController@changePassword');
Route::post('/update-password/{userId}', 'UserController@updatePassword');

// Category
Route::get('/pets-category/{categoryPetName}/{categoryName}', 'CategoryController@showPostOfCategoryPet');

// Post
Route::get('/post/create', 'PostController@createPost');
Route::post('/post/save', 'PostController@savePost')->name('ckeditor.upload');
Route::get('/post/{postId}', 'PostController@showPost');

// Review post
Route::get('requests/post/list', 'PostController@showRequestPostList');
Route::post('review-post/{postId}', 'PostController@reviewPost');

// Comment
Route::post('/post/{postId}/write-comment', 'CommentController@writeComment');

// Like
Route::get('/post/{postId}/update-like', 'LikeController@updateLikeStatus');
Route::get('/post/{commentId}/update-like-comment', 'LikeController@updateLikeCommentStatus');

// Search
Route::get('/search', 'PostController@search');
Route::get('/pets-category/{categoryPetName}/{categoryName}/search-by-category', 'PostController@searchByCategory');

// Notification
Route::get('/me/notifications', 'NotificationController@index');
Route::get('/me/notifications/{notificationId}', 'NotificationController@show');

// Test function
Route::get('/test', 'PostController@findHotPosts');

// Chat function
//Auth::routes();

Route::get('/chat', 'ContactsController@home');
Route::get('/contacts', 'ContactsController@get');
Route::get('/conversation/{id}', 'ContactsController@getMessagesFor');
Route::post('/conversation/send', 'ContactsController@send');

// Friend function
Route::post('/friend/send-request', 'FriendsController@sendRequest');
Route::post('/friend/delete', 'FriendsController@delete');
Route::post('/friend/reply', 'FriendsController@reply');


//Route::group(['middleware' => ['auth']], function () {
//    Route::get('/home', function () {
//        return view('welcome');
//    });
//
//    Route::prefix('users')->name('users.')->group(function () {
//        Route::get('index', 'UserController@index')->name('list');
//    });
//});

Route::get('/_debugbar/assets/stylesheets', [
    'as' => 'debugbar-css',
    'uses' => '\Barryvdh\Debugbar\Controllers\AssetController@css'
]);

Route::get('/_debugbar/assets/javascript', [
    'as' => 'debugbar-js',
    'uses' => '\Barryvdh\Debugbar\Controllers\AssetController@js'
]);

Route::get('/_debugbar/open', [
    'as' => 'debugbar-open',
    'uses' => '\Barryvdh\Debugbar\Controllers\OpenController@handler'
]);
