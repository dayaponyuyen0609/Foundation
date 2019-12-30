<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2019/12/11
 * Time: 下午 07:06
 */

namespace App\Service\Role;

use App\Constants\NYConstants;
use App\Http\RequestHandle\Role\DeleteRequestHandle;
use App\Http\RequestHandle\Role\ListRequestHandle;
use App\Http\RequestHandle\Role\UpdateRequestHandle;
use App\Model\Node;
use App\Model\Role;
use App\Repository\Role\RoleRepo;
use XC\Independent\Kit\Support\Traits\Pattern\Singleton;

class RoleService
{
    use Singleton;
    /** @var RoleRepo $repo */
    private $repo;

    /**
     * Initialize class.
     */
    protected function init()
    {
        $this->repo = $this->repo ?: new RoleRepo();
    }

    /**
     * @param ListRequestHandle $request
     * @return Role[]|\Illuminate\Database\Eloquent\Collection
     */
    public function list(ListRequestHandle $request)
    {
        return $this->repo->get(
            $request->getEnable(),
            $request->getPage(),
            $request->getPerpage()
        );
    }

    /**
     * @param string $displayName
     * @param string $code
     * @param string $public
     * @param string $enable
     * @return Role|null
     */
    public function add(
        string $displayName,
        string $code,
        string $public = NYConstants::YES,
        string $enable = NYConstants::YES
    ) {
        $attribute = [
            'display_name' => $displayName,
            'code'         => $code,
            'public'       => $public,
            'enable'       => $enable
        ];

        return $this->repo->create($attribute);
    }

    /**
     * @param UpdateRequestHandle $request
     * @return int
     */
    public function update(UpdateRequestHandle $request)
    {
        $attribute = [
            'display_name' => $request->getDisplayName(),
            'code'         => $request->getCode(),
            'enable'       => $request->getEnable()
        ];

        return $this->repo->update($request->getId(), $attribute);
    }

    /**
     * @param DeleteRequestHandle $request
     * @return int
     */
    public function delete(DeleteRequestHandle $request)
    {
        return $this->repo->delete($request->getId());
    }

    /**
     * @param string $code
     * @param Node $node
     * @return Role|null
     */
    public function bindNode(string $code, Node $node)
    {
        $role = $this->repo->firstByCode($code);
        if (!is_null($role)) {
            $this->repo->bindNode($role, $node);
        }

        return $role;
    }
}
