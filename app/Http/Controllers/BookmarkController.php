<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookmarkController extends Controller
{
    public function index($id){
        auth()->user()->bookmarkPosts()->toggle($id);
        return auth()->user()->bookmarkPosts->count();
    }
}
