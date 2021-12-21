<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class BookmarkController extends Controller
{
    public function index(){
        $posts = auth()->user()->bookmarkPosts()->paginate(20);
        return view('admin.bookmark.index', compact('posts'));
    }

    public function delete($id){
        auth()->user()->bookmarkPosts()->detach($id);
        return redirect()->route('bookmark');
    }
}
