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

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Support\Facades\Route;

use Glugox\Core\Contracts\IModule;

/**
 * Description of EtiServiceProvider
 *
 * @author User
 */
class ModuleServiceProvider extends ServiceProvider implements IModule {
    
    
    /**
     *
     * @var array
     */
    protected $events = [];
    
    
    /**
     * All of the service bindings for Core.
     *
     * @var array
     */
    public static function getServiceBindings() {
        return [];
    }
    
    
    /**
     * @throws \Exception
     */
    public static function getModuleId(){
        throw new \Exception('Service provider of a module must have Module id defined in getModuleId method!');
    }
    
    /**
     * @return array
     */
    public static function getCommands() {
        return [];
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(\Illuminate\Routing\Router $router )
    {
        
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        
        $this->registerEvents();
        $this->registerRoutes();
        $this->registerResources();
        $this->defineAssetPublishing();
    }
    
     /**
     * Register the Horizon job events.
     *
     * @return void
     */
    protected function registerEvents()
    {
        $dispatcher = $this->app->make(Dispatcher::class);
        foreach ($this->events as $event => $listeners) {
            foreach ($listeners as $listener) {
                $dispatcher->listen($event, $listener);
            }
        }
    }
    /**
     * Register the Horizon routes.
     *
     * @return void
     */
    protected function registerRoutes()
    {

        Route::group([
            'prefix' => config('core.uri', 'core'),
            'namespace' => 'Glugox\Core\Http\Controllers',
            //'middleware' => config('core.middleware', 'web'),
        ], function () {
            $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        });
    }
    /**
     * Register the Horizon resources.
     *
     * @return void
     */
    protected function registerResources()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'core');
    }
    /**
     * Define the asset publishing configuration.
     *
     * @return void
     */
    public function defineAssetPublishing()
    {
        $this->publishes([
            CORE_PATH.'/public' => public_path('vendor/' . static::getModuleId()),
        ], static::getModuleId().'-assets');
    }
    
    
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if (! defined('CORE_PATH')) {
            define('CORE_PATH', realpath(__DIR__.'/../'));
        }
        
        
        $this->configure();
        $this->offerPublishing();
        $this->registerServices();
        $this->registerCommands();
        

        // Register composers
        view()->composer(
            '*', 'Glugox\Core\Http\ViewComposers\CoreComposer'
        );
    }
    
    
    
    
        /**
     * Setup the configuration for Core.
     *
     * @return void
     */
    protected function configure()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/core.php', 'core'
        );
    }
    
    
    /**
     * Setup the resource publishing groups for Core.
     *
     * @return void
     */
    protected function offerPublishing()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/'.static::getModuleId().'.php' => config_path(static::getModuleId().'.php'),
            ], static::getModuleId().'-config');
        }
    }
    
    
    /**
     * Register Core's services in the container.
     *
     * @return void
     */
    protected function registerServices()
    {
        foreach (static::getServiceBindings() as $key => $value) {
            is_numeric($key)
                    ? $this->app->singleton($value)
                    : $this->app->singleton($key, $value);
        }
    }
    
    
        /**
     * Register the Core Artisan commands.
     *
     * @return void
     */
    protected function registerCommands()
    {
        $this->commands(static::getCommands());
    }

    
    /**
     * 
     */
    public static function install() {
        
        
        $moduleId = static::getModuleId();

        // load module's config file
        $configFile = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'etc' . DIRECTORY_SEPARATOR . "config.xml";

        // load module's config file
        if (\file_exists($configFile)) {
            $configData = \file_get_contents($configFile);
            $xml = simplexml_load_string($configData, 'Glugox\Core\Models\Config', LIBXML_NOBLANKS | LIBXML_NOEMPTYTAG);  
            app('core')->service('config')->applyXml($xml->admin->settings->$moduleId->setting);
            
            
        }

        
    }

}
