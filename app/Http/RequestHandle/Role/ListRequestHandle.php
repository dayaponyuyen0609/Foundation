<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2019/12/16
 * Time: 下午 02:15
 */

namespace App\Http\RequestHandle\Role;

use App\Constants\NYConstants;
use App\Http\RequestHandle\BaseFormRequest;
use Illuminate\Validation\Rule;

class ListRequestHandle extends BaseFormRequest
{
    /**
     * @return string|null
     */
    public function getEnable()
    {
        return $this->get('enable', null);
    }

    /**
     * @return int|null
     */
    public function getPage()
    {
        return $this->get('page', 1);
    }

    /**
     * @return int|null
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
            'enable'  => 'sometimes|required|string|' . Rule::in(NYConstants::enum()),
            'page'    => 'sometimes|required|integer|min:1',
            'perpage' => 'sometimes|required|integer|between:1,100',
        ];
    }
}
