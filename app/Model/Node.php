<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2019/12/13
 * Time: 下午 04:21
 */

namespace App\Model;

use App\Model\Support\BaseORM;

class Node extends BaseORM
{
    protected $table = 'node';
    protected $fillable = [
        'enable',
        'display',
        'display_name',
        'public',
        'code'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_node', 'node_id', 'role_id')
            ->withTimestamps();
    }
}
