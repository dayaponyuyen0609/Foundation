<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2019/12/5
 * Time: 下午 04:15
 */

namespace App\Model\Support;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ORMForeignKeyHelp
 * @package App\Model\Support
 * @mixin Model
 */
trait ORMForeignKeyHelp
{
    private static $FOREIGN = null;

    public function getForeignKey()
    {
        return static::$FOREIGN ?? parent::getForeignKey();
    }
}
