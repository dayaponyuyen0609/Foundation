<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2019/12/17
 * Time: 下午 06:08
 */

namespace App\Identify;

use App\Constants\Account\AccountStatusConstants;
use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Database\Eloquent\Model;

class Identity extends EloquentUserProvider
{
    /**
     * Retrieve a user by their unique identifier.
     *
     * @param  mixed $identifier
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveById($identifier)
    {
        /** @var Model|\Illuminate\Contracts\Auth\Authenticatable $model */
        $model = $this->createModel();

        return $model->newQuery()
            ->where($model->getAuthIdentifierName(), $identifier)
            ->where('status', AccountStatusConstants::ENABLE)
            ->first();
    }
}
