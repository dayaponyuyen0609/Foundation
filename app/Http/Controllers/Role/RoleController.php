<?php

namespace App\Http\Controllers\Role;

use App\Http\RequestHandle\Role\DeleteRequestHandle;
use App\Http\RequestHandle\Role\ListRequestHandle;
use App\Http\RequestHandle\Role\StoreRequestHandle;
use App\Http\RequestHandle\Role\UpdateRequestHandle;
use App\Service\Role\RoleService;
use Illuminate\Routing\Controller;

/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2019/12/6
 * Time: 下午 08:52
 */
class RoleController extends Controller
{
    /**
     * @param ListRequestHandle $request
     * @return array
     */
    public function index(ListRequestHandle $request)
    {
        return app(RoleService::class)->list($request)->all();
    }

    /**
     * @param StoreRequestHandle $request
     * @return \App\Model\Role|null
     */
    public function store(StoreRequestHandle $request)
    {
        return app(RoleService::class)->store($request);
    }

    /**
     * @param UpdateRequestHandle $request
     * @return int
     */
    public function update(UpdateRequestHandle $request)
    {
        return app(RoleService::class)->update($request);
    }

    /**
     * @param DeleteRequestHandle $request
     * @return int
     */
    public function delete(DeleteRequestHandle $request)
    {
        return app(RoleService::class)->delete($request);
    }
}
