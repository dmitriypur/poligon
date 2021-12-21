<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function store(Post $post, Request $request)
    {
        $rules = [
            'message' => ['required', 'string'],
            'parent_id' => [''],
            'publish' => [''],
        ];
        $messages = [
            'message.required' => 'Это поле обязательно для заполнения',
        ];
        $data = Validator::make($request->all(), $rules, $messages)->validate();

        $data['user_id'] = auth()->user()->id;
        $data['post_id'] = $post->id;
        $data['parent_id'] = (int)$data['parent_id'];
        Comment::create($data);
        return redirect()->route('show.post', $post->slug);
    }
}
