<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function show($slug)
    {
        $tag = Tag::where('slug', $slug)->firstOrFail();
        $posts =$tag->posts()->orderBy('id', 'DESC')->with('likes')->paginate(10);
        $title = "Новости по тэгу '{$tag->title}'";
        return view('frontend.tag.posts', compact('posts',  'title'));
    }
}
