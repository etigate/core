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

use Glugox\Core\Console\CreateAdminUser;
use Glugox\Core\Contracts\IModule;

/**
 * Description of CoreServiceProvider
 *
 * @author Ervin
 */
class CoreServiceProvider extends ModuleServiceProvider  {
    
    
    const MODULE_ID = 'core';
    
    /**
     * All of the service bindings for Core.
     *
     * @var array
     */
    public static function getServiceBindings() {
        return [
            'widgets' => \Glugox\Core\WidgetsManager::class,
            'core' => \Glugox\Core\Core::class
        ];
    }
    
    /**
     * @return string
     */
    public static function getModuleId(){
        return self::MODULE_ID;
    }
    
    /**
     * @return array
     */
    public static function getCommands() {
        return [
            \Glugox\Core\Console\InstallModule::class,
            \Glugox\Core\Console\CreateAdminUser::class
        ];
    }
}
