<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2019/12/30
 * Time: 下午 02:17
 */

namespace App\Http\RequestHandle\Account;

use App\Constants\Account\AccountStatusConstants;
use App\Http\RequestHandle\BaseFormRequest;
use Illuminate\Validation\Rule;

class ListRequestHandle extends BaseFormRequest
{
    /**
     * @return string|null
     */
    public function getAccount()
    {
        return $this->get('account');
    }

    /**
     * @return string|null
     */
    public function getDisplayName()
    {
        return $this->get('display_name');
    }

    /**
     * @return string|null
     */
    public function getStatus()
    {
        return $this->get('status');
    }

    /**
     * @return int
     */
    public function getPage()
    {
        return $this->get('page', 1);
    }

    /**
     * @return int
     */
    public function getPerpage()
    {
        return $this->get('perpage', 20);
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
            'account'      => 'sometimes|required|string',
            'display_name' => 'sometimes|required|string',
            'status'       => 'sometimes|required|string|' . Rule::in(AccountStatusConstants::enum()),
            'page'         => 'sometimes|required|integer|min:1',
            'perpage'      => 'sometimes|required|integer|between:1,100',
        ];
    }
}
