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
use XC\Independent\Kit\Support\Traits\Pattern\Singleton;

class NodeService
{
    use Singleton;
    /** @var NodeRepo $repo */
    private $repo;

    /**
     * Initialize class.
     */
    protected function init()
    {
        $this->repo = $this->repo ?: new NodeRepo();
    }

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
        $attribute = [
            'display_name' => $displayName,
            'code'         => strtoupper($code),
            'enable'       => $enable,
            'display'      => $display,
            'public'       => $public
        ];

        return $this->repo->create($attribute);
    }
}
