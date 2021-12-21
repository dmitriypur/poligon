<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\UserFollowed;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('id', '!=', auth()->user()->id)->get();
        return view('cabinet.subscriptions', compact('users'));
    }

    public function follow(User $user)
    {
        $follower = auth()->user();
        if ($follower->id == $user->id) {
            return back()->withError("Вы не можете подписаться на себя");
        }
        if(!$follower->isFollowing($user->id)) {
            $follower->follow($user->id);

            // отправка уведомления
            $user->notify(new UserFollowed($follower));

            return back()->withSuccess("Вы подписались на новости пользователя {$user->name}");
        }
        return back()->withError("Вы уже подписаны на {$user->name}");
    }

    public function unfollow(User $user)
    {
        $follower = auth()->user();
        if($follower->isFollowing($user->id)) {
            $follower->unfollow($user->id);
            return back()->withSuccess("Вы отписались от новостей пользователя {$user->name}");
        }
        return back()->withError("Вы не подписаны на {$user->name}");
    }

}
