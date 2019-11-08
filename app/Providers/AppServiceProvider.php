<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Resources\Json\Resource;

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
        \App\Models\User::observe(\App\Observers\UserObserver::class);
        \App\Models\Reply::observe(\App\Observers\ReplyObserver::class);
        \App\Models\Topic::observe(\App\Observers\TopicObserver::class);
        View::share('categorys', Category::all());
        View::share("active_users", (new User)->getActiveUsers());
        Resource::withoutWrapping();
    }
}
