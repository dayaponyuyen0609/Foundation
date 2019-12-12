<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2019/12/11
 * Time: 下午 07:15
 */

namespace App\Util;

use Modules\Base\Exception\ApiErrorCodeException;

class LaravelLoggerUtil
{
    /**
     * @param \Throwable $e
     * @param string $level ref \Modules\Base\Constants\MonologLevelLabelConstants const to know all level
     * , default is debug level.
     */
    public static function loggerException(\Throwable $e, string $level = 'debug')
    {
        $message = [
            'msg'  => $e->getMessage(),
            'line' => $e->getLine(),
            'file' => $e->getFile()
        ];
        if (!($e instanceof ApiErrorCodeException)) {
            $message['trace'] = $e->getTraceAsString();
        }
        self::loggerMessage(json_encode($message), $level);
    }

    /**
     * @param string $message
     * @param string $level ref \Modules\Base\Constants\MonologLevelLabelConstants const to know all level
     * , default is debug level.
     */
    public static function loggerMessage(string $message, string $level = 'debug')
    {
        \Log::log($level, $message);
    }
}
