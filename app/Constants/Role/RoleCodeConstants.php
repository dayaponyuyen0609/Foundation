<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2019/12/12
 * Time: 上午 11:44
 */

namespace App\Constants\Role;

use App\Constants\BaseConstants;

class RoleCodeConstants extends BaseConstants
{
    //超級管理員
    const ADMIN = 'ADMIN';
    // 系統管理員
    const SYSTEM_MANAGER = 'SYSTEM_MG';
    //代理
    const AGENT = 'AGENT';
    // 會員
    const MEMBER = 'MEMBER';

    /**
     * @return array
     */
    public static function enum(): array
    {
        return [
            self::ADMIN,
            self::SYSTEM_MANAGER,
            self::AGENT,
            self::MEMBER
        ];
    }
}
