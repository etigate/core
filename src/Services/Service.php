<?php

/*
 * This file is part of Glugox.
 *
 * (c) Glugox <glugox@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Glugox\Core\Services;

use Glugox\Core\Repositories\ConfigRepository;

/**
 * Description of Service
 *
 * @author User
 */
class Service {
    

    /**
     *
     * @var ConfigRepository 
     */
    protected $configRepository;

    /**
     * 
     * @param ConfigRepository $repository
     */
    function __construct(ConfigRepository $repository) {
        $this->configRepository = $repository;
    }

    
    
    // Service data
    protected function getData(){
        return [];
    }

        /**
     * 
     * @param string $key
     * @return type
     */
    public function get( $key ){
        
        $data = $this->getData();
        if(isset($data[$key])){
            return $data[$key];
        }
        return null;
    }
    
    
    
    
}
