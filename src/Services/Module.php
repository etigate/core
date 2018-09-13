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

use Illuminate\Support\Arr;

use Glugox\Core\Contracts\IModule;
use Glugox\Core\BasicServiceProvider;
use Glugox\Core\CoreServiceProvider;

/**
 * Description of Module
 *
 * @author User
 */
class Module extends Service {

    /** 
     * Returns array of classes (Service Providers) that implements IModule interface.
     * 
     * @return array
     */
    public function all(){
        return Arr::where(\config('app.providers'), function ($value) {
            return \in_array(IModule::class, \class_implements($value));
        });   
    }
    
     /** 
     * Returns class (Service Providers) that implements IModule interface and has module id like parameter $moduleId .
     * 
     * @return array
     */
    public function get( $moduleId ){
        
        foreach (\config('app.providers') as $value){
            if(\in_array(IModule::class, \class_implements($value)) && $value::getModuleId() == $moduleId){
                return $value;
            }
        }
         
    }
}
