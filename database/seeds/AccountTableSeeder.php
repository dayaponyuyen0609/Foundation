<?php

use Illuminate\Database\Seeder;

class AccountTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        \DB::table('account')->insert([
            'account'      => 'admin',
            'uuid'         => \Ramsey\Uuid\Uuid::uuid4()->toString(),
            'password'     => Hash::make('adminis666'),
            'display_name' => '最高權限者',
            'mail'         => 'admin@house.cc',
            'phone'        => '3939889',
            'status'       => 'enable'
        ]);
    }
}
