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
use App\Model\Node;
use App\Model\Role;
use App\Util\LaravelLoggerUtil;
use Illuminate\Database\Eloquent\Collection;

class RoleRepo implements IRoleProvider
{
    /**
     * @param string|null $enable
     * @param int $page
     * @param int $perpage
     * @return Role[]|Collection
     */
    public function get(
        string $enable = null,
        int $page = 1,
        int $perpage = 20
    ) {
        try {
            $query = Role::query()->where('public', NYConstants::YES);
            if (!is_null($enable)) {
                $query->where('enable', $enable);
            }
            $result = $query->forPage($page, $perpage)->orderByDesc('created_at')->get();
        } catch (\Throwable $e) {
            $result = collect();
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param array $attribute
     * @return Role|null
     */
    public function create(array $attribute)
    {
        $result = null;
        try {
            $role = new Role();
            $result = $role->create($attribute);
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param int $id
     * @param array $attribute
     * @return int
     */
    public function update(int $id, array $attribute)
    {
        try {
            $result = Role::where('id', $id)->update($attribute);
        } catch (\Throwable $e) {
            $result = 0;
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param int $id
     * @return int
     */
    public function delete(int $id)
    {
        try {
            $result = Role::where('id', $id)->delete();
        } catch (\Throwable $e) {
            $result = 0;
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @param Role $role
     * @param Node $node
     * @return array
     */
    public function bindNode(Role $role, Node $node)
    {
        $result = [];
        try {
            $result = $role->nodes()->syncWithoutDetaching($node);
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @return Role[]|Collection
     */
    public function all()
    {
        $result = collect();
        try {
            $result = Role::where('enable', NYConstants::YES)
                ->where('public', NYConstants::YES)
                ->get();
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
