<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2019/12/16
 * Time: 下午 04:10
 */

namespace App\Http\RequestHandle\Role;

use App\Constants\NYConstants;
use App\Http\RequestHandle\BaseFormRequest;
use Illuminate\Validation\Rule;

class StoreRequestHandle extends BaseFormRequest
{
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
    public function getCode()
    {
        return strtoupper($this->get('code'));
    }

    /**
     * @return string
     */
    public function getEnable()
    {
        return $this->get('enable', NYConstants::YES);
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
            'display_name' => 'required|string|max:16',
            'code'         => 'required|string|max:20|' . Rule::unique('role'),
            'enable'       => 'required|string|' . Rule::in(NYConstants::enum())
        ];
    }
}
