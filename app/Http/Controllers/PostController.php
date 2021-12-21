<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Reklama;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::orderBy('id', 'DESC')->with('likes')->paginate(4);
        $title = 'Новости';
        $reklama = Reklama::select('title', 'link', 'image', 'content', 'publish')->get();
        $currentPage = $posts->currentPage() - 1;
        $count = count($reklama);
        if($request->ajax()){
            $view = view('parts.data', compact('posts', 'reklama', 'count', 'currentPage'))->render();
            return response()->json(['html' => $view, 'reklama' => $reklama]);
        }
        return view('frontend.post.index', compact('posts', 'title', 'reklama', 'count', 'currentPage'));
    }

    public function show($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        $post->view_count += 1;
        $post->update();

        if($post){
            $comments = $post->comments;
            $com = $comments->groupBy('parent_id');
        } else $com = false;
        return view('frontend.post.show', compact('post', 'com'));
    }
}
