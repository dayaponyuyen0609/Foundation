<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2019/12/6
 * Time: 下午 05:54
 */

namespace App\Http\RequestHandle\Passport;

use App\Http\RequestHandle\BaseFormRequest;

class PersonalTokenRequest extends BaseFormRequest
{
    /**
     * @return string
     */
    public function getName()
    {
        return $this->get('name');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            'name' => 'required|string|between:1,200'
        ];
    }

    /**
     * @inheritdoc
     */
    public function messages()
    {
        return [
        ];
    }
}
