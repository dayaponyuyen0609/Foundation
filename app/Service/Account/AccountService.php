<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2019/12/18
 * Time: 下午 04:36
 */

namespace App\Service\Account;

use App\Constants\Account\AccountErrorCodeConstants;
use App\Contracts\Role\IRoleProvider;
use App\Exceptions\ApiErrorCodeException;
use App\Http\RequestHandle\Account\StoreRequestHandle;
use App\Repository\Account\AccountRepo;
use Hash;

class AccountService
{
    /** @var IRoleProvider $roleProvider */
    private $roleProvider;

    /**
     * AccountService constructor.
     * @param IRoleProvider $roleProvider
     */
    public function __construct(IRoleProvider $roleProvider)
    {
        $this->roleProvider = $roleProvider;
    }

    /**
     * @param StoreRequestHandle $request
     * @return \App\Model\Account|null
     * @throws ApiErrorCodeException
     * @throws \Exception
     */
    public function store(StoreRequestHandle $request)
    {
        $repo = new AccountRepo();
        $attribute = [
            'account'      => $request->getAccount(),
            'uuid'         => \Ramsey\Uuid\Uuid::uuid4()->toString(),
            'password'     => Hash::make($request->getPassword()),
            'display_name' => $request->getDisplayName(),
            'mail'         => $request->getMail(),
            'phone'        => $request->getPhone(),
            'status'       => $request->getStatus(),
            'remark'       => $request->getRemark(),
        ];
        $account = $repo->create($attribute);
        if (is_null($account)) {
            throw new ApiErrorCodeException(AccountErrorCodeConstants::CREATE_FAIL);
        }
        $roles = $this->roleProvider->firstByIds($request->getRoleIds());
        $account->roles()->sync($roles);

        return $account->setRelation('role', $roles);
    }
}
