<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2019/12/11
 * Time: 下午 06:21
 */

namespace App\Model;

use App\Model\Support\BaseORM;

class Role extends BaseORM
{
    protected $table = 'role';
    protected $fillable = [
        'display_name',
        'code',
        'public',
        'enable'
    ];
}
