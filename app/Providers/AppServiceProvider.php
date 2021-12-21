<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use App\Observers\PostObserver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer([
            'admin.parts.sidebar',
            'admin.index',
        ], function ($view) {
            $view->with('categoriesCount', Category::all()->count());
            $view->with('tagsCount', Tag::all()->count());
            $view->with('postsCount', Post::all()->count());
            $view->with('usersCount', User::all()->count());
        });

        view()->composer([
            'parts.sidebar',
        ], function ($view) {
            $view->with('categories', Category::withCount('posts')->limit(5)->get());
            $view->with('tags', Tag::all());
        });

        Post::observe(PostObserver::class);
    }
}
