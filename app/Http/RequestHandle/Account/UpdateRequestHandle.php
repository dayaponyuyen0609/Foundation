<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2019/12/30
 * Time: 下午 03:07
 */

namespace App\Http\RequestHandle\Account;

use App\Constants\Account\AccountStatusConstants;
use App\Http\RequestHandle\BaseFormRequest;
use Illuminate\Validation\Rule;

class UpdateRequestHandle extends BaseFormRequest
{
    /**
     * @return int
     */
    public function getUuId()
    {
        return $this->get('uuid');
    }

    /**
     * @return string
     */
    public function getAccount()
    {
        return $this->get('account');
    }

    /**
     * @return string|null
     */
    public function getPassword()
    {
        return $this->get('password');
    }

    /**
     * @return string
     */
    public function getDisplayName()
    {
        return $this->get('display_name');
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->get('status');
    }

    /**
     * @return string|null
     */
    public function getMail()
    {
        return $this->get('mail');
    }

    /**
     * @return string|null
     */
    public function getPhone()
    {
        return $this->get('phone');
    }

    /**
     * @return string|null
     */
    public function getRemark()
    {
        return $this->get('remark');
    }

    /**
     * @return array
     */
    public function getRoleIds()
    {
        return $this->get('role_ids', []);
    }

    /**
     * Request args validate rules.
     * @link https://laravel.com/docs/master/validation lookup link and know how to write rule.
     * @return array
     * @see https://laravel.com/docs/master/validation#available-validation-rules
     * checkout this to get more rule keyword info
     */
    public function rules()
    {
        return [
            'uuid'         => 'required|string',
            'account'      => 'required|string|max:32',
            'display_name' => 'required|string|max:50',
            'password'     => 'sometimes|required|string|max:50',
            'status'       => 'required|string|' . Rule::in(AccountStatusConstants::enum()),
            'mail'         => 'sometimes|required|string|max:255',
            'phone'        => 'sometimes|required|string|max:50',
            'remark'       => 'sometimes|required|string',
            'role_ids'     => 'sometimes|required|array',
            'role_ids.*'   => 'sometimes|required|integer',
        ];
    }
}
