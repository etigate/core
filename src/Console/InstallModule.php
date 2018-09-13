<?php

/*
 * This file is part of Glugox.
 *
 * (c) Glugox <glugox@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Glugox\Core\Console;

use Psy\Util\Json;
use Glugox\Core\Contracts\IModule;


/**
 * Description of InstallModule
 *
 * @author Ervin
 */
class InstallModule extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:install {name?} {--menu=1} {--pemissions=1} {--only?} {--overwrite=1}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Installs all modules from the modules dir or specific module from same dir if name is passed.';

    /**
     * Execute the console command.
     * module:install would trigger this method and install the
     * globally merged xml config from all modules, or only one
     * module (with its config file).
     *
     * @return mixed
     */
    public function handle() {


        $moduleName = $this->getModuleName();
        $overWrite = $this->option('overwrite');
        $this->_installModule($moduleName, $overWrite);
    }

    /**
     * Installs single module by name.
     *
     * @param type $module
     * @param type $overWrite
     * @param type $installConfig
     * @return boolean
     */
    private function _installModule($moduleName = '', $overWrite = false) {

        $this->info('installModule: '.$moduleName.'...');
        $this->info('Module: '.\resolve('core')->service('module')->get($moduleName));
        $all = empty($moduleName) ?
                \resolve('core')->service('module')->all() :
                [\resolve('core')->service('module')->get($moduleName)]
            ;
        
        /** IModule $module **/
        foreach ($all as $module){
            app()->call([$module, 'install']);
        }
    }
    
    
    /**
     * Adds settings from xml files to database setting table.
     *
     * @return void
     */
    protected function installSettings($config, $overWrite = false) {
        
    }

    /**
     * Adds menu items to the main admin menu.
     *
     * @return void
     */
    protected function installMenu($config, $overWrite = false) {

        
    }

    /**
     * Installs module(s) stuff they provide like
     * roles/permissions items to the system.
     *
     * @param type $overWrite
     */
    protected function installAcl($config, $overWrite = false) {
        
    }

    

    /**
     * Set the PSR-4 namespace in the Composer file for autoloading
     * the files of our module.
     *
     * @return void
     */
    protected function setComposerNamespace($namespace, $path, $override = true) {

        $cPath = $this->getComposerPath();
        $cCurr = $this->files->get($cPath);

        $arr = json_decode($cCurr, true);
        if (isset($arr["autoload"]["psr-4"][$namespace]) && !$override) {
            return false;
        }
        $arr["autoload"]["psr-4"][$namespace] = $path;

        $cNew = Json::encode($arr);
        $cCurr = $this->files->put($cPath, $cNew);
    }

    

}
