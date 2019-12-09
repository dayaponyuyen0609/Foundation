<?php

use App\Model\Account;
use Illuminate\Database\Seeder;
use Laravel\Passport\ClientRepository;

class PassportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param ClientRepository $clients
     * @return void
     */
    public function run(ClientRepository $clients)
    {
        // password client
        $clients->createPasswordGrantClient(null, 'password client', 'http://localhost');
        /** @var Account $admin */
        $admin = Account::where('account', 'admin')->first();
        // admin client(personal)
        $clients->createPersonalAccessClient($admin->getKey(), 'admin client', 'http://localhost');
        $token = $admin->createToken('admin client');
        var_export(['admin access token' => $token->accessToken]);
    }
}
