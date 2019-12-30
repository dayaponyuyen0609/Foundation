<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2019/12/18
 * Time: 下午 04:20
 */

namespace App\Http\Controllers\Account;

use App\Http\RequestHandle\Account\DeleteRequestHandle;
use App\Http\RequestHandle\Account\ListRequestHandle;
use App\Http\RequestHandle\Account\StoreRequestHandle;
use App\Http\RequestHandle\Account\UpdateRequestHandle;
use App\Service\Account\ManageAccountService;
use Illuminate\Routing\Controller;

class AccountController extends Controller
{
    /**
     * @param ListRequestHandle $request
     * @return array
     */
    public function index(ListRequestHandle $request)
    {
        return app(ManageAccountService::class)->list($request)->toArray();
    }

    /**
     * @param StoreRequestHandle $request
     * @return \App\Model\Account|null
     * @throws \App\Exceptions\ApiErrorCodeException
     * @throws \Throwable
     */
    public function store(StoreRequestHandle $request)
    {
        return app(ManageAccountService::class)->store($request);
    }

    /**
     * @param UpdateRequestHandle $request
     * @return \App\Model\Account|null
     * @throws \App\Exceptions\ApiErrorCodeException
     * @throws \Throwable
     */
    public function update(UpdateRequestHandle $request)
    {
        return app(ManageAccountService::class)->update($request);
    }

    /**
     * @param DeleteRequestHandle $request
     * @return int
     */
    public function delete(DeleteRequestHandle $request)
    {
        return app(ManageAccountService::class)->delete($request);
    }
}
