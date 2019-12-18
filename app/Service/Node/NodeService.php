<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2019/12/17
 * Time: 下午 02:05
 */

namespace App\Service\Node;

use App\Constants\NYConstants;
use App\Repository\Node\NodeRepo;

class NodeService
{
    /**
     * @param string $displayName
     * @param string $code
     * @param string $enable
     * @param string $display
     * @param string $public
     * @return \App\Model\Node|null
     */
    public function add(
        string $displayName,
        string $code,
        string $enable = NYConstants::YES,
        string $display = NYConstants::YES,
        string $public = NYConstants::YES
    ) {
        $repo = new NodeRepo();
        $attribute = [
            'display_name' => $displayName,
            'code'         => strtoupper($code),
            'enable'       => $enable,
            'display'      => $display,
            'public'       => $public
        ];

        return $repo->create($attribute);
    }
}
