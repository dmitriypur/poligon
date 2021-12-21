<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TrashedPostController extends Controller
{
    public function index()
    {
        $trash_posts = Post::onlyTrashed()->where('user_id', auth()->user()->id)->get();

        return view('admin.trash.index', compact('trash_posts'));
    }

    public function restore($id){

        $post = Post::onlyTrashed()
            ->where('user_id', auth()->user()->id)
            ->where('id', $id)->firstOrFail();

        $post->restore();
        return redirect()->back();
    }

    public function delete($id)
    {
        $post = Post::onlyTrashed()
            ->where('user_id', auth()->user()->id)
            ->where('id', $id)->firstOrFail();
        $post->tags()->sync([]);
        Storage::disk('public')->delete($post->image);
        $post->forceDelete();

        return redirect()->route('post.index');
    }
}
