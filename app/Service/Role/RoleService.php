<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2019/12/11
 * Time: 下午 07:06
 */

namespace App\Service\Role;

use App\Constants\NYConstants;
use App\Repository\Role\RoleRepo;

class RoleService
{
    /** @var RoleRepo $repo */
    private $repo;

    /**
     * AdminRoleService constructor.
     */
    public function __construct()
    {
        $this->repo = new RoleRepo();
    }

    /**
     * @param string $displayName
     * @param string $code
     * @param string $public
     * @param string $enable
     * @return bool
     */
    public function add(
        string $displayName,
        string $code,
        string $public = NYConstants::YES,
        string $enable = NYConstants::YES
    ) {
        $attribute = [
            'display_name' => $displayName,
            'code'         => $code,
            'public'       => $public,
            'enable'       => $enable
        ];

        return $this->repo->save($attribute);
    }
}
