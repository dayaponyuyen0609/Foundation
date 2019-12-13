<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2019/12/12
 * Time: 下午 05:03
 */

namespace App\Service\Account;

use App\Constants\Role\RoleCodeConstants;
use App\Contracts\Role\IRoleProvider;
use App\Repository\Account\AccountRepo;
use Hash;

class AdminAccountService
{
    /** @var \App\Contracts\Role\IRoleProvider $roleProvider */
    private $roleProvider;

    /**
     * AdminAccountService constructor.
     * @param \App\Contracts\Role\IRoleProvider $roleProvider
     */
    public function __construct(IRoleProvider $roleProvider)
    {
        $this->roleProvider = $roleProvider;
    }

    /**
     * @throws \Exception
     * @throws \Throwable
     */
    public function create()
    {
        $admin = null;
        $role = $this->roleProvider->firstByCode(RoleCodeConstants::ADMIN);
        $repo = new AccountRepo();
        $attribute = [
            'account'      => 'admin',
            'uuid'         => \Ramsey\Uuid\Uuid::uuid4()->toString(),
            'password'     => Hash::make('adminis666'),
            'display_name' => '最高權限者',
            'mail'         => 'admin@house.cc',
            'phone'        => '0806449',
            'status'       => 'enable'
        ];
        \DB::transaction(function () use (&$admin, $attribute, $repo, $role) {
            $admin = $repo->create($attribute);
            if (!is_null($admin)) {
                $admin->roles()->sync($role);
            }
        });

        return $admin;
    }
}
