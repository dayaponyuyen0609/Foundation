<?php
/**
 * Created by PhpStorm.
 * User: funny
 * Date: 2019/12/6
 * Time: 下午 08:33
 */

use App\Policies\RolePolicy;

Route::group([
    'prefix'     => 'role',
    'namespace'  => 'Role',
    'middleware' => ['api', 'can:manage,' . RolePolicy::class],
], function () {
    Route::get('/', 'RoleController@index');
    Route::post('/', 'RoleController@store');
    Route::put('/', 'RoleController@update');
    Route::delete('/', 'RoleController@delete');
});
