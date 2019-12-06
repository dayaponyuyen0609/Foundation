<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Client;

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
        // 產生時id替換成字串亂碼(原本為流水號)
        Client::creating(function (Client $client) {
            $client->incrementing = false;
            /** @noinspection PhpUndefinedFieldInspection */
            $client->id = \Ramsey\Uuid\Uuid::uuid4()->toString();
        });
        // 搜尋時取消incrementing,防止資料轉換成數字
        Client::retrieved(function (Client $client) {
            $client->incrementing = false;
        });
    }
}
