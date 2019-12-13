<?php

namespace App\Providers;

use App\Access\NodeAccessor;
use App\Contracts\Node\IGate;
use Illuminate\Support\ServiceProvider;

class AccountProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(IGate::class, function () {
            return new NodeAccessor($this->app->make('auth')->guard()->user());
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
