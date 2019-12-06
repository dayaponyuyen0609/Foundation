<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2019/12/5
 * Time: 下午 04:09
 */

namespace App\Model\Support;

use Illuminate\Database\Eloquent\Model;

abstract class BaseORM extends Model
{
    use ORMDocHelp, ORMForeignKeyHelp;
}
