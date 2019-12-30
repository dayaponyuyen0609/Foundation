<?php

namespace App\Providers;

use App\Access\NodeAccessor;
use App\Contracts\Node\IGate;
use App\Contracts\Role\IRoleProvider;
use App\Repository\Role\RoleRepo;
use App\Service\Account\AdminAccountService;
use App\Service\Account\ManageAccountService;
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
        $this->app->when(AdminAccountService::class)->needs(IRoleProvider::class)->give(RoleRepo::class);
        $this->app->when(ManageAccountService::class)->needs(IRoleProvider::class)->give(RoleRepo::class);
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
