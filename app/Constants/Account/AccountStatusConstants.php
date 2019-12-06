<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2019/12/5
 * Time: 上午 11:33
 */

namespace App\Constants\Account;

use App\Constants\BaseConstants;

class AccountStatusConstants extends BaseConstants
{
    //啟用中
    const ENABLE = 'enable';
    //停用
    const DISABLE = 'disable';
    //凍結
    const FREEZE = 'freeze';
    //清查
    const CHECK = 'check';

    /**
     * @return array
     */
    public static function enum(): array
    {
        return [
            self::ENABLE,
            self::DISABLE,
            self::FREEZE,
            self::CHECK
        ];
    }
}
