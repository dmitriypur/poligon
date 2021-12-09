<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{

    protected static function publishFavoriteToInt($data){
        if(isset($data['publish'])){
            $data['publish'] = 1;
        }else{
            $data['publish'] = 0;
        }

        if(isset($data['favorite'])){
            $data['favorite'] = 1;
        }else{
            $data['favorite'] = 0;
        }

        return $data;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate(10);
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::pluck('title', 'id')->all();
        $tags = Tag::pluck('title', 'id')->all();
        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $rules = [
            'title' => ['required'],
            'preview' => 'nullable',
            'content' => ['required'],
            'publish' => 'nullable',
            'favorite' => 'nullable',
            'image' => ['nullable', 'image'],
            'category_id' => ['exists:categories,id', 'integer'],
            'user_id' => ['integer'],
            'tag_ids' => ['nullable', 'array'],
            'tag_ids.*' => ['nullable','exists:tags,id', 'integer'],
        ];
        $messages = [
            'title.required' => 'Это поле обязательно для заполнения',
            'content.required' => 'Это поле обязательно для заполнения',
            'image.image' => 'Только изображения',
        ];

        $data = Validator::make($request->all(), $rules, $messages)->validate();
        $data = $this->publishFavoriteToInt($data);

        if(!isset($data['tag_ids'])){
            $tagIds = [];
        }else{
            $tagIds = $data['tag_ids'];
        }
        unset($data['tag_ids']);

        $data['image'] = Post::uploadImage($request);

        $post = Post::firstOrCreate($data);

        $post->tags()->attach($tagIds);

        return redirect()->route('post.index')->with('success', 'Запись добавлена');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::pluck('title', 'id')->all();
        $tags = Tag::pluck('title', 'id')->all();

        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {

        $rules = [
            'title' => ['required'],
            'preview' => 'nullable',
            'content' => ['required'],
            'publish' => 'nullable',
            'favorite' => 'nullable',
            'image' => ['nullable', 'image'],
            'category_id' => ['exists:categories,id', 'integer'],
            'tag_ids' => ['nullable', 'array'],
            'tag_ids.*' => ['nullable','exists:tags,id', 'integer'],
        ];
        $messages = [
            'title.required' => 'Это поле обязательно для заполнения',
            'content.required' => 'Это поле обязательно для заполнения',
            'image.image' => 'Только изображения',
        ];

        $data = Validator::make($request->all(), $rules, $messages)->validate();
        $data = $this->publishFavoriteToInt($data);

        if(!isset($data['tag_ids'])){
            $tagIds = [];
        }else{
            $tagIds = $data['tag_ids'];
        }
        unset($data['tag_ids']);

        $data['image'] = Post::uploadImage($request, $post->image);
        dd($data);
        $post->update($data);

        $post->tags()->sync($tagIds);

        return redirect()->back()->with('success', 'Запись обновлена');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->tags()->sync([]);
        Storage::disk('public')->delete($post->image);
        $post->delete();

        return redirect()->route('post.index');
    }
}
