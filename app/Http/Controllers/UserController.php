<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\Input;

class UserController extends Controller
{
    public function create(){
        return view('user.create');
    }

    public function store(Request $request){

        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ];
        $messages = [
            'name.required' => 'Обязательно для заполнения',
            'email.required' => 'Обязательно для заполнения',
            'email.email' => 'Введите настоящий email',
            'email.unique' => 'Пользователь с таким email уже существует!',
            'password.required' => 'Обязательно для заполнения',
            'password.confirmed' => 'Пароли не совпадают',
        ];

        $data = Validator::make($request->all(), $rules, $messages)->validate();
        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);

        session()->flash('success', 'Вы успешно зарегистрировались!');
        Auth::login($user);

        return redirect()->route('home');
    }

    public function loginForm(){
        return view('user.login');
    }

    public function login(Request $request){
        $remember = ($request['remember'] == 'on') ? true : false;

        $rules = [
            'email' => 'required|email',
            'password' => 'required',
        ];
        $messages = [
            'email.required' => 'Обязательно для заполнения',
            'email.email' => 'Введите настоящий email',
            'password.required' => 'Обязательно для заполнения',
        ];
        $data = Validator::make($request->all(), $rules, $messages)->validate();

        if(Auth::attempt([
            'email' => $data['email'],
            'password' => $data['password']
        ],$remember)){
            session()->flash('success', 'Вы успешно авторизовались!');
            if (Auth::check() || Auth::viaRemember()){
                if(Auth::user()->is_admin){
                    return redirect()->route('admin');
                }else{
                    return redirect()->route('home');
                }
            }

        }

        return redirect()->back()->with('error', 'Не правильный логин, или пароль');
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('home');
    }

    public function forgotPassword(){
        return view('user.forgot-password');
    }

    public function forgot (Request $request) {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    public function resetPassword($token) {
        return view('user.reset-password', ['token' => $token]);
    }

    public function updatePassword(Request $request) {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:5|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status == Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }

    public function notifications()
    {
        return auth()->user()->unreadNotifications()->limit(5)->get()->toArray();
    }
}
