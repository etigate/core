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

/**
 * Description of Config
 *
 * @author User
 */
class Config extends Service {
    

    

    // Service data
    protected function getData(){
        
        // This should return key value pairs of config from database.
        return $this->configRepository->allFlat();
    }

    
    /**
     * 
     * @param type $xml
     */
    public function applyXml( $settings ){
        foreach ($settings as $setting){
            $this->configRepository->upsert(['config_key' => $setting['config_key']], $setting);
        }
        
        
    }
    
}
