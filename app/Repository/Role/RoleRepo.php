<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2019/12/11
 * Time: 下午 07:08
 */

namespace App\Repository\Role;

use App\Constants\NYConstants;
use App\Contracts\Role\IRoleProvider;
use App\Model\Role;
use App\Util\LaravelLoggerUtil;
use Illuminate\Database\Eloquent\Collection;

class RoleRepo implements IRoleProvider
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

    /**
     * @return Role[]|Collection
     */
    public function get()
    {
        $result = collect();
        try {
            $result = Role::where('enable', NYConstants::YES)
                ->where('public', NYConstants::YES)
                ->first();
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param string $code
     * @return Role|null
     */
    public function firstByCode(string $code)
    {
        $result = null;
        try {
            $result = Role::where('code', $code)->first();
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }
}
