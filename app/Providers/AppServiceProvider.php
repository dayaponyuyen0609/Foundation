<?php

namespace App\Providers;

use App\Contracts\Role\IRoleProvider;
use App\Identify\Identity;
use App\Repository\Role\RoleRepo;
use App\Service\Account\AdminAccountService;
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
        \Auth::provider('identity', function ($app, $config) {
            return new Identity($app['hash'], $config['model']);
        });
        $this->app->when(AdminAccountService::class)->needs(IRoleProvider::class)->give(RoleRepo::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
