<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2019/12/13
 * Time: 下午 03:18
 */

namespace App\Contracts\Node;

interface IGate
{
    /**
     * @param string $code
     * @return bool
     * @see NodePathConstants
     */
    public function hasAccess(string $code);

    /**
     * @param array $code
     * @return bool
     */
    public function anyAccess(array $code);
}
