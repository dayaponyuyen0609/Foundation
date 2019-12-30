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
use App\Http\RequestHandle\Account\DeleteRequestHandle;
use App\Http\RequestHandle\Account\ListRequestHandle;
use App\Http\RequestHandle\Account\StoreRequestHandle;
use App\Http\RequestHandle\Account\UpdateRequestHandle;
use App\Model\Account;
use App\Repository\Account\AccountRepo;
use Hash;

class ManageAccountService
{
    /** @var IRoleProvider $roleProvider */
    private $roleProvider;
    /** @var AccountRepo $repo */
    private $repo;

    /**
     * ProfileAccountService constructor.
     * @param IRoleProvider $roleProvider
     */
    public function __construct(IRoleProvider $roleProvider)
    {
        $this->roleProvider = $roleProvider;
        $this->repo = new AccountRepo();
    }

    /**
     * @param ListRequestHandle $request
     * @return \App\Model\Account[]|\Illuminate\Support\Collection
     */
    public function list(ListRequestHandle $request)
    {
        return $this->repo->list(
            $request->getAccount(),
            $request->getDisplayName(),
            $request->getStatus(),
            $request->getPage(),
            $request->getPerpage()
        );
    }

    /**
     * @param StoreRequestHandle $request
     * @return \App\Model\Account|null
     * @throws \Throwable
     */
    public function store(StoreRequestHandle $request)
    {
        $account = null;
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
        \DB::transaction(function () use ($attribute, &$account, $request) {
            $account = $this->repo->create($attribute);
            if (is_null($account)) {
                throw new ApiErrorCodeException(AccountErrorCodeConstants::CREATE_FAIL);
            }
            $this->attachRole($account, $request->getRoleIds());
        });

        return $account;
    }

    /**
     * @param UpdateRequestHandle $request
     * @return \App\Model\Account|null
     * @throws ApiErrorCodeException
     * @throws \Throwable
     */
    public function update(UpdateRequestHandle $request)
    {
        $account = $this->repo->firstByUuId($request->getUuId());
        if (is_null($account)) {
            throw new ApiErrorCodeException(AccountErrorCodeConstants::ACCOUNT_NOT_FOUND);
        }
        $attribute = [
            'account'      => $request->getAccount(),
            'display_name' => $request->getDisplayName(),
            'mail'         => $request->getMail(),
            'phone'        => $request->getPhone(),
            'status'       => $request->getStatus(),
            'remark'       => $request->getRemark(),
        ];
        if (!is_null($request->getPassword())) {
            $attribute['password'] = Hash::make($request->getPassword());
        }
        \DB::transaction(function () use (&$account, $attribute, $request) {
            $account->update($attribute);
            if (!empty($request->getRoleIds())) {
                $this->attachRole($account, $request->getRoleIds());
            }
        });

        return $account;
    }

    /**
     * @param DeleteRequestHandle $request
     * @return int
     */
    function delete(DeleteRequestHandle $request)
    {
        return $this->repo->delete($request->getUuId());
    }

    /**
     * @param Account $account
     * @param array $roleIds
     * @return Account
     */
    private function attachRole(Account $account, array $roleIds)
    {
        $roles = $this->roleProvider->firstByIds($roleIds);
        $account->roles()->sync($roles);

        return $account->setRelation('role', $roles);
    }
}
