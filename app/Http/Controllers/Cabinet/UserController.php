<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\User;
use App\Notifications\ChannelPost;
use App\Notifications\UserFollowed;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
//        $users = User::where('id', '!=', auth()->user()->id)->get();
        $users = auth()->user()->follows;
        $categories = auth()->user()->subscriptionCategories;

        return view('cabinet.subscriptions', compact('users', 'categories'));
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

    public function subscribe(Category $category, User $user)
    {
        $follower = auth()->user();

        if(!$follower->isSubscriptionCat($category->id)) {
            $follower->subscriptionCat($category->id);

            return back()->withSuccess("Вы подписались на новости канала {$category->title}");
        }
        return back()->withError("Вы уже подписаны на канал {$category->title}");
    }

    public function unsubscribe(Category $category)
    {
        $follower = auth()->user();
        if($follower->isSubscriptionCat($category->id)) {
            $follower->unsubscribeCat($category->id);
            return back()->withSuccess("Вы отписались от новостей канала {$category->title}");
        }
        return back()->withError("Вы не подписаны на канал {$category->title}");
    }

}
