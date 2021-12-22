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
Route::post('/{id}/bookmark', 'BookmarkController@index')->name('post.bookmark.store');
Route::post('/{post}/comments', 'CommentController@store')->name('post.comment.store');


Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => 'admin'], function(){
    Route::get('/', 'AdminController@index')->name('admin');

    Route::resource('category', 'CategoryController');
    Route::resource('tag', 'TagController');
    Route::resource('post', 'PostController');
    Route::resource('user', 'UserController');
    Route::resource('reklama', 'ReklamaController');
    Route::resource('comment', 'CommentController');

    Route::get('trash', 'TrashedPostController@index')->name('trash');
    Route::get('restore/{id}', 'TrashedPostController@restore')->name('restore.post');
    Route::delete('trash/{id}', 'TrashedPostController@delete')->name('delete.trash.post');

    Route::get('/bookmark', 'BookmarkController@index')->name('bookmark');
    Route::delete('/bookmark/{id}', 'BookmarkController@delete')->name('bookmark.delete');
});

Route::group(['namespace' => 'Cabinet', 'prefix' => 'cabinet', 'middleware' => 'cabinet'], function(){
    Route::get('/', 'CabinetController@index')->name('cabinet');

    Route::get('subscriptions', 'UserController@index')->name('subscriptions');
    Route::post('users/{user}/follow', 'UserController@follow')->name('user.follow');
    Route::delete('users/{user}/unfollow', 'UserController@unfollow')->name('user.unfollow');

    Route::post('categories/{category}/subscribe', 'UserController@subscribe')->name('category.subscribe');
    Route::delete('categories/{category}/unsubscribe', 'UserController@unsubscribe')->name('category.unsubscribe');
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

Route::group(['middleware' => 'auth'], function(){
    Route::get('/logout', 'UserController@logout')->name('logout');
    Route::get('/notifications', 'UserController@notifications')->name('notifications');
});
