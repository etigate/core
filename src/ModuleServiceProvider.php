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
use Illuminate\Contracts\Routing\Registrar as RouteRegistrar;

use Glugox\Core\Contracts\IModule;
use Glugox\Core\Models\Config;

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
    public function boot(\Illuminate\Routing\Router $router, RouteRegistrar $routeRegistrar )
    {
        
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        
        $this->registerEvents();
        $this->registerRoutes($routeRegistrar);
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
    protected function registerRoutes(RouteRegistrar $routeRegistrar)
    {

        /*Route::group([
            'prefix' => config('core.uri', ''),
            'namespace' => 'Glugox\Core\Http\Controllers',
            //'middleware' => config('core.middleware', 'web'),
        ], function () {
            $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
            $this->loadRoutesFrom(__DIR__.'/../routes/api.php');
        });*/
        
        $this->mapApiRoutes($routeRegistrar);
        $this->mapWebRoutes($routeRegistrar);
    }
    
    
    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes(RouteRegistrar $routeRegistrar)
    {
        $routeRegistrar->middleware('web')
             ->namespace('Glugox\Core\Http\Controllers')
             ->group(__DIR__.'/../routes/web.php');
    }
    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes(RouteRegistrar $routeRegistrar)
    {
        $routeRegistrar->prefix('api')
             ->middleware('api')
             ->namespace('Glugox\Core\Http\Controllers\Api')
             ->group(__DIR__.'/../routes/api.php');
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
        core_debug("Installing " . $moduleId . '...');
        

        // load module's config file
        $configFile = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'etc' . DIRECTORY_SEPARATOR . "config.xml";

        // load module's config file
        if (\file_exists($configFile)) {
            $configData = \file_get_contents($configFile);
            
            $config = new Config($configData);
            $configArr = $config->toArray();
            
            core_debug(" >> settings");
            core_config()->applyXml($configArr['admin']['settings'][$moduleId]['setting']);
            
            core_debug(" >> acl");
            core_auth()->addACL($configArr['global'][$moduleId]['acl']);
        }

        
    }
    
    
    


}
