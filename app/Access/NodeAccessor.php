<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2019/12/13
 * Time: 下午 03:34
 */

namespace App\Access;

use App\Constants\NYConstants;
use App\Contracts\Node\IGate;
use App\Model\Account;
use App\Util\LaravelLoggerUtil;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Builder;

class NodeAccessor implements IGate
{
    /**
     * @var Account
     */
    private $user;

    /**
     * NodeAccessor constructor.
     * @param Account|Authenticatable $user
     */
    public function __construct(Account $user = null)
    {
        $this->user = $user;
    }

    /**
     * @inheritdoc
     */
    public function hasAccess(string $code)
    {
        $result = false;
        try {
            $result = !is_null($this->user) && $this->user->roles()
                    ->where('enable', NYConstants::YES)
                    ->whereHas('nodes', function (Builder $builder) use ($code) {
                        $builder->where('node.code', $code)
                            ->where('node.enable', NYConstants::YES)
                            ->where('role_node.enable', NYConstants::YES);
                    })->exists();
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }

    /**
     * @inheritdoc
     */
    public function anyAccess(array $code)
    {
        $result = false;
        try {
            $result = !is_null($this->user) && $this->user->roles()
                    ->where('enable', NYConstants::YES)
                    ->whereHas('nodes', function (Builder $builder) use ($code) {
                        $builder->whereIn('node.code', $code)
                            ->where('node.enable', NYConstants::YES)
                            ->where('role_node.enable', NYConstants::YES);
                    })->exists();
        } catch (\Throwable $e) {
            LaravelLoggerUtil::loggerException($e);
        }

        return $result;
    }
}
