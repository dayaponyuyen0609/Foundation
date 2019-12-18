<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2019/12/12
 * Time: 下午 06:28
 */

namespace App\Contracts\Role;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface IRoleProvider
{
    /**
     * @return Model[]|Collection
     */
    public function all();

    /**
     * @param string $code
     * @return Model|null
     */
    public function firstByCode(string $code);

    /**
     * @param array $ids
     * @return Collection
     */
    public function firstByIds(array $ids);
}
