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


Route::get('/users/me', '\Glugox\Core\Http\Controllers\Api\SessionController@currentUser');
Route::group(['middleware' => ['auth:api']], function () {
    
});