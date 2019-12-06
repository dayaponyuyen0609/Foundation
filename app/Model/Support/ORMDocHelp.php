<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2019/12/5
 * Time: 下午 04:11
 */

namespace App\Model\Support;

use Closure;
use Illuminate\Database\Eloquent\Builder as ORMBuilder;

/**
 * Trait ORMDocHelp
 * @package Modules\Base\Support\Traits
 * @method static null|$this find($id)
 * @method static null|$this first($columns = ['*'])
 * @method static ORMBuilder where($column, $operator = null, $value = null, $boolean = 'and')
 * @method static ORMBuilder whereIn($column, $value = null, $boolean = 'and', $not = false)
 * @method static ORMBuilder whereHas($relation, Closure $callback = null, $operator = '>=', $count = 1)
 * @method static ORMBuilder with($relations)
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
trait ORMDocHelp
{
}
