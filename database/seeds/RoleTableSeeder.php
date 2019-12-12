<?php

use App\Constants\NYConstants;
use App\Constants\Role\RoleCodeConstants;
use App\Service\Role\RoleService;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $service = new RoleService();
        $service->add('超級管理員', RoleCodeConstants::ADMIN, NYConstants::NO);
        $service->add('系統管理員', RoleCodeConstants::SYSTEM_MANAGER);
        $service->add('代理', RoleCodeConstants::AGENT);
        $service->add('會員', RoleCodeConstants::MEMBER);
    }
}
