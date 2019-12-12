<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2019/12/11
 * Time: 下午 07:08
 */

namespace App\Repository\Role;

use App\Model\Role;
use App\Util\LaravelLoggerUtil;

class RoleRepo
{
    /**
     * @param array $attribute
     * @return bool
     */
    public function save(array $attribute)
    {
        $result = false;
        try {
            $role = new Role();
            $result = $role->fill($attribute)->save();
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }
}
