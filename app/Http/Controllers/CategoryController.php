<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::with('posts')->get();
        $title = 'Все категории';
        return view('frontend.category.index', compact('categories', 'title'));
    }

    public function show($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $posts = $category->posts()->orderBy('id', 'DESC')->with('likes')->paginate(10);
        $title = "Новости категории '{$category->title}'";
        return view('frontend.category.posts', compact('posts', 'title'));
    }
}
