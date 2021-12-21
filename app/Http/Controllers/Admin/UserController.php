<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(10);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = User::getRoles();
        return view('admin.users.create', compact('roles'));
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
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'is_admin' => ['nullable', 'integer'],
        ];
        $messages = [
            'name.required' => 'Обязательно для заполнения',
            'email.required' => 'Обязательно для заполнения',
            'email.email' => 'Введите настоящий email',
            'email.unique' => 'Пользователь с таким email уже существует!',
            'password.required' => 'Обязательно для заполнения',
        ];

        $data = Validator::make($request->all(), $rules, $messages)->validate();
        $data['password'] = bcrypt($data['password']);

        User::create($data);

        session()->flash('success', 'Пользователь добавлен');

        return redirect()->route('user.index');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = User::getRoles();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|email',
            'is_admin' => ['nullable', 'integer'],
            'lastname' => ['nullable'],
            'surname' => ['nullable'],
            'photo' => ['nullable', 'image'],
            'phone' => ['nullable', 'numeric'],
            'address' => ['nullable'],
            'organization' => ['nullable'],
            'about' => ['nullable'],
            'dr' => ['nullable', 'date'],
        ];
        $messages = [
            'name.required' => 'Обязательно для заполнения',
            'email.required' => 'Обязательно для заполнения',
            'email.email' => 'Введите настоящий email',
            'photo.image' => 'Только изображения',
            'phone.numeric' => 'Только цифры',
            'dr.date' => 'Введите корректную дату',
        ];

        $data = Validator::make($request->all(), $rules, $messages)->validate();
        $data['photo'] = User::uploadAvatar($request, $user->photo);

        $user->update($data);

        session()->flash('success', 'Изменения сохранены');
        return redirect(route('user.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect(route('user.index'))->with('success', "Пользователь {$user->name} удален");
    }
}
