<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2019/12/18
 * Time: 下午 04:20
 */

namespace App\Http\Controllers\Account;

use App\Http\RequestHandle\Account\StoreRequestHandle;
use App\Repository\Role\RoleRepo;
use App\Service\Account\AccountService;
use Illuminate\Routing\Controller;

class AccountController extends Controller
{
    public function index()
    {
    }

    /**
     * @param StoreRequestHandle $request
     * @return \App\Model\Account|null
     * @throws \App\Exceptions\ApiErrorCodeException
     */
    public function store(StoreRequestHandle $request)
    {
        $service = new AccountService(new RoleRepo());

        return $service->store($request);
    }
}
