<?php

namespace App\Policies;

use App\Constants\Node\NodeCodeConstants;
use App\Contracts\Node\IGate;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;
    /** @var IGate $gate */
    private $gate;

    /**
     * Create a new policy instance.
     *
     * @param IGate $gate
     */
    public function __construct(IGate $gate)
    {
        $this->gate = $gate;
    }

    /**
     * @return bool
     */
    public function manage()
    {
        return $this->gate->hasAccess(NodeCodeConstants::ROLE_MANAGE);
    }
}
