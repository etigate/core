<?php

/*
 * This file is part of Glugox.
 *
 * (c) Glugox <glugox@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Glugox\Core\Repositories;


use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;


use Glugox\Core\Models\Eloquent\Setting;
use Glugox\Core\Repositories\EloquentRepository;


/**
 * Description of ConfigRepository
 *
 * @author Ervin
 */
class ConfigRepository extends EloquentRepository
{

    /**
     * Class Constructor
    */
    public function __construct() {
        parent::__construct(new Setting);
    }
    
    

    /**
     * @return array
     */
    public function allFlat(){
        $all = $this->all();
        $flat = [];
        foreach ($all as $itemSetting){
            $flat[$itemSetting->config_key] = $itemSetting;
        }

        return $flat;
    }
    
    
    /**
     * Returns model instance by id.
     * 
     * @param int $id
     * @return Glugox\User\Models\Eloquent\Role
     */
    public function getByKey($key, $alt=null){

        $flat = $this->allFlat();
        return !isset($flat[$key]) ? $alt : $flat[$key];
    }
    
    
    
    /**
     * Proxy for getByKey
     * 
     * @param type $key
     * @param type $alt
     * @return type
     */
    public function get($key, $alt=null){
        return $this->getByKey($key, $alt);
    }
    
    

    /**
     * Returns model instance by id.
     *
     * @param int $id
     * @return Glugox\User\Models\Eloquent\Role
     */
    public function getAttribute($key, $alt=null){

        return $this->getByKey($key, $alt);
    }

}
