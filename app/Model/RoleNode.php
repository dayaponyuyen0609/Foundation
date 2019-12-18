<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2019/12/13
 * Time: 下午 04:23
 */

namespace App\Model;

use Illuminate\Database\Eloquent\Relations\Pivot;

class RoleNode extends Pivot
{
    protected $table = 'role_node';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function roles()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function nodes()
    {
        return $this->belongsTo(Node::class, 'node_id');
    }
}
