<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2019/12/4
 * Time: 下午 02:40
 */

namespace App\Http\Middleware;

use App\Constants\CommonCodes;
use Closure;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use League\OAuth2\Server\Exception\OAuthServerException;
use Modules\Base\Exception\ApiErrorCodeException;

class JsonResponseHandle
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $request->headers->set('Accept', 'application/json');
        $response = $next($request);
        if (config('app.debug')) {
            $content['client_request_body'] = $request->request->all();
            $content['query_loq'] = \DB::getQueryLog();
        }
        if ($response instanceof JsonResponse) {
            // exception occur.
            if (method_exists($response, 'withException') && !is_null($response->exception)) {
                $tmpContent = $this->formatExceptionToJson($response->exception);
                $content['code'] = $tmpContent['code'] ?: CommonCodes::OK;
                $content['data'] = config('app.debug') ? $tmpContent['data'] :
                    'We will deal with this as soon as possible';
            } else {
                $tmpContent = $response->getData(true);
                $content['code'] = CommonCodes::OK;
                $content['data'] = $tmpContent['data'] ?? $tmpContent;
            }
            $response->setData($content);
        } elseif (($response instanceof Response)) {
            if (!is_null($tmpContent = $response->getContent()) || $tmpContent !== '') {
                $tmpContent = json_decode($tmpContent, true);
            }
            if (is_scalar($tmpContent) || is_null($tmpContent)) {
                $content['code'] = CommonCodes::OK;
                $content['data'] = $response->getContent();
            } else {
                $content['code'] = CommonCodes::OK;
                $content['data'] = $tmpContent['data'] ?? $tmpContent;
            }
            $response->setContent($content);
        }

        return $response->setStatusCode(200);
    }

    /**
     * @param \Throwable $e
     * @return array
     */
    private function formatExceptionToJson(\Throwable $e)
    {
        if ($e instanceof ValidationException) {
            $msg = $e->validator->getMessageBag()->all();
            $trace = [];
            $code = [CommonCodes::REQUEST_VALIDATE_FAIL];
        } else {
            $code = [CommonCodes::ERROR];
            $msg = $e->getMessage();
            $trace = $e->getTrace();
            if ($e instanceof ApiErrorCodeException) {
                $code = $e->getCodes();
            } else {
                if ($e instanceof AuthorizationException) {
                    $code = [CommonCodes::ACCESS_DENIED];
                } elseif ($e instanceof OAuthServerException) {
                    $code = [CommonCodes::AUTHENTICATION_FAIL];
                }
            }
        }
        $result = [
            'code' => $code,
            'data' => [
                'line'  => $e->getLine(),
                'msg'   => $msg,
                'trace' => $trace
            ]
        ];

        return $result;
    }
}
