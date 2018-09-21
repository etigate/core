<?php

/*
 * This file is part of Glugox.
 *
 * (c) Glugox <glugox@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Illuminate\Http\Request;
use Illuminate\Cookie\Middleware\EncryptCookies;


/*Route::get('/users/me', '\Glugox\Core\Http\Controllers\Api\SessionController@currentUser');



Route::group(['middleware' => ['auth:api']], function () {

});


//Route::group(['middleware' => ['auth:api', EncryptCookies::class]], function () {
    Route::post('/login', '\Glugox\Core\Http\Controllers\Api\SessionController@login')->name('login');
//});*/


Route::post('login', '\Glugox\Core\Http\Controllers\Api\AuthController@login')->name('login');
Route::post('logout', '\Glugox\Core\Http\Controllers\Api\AuthController@logout')->name('logout');
Route::post('refresh', '\Glugox\Core\Http\Controllers\Api\AuthController@refresh')->name('refresh');
Route::post('me', '\Glugox\Core\Http\Controllers\Api\AuthController@me')->name('me');