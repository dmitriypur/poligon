<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::paginate(10);
        return view('admin.tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tags.create');
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
        ];
        $messages = [
            'title.required' => 'Это поле обязательно для заполнения',
        ];

        $data = Validator::make($request->all(), $rules, $messages)->validate();

        Tag::create($data);

        return redirect()->route('tag.index')->with('success', 'Тэг добавлен');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        return view('admin.tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {

        $rules = [
            'title' => ['required'],
        ];
        $messages = [
            'title.required' => 'Это поле обязательно для заполнения',
        ];

        $data = Validator::make($request->all(), $rules, $messages)->validate();

        $tag->update($data);

        return redirect()->back()->with('success', 'Тэг обновлен');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();
        return redirect()->route('tag.index');
    }
}
