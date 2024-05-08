<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(PostService::class, function ($app) {
            return new PostService();
        });
    }

    public function boot(): void
    {
        //
    }
}
