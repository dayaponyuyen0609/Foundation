<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 2018/7/4
 * Time: 下午 01:12
 */

namespace Modules\Base\Exception;

use XC\Independent\Kit\Support\Scalar\ArrayMaster;

class ArrayCodeException extends \Exception
{
    /**
     * @var array
     */
    protected $codes = [];

    /**
     * ArrayCodeException constructor.
     * @param array|string $codes error code(s)
     * @param string $logMsg
     */
    public function __construct($codes, string $logMsg = "")
    {
        parent::__construct($logMsg, 0, null);
        $this->codes = ArrayMaster::forceBeArray($codes);
    }

    /**
     * @return array
     */
    public function getCodes()
    {
        return $this->codes;
    }
}
