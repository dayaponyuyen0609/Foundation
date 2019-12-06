<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2019/12/5
 * Time: 上午 11:35
 */

namespace App\Constants;

use XC\Independent\Kit\Support\Scalar\ArrayMaster;

abstract class BaseConstants
{
    /**
     * @return array
     */
    abstract public static function enum(): array;

    /**
     * @param mixed $value
     * @throws \Exception
     */
    public static function validateValue($value)
    {
        if (!self::isValidValue($value)) {
            throw new \Exception('value => ' . $value . 'invalid.');
        }
    }

    /**
     * @param mixed $value
     * @return bool
     */
    public static function isValidValue($value): bool
    {
        return isset(self::mirrorSymmetryEnum()[$value]);
    }

    /**
     * The key equals value Map
     * @return array
     */
    public static function mirrorSymmetryEnum(): array
    {
        $result = [];
        foreach (static::enum() as $const) {
            $result[$const] = $const;
        }

        return $result;
    }

    /**
     * @param string $glue
     * @return string
     */
    public static function implodeEnum($glue = ',')
    {
        return ArrayMaster::implode(static::enum(), $glue);
    }
}
