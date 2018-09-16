<?php

/*
 * This file is part of Glugox.
 *
 * (c) Glugox <glugox@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Glugox\Core\Core;

if (! function_exists('core_auth')) {
    
    /**
     * 
     * @return Glugox\Core\Services\Config
     */
    function core_config( $key = null )
    {
        return $key === null ? 
                app('core')->service('config') :
                app('core')->service('config')->get($key);
    }
    
    /**
     * 
     * @return Glugox\Core\Services\Auth
     */
    function core_auth()
    {
        return app('core')->service('auth');
    }
    
    /**
     * 
     * @return Glugox\Core\Services\Html
     */
    function core_html ( $key = null )
    {
        return $key === null ? 
                app('core')->service('html') :
                app('core')->service('html')->get($key);
    }
    
    /**
     * 
     * @return Glugox\Core\Services\Module
     */
    function core_module()
    {
        return app('core')->service('module');
    }
    
    
    /**
     * 
     * @return Glugox\Core\Services\Debug
     */
    function core_debug($msg=null)
    {
        return $msg === null ? 
                app('core')->service('debug') :
                app('core')->service('debug')->info($msg);
    }
}