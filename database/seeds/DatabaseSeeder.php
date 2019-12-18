<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //default seed
        $this->call(RoleTableSeeder::class);
        $this->call(AccountTableSeeder::class);
        $this->call(PassportSeeder::class);
        //role function seed
        $this->call(RoleNodeSeeder::class);
    }
}
