<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2019/12/12
 * Time: 下午 05:20
 */

namespace App\Repository\Account;

use App\Model\Account;
use App\Util\LaravelLoggerUtil;

class AccountRepo
{
    /**
     * @param array $attribute
     * @return Account|null
     */
    public function create(array $attribute)
    {
        $result = null;
        try {
            $role = new Account();
            $result = $role->create($attribute);
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }
}
