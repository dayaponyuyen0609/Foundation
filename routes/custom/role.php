<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2019/12/6
 * Time: 下午 08:33
 */
Route::group([
    'prefix'     => 'role',
    'namespace'  => 'Role',
    'middleware' => ['cors', 'throttle:20,1', 'debug_export', 'json_response'],
], function () {
    Route::post('list', 'RoleController@index');
});
