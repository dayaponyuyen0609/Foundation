<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2019/12/6
 * Time: 下午 03:07
 */
Route::group([
    'prefix'     => 'passport',
    'namespace'  => 'Passport',
    'middleware' => ['cors', 'throttle:20,1', 'debug_export', 'json_response'],
], function () {
    Route::post('token', 'GrantTokenController@issueToken');
    Route::post('personal/token', 'GrantTokenController@personalToken')->middleware('auth:api');
});
