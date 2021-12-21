<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Reklama;
use App\Models\Tag;

class HomeController extends Controller
{
    public function index(){

        $favorite = Post::where('favorite', 1)->first();
        $posts = Post::orderBy('id', 'DESC')->with('likes')->limit(6)->get();
        $postsSlider = Post::orderBy('view_count', 'DESC')->limit(6)->get();
        $reklama = Reklama::all();
        $title = 'Главная страница';
        return view('home', compact('posts', 'favorite', 'title', 'postsSlider', 'reklama'));
    }
}
