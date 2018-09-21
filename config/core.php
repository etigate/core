<?php

/*
 * This file is part of Glugox.
 *
 * (c) Glugox <glugox@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [

    
   /*
    |--------------------------------------------------------------------------
    | Base URI
    |--------------------------------------------------------------------------
    |
    */
   'uri' => '',
    
    /*
    |--------------------------------------------------------------------------
    | Middleware
    |--------------------------------------------------------------------------
    |
    */
    'middleware' => \Glugox\Core\Http\Middleware\AclMiddleware::class,



    /*
    |--------------------------------------------------------------------------
    | User
    |--------------------------------------------------------------------------
    |
    */
    'user' => [
        'admin' => [
            'defaults' => [
                'name' => 'Admin',
                'email' => 'info@glugox.com',
                'password' => 'secret',
                'roles' => []
            ]
        ]
    ]
];
