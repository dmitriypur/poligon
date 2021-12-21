<?php


namespace App\Observers;


use App\Models\Post;
use App\Notifications\NewPost;

class PostObserver
{
    public function created(Post $post)
    {
        $user = $post->user;
        foreach ($user->followers as $follower) {
            $follower->notify(new NewPost($user, $post));
        }
    }
}
