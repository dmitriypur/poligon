<?php

namespace App\Http\Controllers;

use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('id', 'DESC')->with('likes')->paginate(4);
        $title = 'Новости';
        return view('frontend.post.index', compact('posts', 'title'));
    }

    public function show($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        $post->view_count += 1;
        $post->update();
        return view('frontend.post.show', compact('post'));
    }
}
