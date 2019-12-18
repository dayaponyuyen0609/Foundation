<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2019/12/17
 * Time: 下午 02:23
 */

namespace App\Repository\Node;

use App\Model\Node;
use App\Util\LaravelLoggerUtil;

class NodeRepo
{
    /**
     * @param array $attribute
     * @return Node|null
     */
    public function create(array $attribute)
    {
        $result = null;
        try {
            $node = new Node();
            $result = $node->create($attribute);
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }
}
