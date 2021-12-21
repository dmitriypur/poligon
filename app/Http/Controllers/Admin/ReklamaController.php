<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Reklama;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ReklamaController extends Controller
{
    protected static function publishToInt($data){
        if(isset($data['publish'])){
            $data['publish'] = 1;
        }else{
            $data['publish'] = 0;
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
        $posts = Reklama::all();
        return view('admin.reklama.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::pluck('title', 'id')->all();
        return view('admin.reklama.create', compact('categories'));
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
            'content' => ['nullable'],
            'link' => ['nullable', 'url'],
            'publish' => 'nullable',
            'image' => ['nullable', 'image'],
            'category_id' => ['exists:categories,id', 'integer'],
        ];
        $messages = [
            'title.required' => 'Это поле обязательно для заполнения',
            'link.url' => 'Введите ссылку',
            'image.image' => 'Только изображения',
        ];

        $data = Validator::make($request->all(), $rules, $messages)->validate();
        $data = $this->publishToInt($data);

        $data['image'] = uploadImage($request);

//        dd($data);

        Reklama::firstOrCreate($data);

        return redirect()->route('reklama.index')->with('success', 'Запись добавлена');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Reklama $reklama)
    {
        $categories = Category::pluck('title', 'id')->all();

        return view('admin.reklama.edit', compact('reklama', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reklama $reklama)
    {
        $rules = [
            'title' => ['required'],
            'content' => ['nullable'],
            'link' => ['nullable', 'url'],
            'publish' => 'nullable',
            'image' => ['nullable', 'image'],
            'category_id' => ['exists:categories,id', 'integer'],
        ];
        $messages = [
            'title.required' => 'Это поле обязательно для заполнения',
            'link.url' => 'Введите ссылку',
            'image.image' => 'Только изображения',
        ];

        $data = Validator::make($request->all(), $rules, $messages)->validate();
        $data = $this->publishToInt($data);

        $data['image'] = uploadImage($request, $reklama->image);

        $reklama->update($data);

        return redirect()->back()->with('success', 'Запись обновлена');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reklama $reklama)
    {
        Storage::disk('public')->delete($reklama->image);
        $reklama->delete();

        return redirect()->route('reklama.index');
    }
}
