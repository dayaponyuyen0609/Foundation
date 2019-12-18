<?php

use App\Constants\Node\NodeCodeConstants;
use App\Constants\Role\RoleCodeConstants;
use App\Service\Node\NodeService;
use App\Service\Role\RoleService;
use Illuminate\Database\Seeder;

class RoleNodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nodeService = new NodeService();
        $roleService = new RoleService();
        $node = $nodeService->add('角色管理', NodeCodeConstants::ROLE_MANAGE);
        if (!is_null($node)) {
            $roleService->bindNode(RoleCodeConstants::ADMIN, $node);
            $roleService->bindNode(RoleCodeConstants::SYSTEM_MANAGER, $node);
        }
    }
}
