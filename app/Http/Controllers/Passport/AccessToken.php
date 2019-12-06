<?php

namespace App\Http\Controllers\Passport;

use App\Http\RequestHandle\Passport\PersonalTokenRequest;
use App\Model\Account;
use Illuminate\Routing\Controller;
use Laravel\Passport\ClientRepository;
use Laravel\Passport\Http\Controllers\AccessTokenController;
use Laravel\Passport\Passport;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2019/12/5
 * Time: 下午 07:19
 */
class AccessToken extends Controller
{
    /**
     * @param ServerRequestInterface $request
     * @return \Illuminate\Http\Response
     */
    public function issueToken(ServerRequestInterface $request)
    {
        //有效期限3天
        Passport::tokensExpireIn(now()->addDays(3));
        $token = app(AccessTokenController::class)->issueToken($request);

        return $token;
    }

    /**
     * @param PersonalTokenRequest $request
     * @param ClientRepository $client
     * @return array
     */
    public function personalToken(PersonalTokenRequest $request, ClientRepository $client)
    {
        //有效期限3年
        Passport::tokensExpireIn(now()->addYears(3));
        /** @var Account $user */
        $user = \Auth::user();
        $userClient = $client->activeForUser($user->getAuthIdentifier())->first();
        if (is_null($userClient)) {
            $client->createPersonalAccessClient(
                $user->getAuthIdentifier(),
                $user->account . '_personal_client',
                ''
            );
        }
        $token = $user->createToken($request->getName());

        return [
            'token' => $token->accessToken,
            'name'  => $token->token->getAttribute('name')
        ];
    }
}
