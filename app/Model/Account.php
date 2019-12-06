<?php

namespace App\Model;

use App\Constants\Account\AccountStatusConstants;
use App\Model\Support\ORMDocHelp;
use App\Model\Support\ORMForeignKeyHelp;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User;
use Laravel\Passport\HasApiTokens;

/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2019/12/5
 * Time: 下午 05:41
 * @property string account
 */
class Account extends User
{
    use HasApiTokens, SoftDeletes, ORMDocHelp, ORMForeignKeyHelp;
    protected $table = 'account';
    protected $softDelete = true;
    protected $fillable = [
        'account',
        'uuid',
        'display_name',
        'status',
        'mail',
        'phone',
        'login_ip',
        'remark'
    ];
    protected $casts = ['remark' => 'json'];
    protected $hidden = [
        'password',
        'remember_token'
    ];

    /**
     * Used by passport issue token.
     * @param string $account
     * @return $this|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|null.
     */
    public function findForPassport(string $account)
    {
        return self::where('account', $account)
            ->where('status', AccountStatusConstants::ENABLE)
            ->first();
    }
}
