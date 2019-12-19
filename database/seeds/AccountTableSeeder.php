<?php

use App\Service\Account\AdminAccountService;
use Illuminate\Database\Seeder;

class AccountTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     * @throws Throwable
     */
    public function run()
    {
        app(AdminAccountService::class)->create();
    }
}
