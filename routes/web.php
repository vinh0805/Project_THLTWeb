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

Route::get('/login', 'Auth\LoginController@getLogin')->name('login');
Route::post('/login', 'Auth\LoginController@postLogin');
Route::post('/login-confirm', 'LoginController@loginConfirm');
Route::get('/logout', 'Auth\LoginController@logout');
Route::get('/home', function (){
    return view('screen04-home-page');
});

// User
Route::get('/me', 'UserController@showProfile');
Route::post('/update-profile/{userId}', 'UserController@updateProfile');

Route::get('/me/password', 'UserController@changePassword');
Route::post('/update-password/{userId}', 'UserController@updatePassword');



//Route::group(['middleware' => ['auth']], function () {
//    Route::get('/home', function () {
//        return view('welcome');
//    });
//
//    Route::prefix('users')->name('users.')->group(function () {
//        Route::get('index', 'UserController@index')->name('list');
//    });
//});
