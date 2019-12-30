<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2019/12/30
 * Time: 下午 04:38
 */

namespace App\Http\RequestHandle\Account;

use App\Http\RequestHandle\BaseFormRequest;

class DeleteRequestHandle extends BaseFormRequest
{
    /**
     * @return int
     */
    public function getUuId()
    {
        return $this->get('uuid');
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
            'uuid' => 'required|string',
        ];
    }
}
