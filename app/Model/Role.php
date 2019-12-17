<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2019/12/11
 * Time: 下午 06:21
 */

namespace App\Model;

use App\Model\Support\BaseORM;

class Role extends BaseORM
{
    protected $table = 'role';
    protected $fillable = [
        'display_name',
        'code',
        'public',
        'enable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function accounts()
    {
        return $this->belongsToMany(Account::class, 'account_role', 'role_id', 'account_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function nodes()
    {
        return $this->belongsToMany(Node::class, 'role_node', 'role_id', 'node_id')
            ->withPivot('enable')
            ->as('role_nodes')
            ->using(RoleNode::class)
            ->withTimestamps();
    }
}
