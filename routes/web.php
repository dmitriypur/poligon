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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/posts', 'PostController@index')->name('posts');
Route::get('/posts/{slug}', 'PostController@show')->name('show.post');
Route::get('/categories', 'CategoryController@index')->name('categories');
Route::get('/categories/{slug}', 'CategoryController@show')->name('category.single');
Route::get('/tag/{slug}', 'TagController@show')->name('tag.single');

Route::post('/{id}/likes', 'LikeController@index')->name('post.like.store');




Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => 'admin'], function(){
    Route::get('/', 'AdminController@index')->name('admin');

    Route::resource('category', 'CategoryController');
    Route::resource('tag', 'TagController');
    Route::resource('post', 'PostController');
    Route::resource('user', 'UserController');
});

Route::group(['middleware' => 'guest'], function(){
    Route::get('/register', 'UserController@create')->name('register.create');
    Route::post('/register', 'UserController@store')->name('register.store');

    Route::get('/login', 'UserController@loginForm')->name('login.create');
    Route::post('/login', 'UserController@login')->name('login');

    Route::get('/forgot-password', 'UserController@forgotPassword')->name('password.request');
    Route::post('/forgot-password', 'UserController@forgot')->name('password.email');

    Route::get('/reset-password/{token}', 'UserController@resetPassword')->name('password.reset');
    Route::post('/reset-password', 'UserController@updatePassword')->name('password.update');
});


Route::get('/logout', 'UserController@logout')->name('logout')->middleware('auth');
