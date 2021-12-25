<?php


namespace App\Observers;


use App\Models\Category;
use App\Models\Post;
use App\Notifications\ChannelPost;

class ChannelObserver
{
    public function created(Post $post)
    {
        $category = $post->category;
        foreach ($category->followers as $follower) {
            $follower->notify(new ChannelPost($category, $post));
        }

    }
}
