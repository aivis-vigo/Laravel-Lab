<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use App\Models\Post;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->registerPostPolicy();
    }

    /**
     * Bootstrap any application services.
     */
    public function registerPostPolicy(): void
    {
        Gate::define('update-post', function ($user, Post $post) {
            return $user->id === $post->author_id;
        });
    }
}
