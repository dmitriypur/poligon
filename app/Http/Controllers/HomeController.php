<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){

        $favorite = Post::where('favorite', 1)->first();
        $posts = Post::orderBy('id', 'DESC')->limit(6)->get();
        return view('home', compact('posts', 'favorite'));
    }
}
