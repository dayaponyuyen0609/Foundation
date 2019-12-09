<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2019/12/9
 * Time: 下午 02:09
 */

namespace App\Constants;

class NYConstants extends BaseConstants
{
    const YES = 'Y';
    const NO = 'N';

    /**
     * @return array
     */
    public static function enum(): array
    {
        return [
            self::YES,
            self::NO
        ];
    }
}
