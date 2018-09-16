<?php

/*
 * This file is part of Glugox.
 *
 * (c) Glugox <glugox@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Glugox\Core\Http\Controllers\Api;

use Illuminate\Http\Request;


class SessionController
{
    
    public function __construct() {
        //
    }
    
    
    /**
     * 
     * @return string
     */
    public function currentUser(){
        return 1;
    }
    
}