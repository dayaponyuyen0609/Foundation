<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2019/12/18
 * Time: 下午 04:23
 */
Route::group([
    'prefix'     => 'account',
    'namespace'  => 'Account',
    'middleware' => ['api'],
], function () {
    Route::get('/', 'AccountController@index');
    Route::post('/', 'AccountController@store');
    Route::put('/', 'AccountController@update');
    Route::delete('/', 'AccountController@delete');
});
