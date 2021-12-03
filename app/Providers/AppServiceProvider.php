<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
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
            'admin.index'
        ], function ($view) {
            $view->with('categoriesCount', Category::all()->count());
            $view->with('tagsCount', Tag::all()->count());
            $view->with('postsCount', Post::all()->count());
        });
    }
}
