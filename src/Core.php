<?php

/*
 * This file is part of Glugox.
 *
 * (c) Glugox <glugox@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Glugox\Core;

use Glugox\Core\Services\Service;

/**
 * Description of Core
 *
 * @author Ervin
 */
class Core {
    
    
    // Services namespace
    const SERVICES_NAMESPACE = 'Glugox\\Core\\Services\\';   
    
    // Holdes for all on demand services
    private $services = [];

    /**
     * 
     * @return string
     */
    public function getView(){
        return 'core::app';
    }

    /**
     * 
     * @param string $key
     * @return Service
     */
    public function service($key){
        if(!isset($this->services[$key])){
            $this->services[$key] = app( self::SERVICES_NAMESPACE . ucfirst($key) );
        }
        
        return $this->services[$key];
    }
    
    
    
}
