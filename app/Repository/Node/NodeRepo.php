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
use Illuminate\Database\Eloquent\Model;

class NodeRepo
{
    /**
     * @param array $attribute
     * @return Node|Model|null
     */
    public function create(array $attribute)
    {
        $result = null;
        try {
            $result = Node::query()->create($attribute);
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }
}
