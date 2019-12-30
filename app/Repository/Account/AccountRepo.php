<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2019/12/12
 * Time: 下午 05:20
 */

namespace App\Repository\Account;

use App\Constants\NYConstants;
use App\Model\Account;
use App\Util\LaravelLoggerUtil;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class AccountRepo
{
    /**
     * @param string $uuid
     * @return Account|null
     */
    public function firstByUuId(string $uuid)
    {
        try {
            $result = Account::whereHas('roles', function (Builder $query) {
                $query->where('public', NYConstants::YES);
            })->where('uuid', $uuid)->first();
        } catch (\Throwable $e) {
            $result = null;
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param string|null $account
     * @param string|null $displayName
     * @param string|null $status
     * @param int $page
     * @param int $perpage
     * @return Account[]|Collection
     */
    public function list(
        string $account = null,
        string $displayName = null,
        string $status = null,
        int $page = 1,
        int $perpage = 20
    ) {
        try {
            $query = Account::whereHas('roles', function (Builder $query) {
                $query->where('public', NYConstants::YES);
            });
            if (!is_null($account)) {
                $query->where('account', 'like', '%' . $account . '%');
            }
            if (!is_null($displayName)) {
                $query->where('display_name', 'like', '%' . $displayName . '%');
            }
            if (!is_null($status)) {
                $query->where('status', $status);
            }
            $result = $query->orderByDesc('id')->forPage($page, $perpage)->get();
        } catch (\Throwable $e) {
            $result = collect();
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param array $attribute
     * @return Account|null
     */
    public function create(array $attribute)
    {
        $result = null;
        try {
            $account = new Account();
            $result = $account->create($attribute);
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param string $uuid
     * @return int
     */
    public function delete(string $uuid)
    {
        try {
            $result = Account::whereHas('roles', function (Builder $query) {
                $query->where('public', NYConstants::YES);
            })->where('uuid', $uuid)->delete();
        } catch (\Throwable $e) {
            $result = null;
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }
}
