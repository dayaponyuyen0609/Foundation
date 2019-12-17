<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2019/12/17
 * Time: 下午 12:30
 */

namespace App\Http\RequestHandle\Role;

use App\Http\RequestHandle\BaseFormRequest;
use Illuminate\Validation\Rule;

class DeleteRequestHandle extends BaseFormRequest
{
    /**
     * @return int
     */
    public function getId()
    {
        return $this->get('id');
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
            'id' => 'required|integer|' . Rule::exists('role'),
        ];
    }
}
