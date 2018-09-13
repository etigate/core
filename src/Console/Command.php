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

use Illuminate\Console\Command as LaravelCommand;
use Illuminate\Support\Composer;
use Illuminate\Filesystem\Filesystem;
use FilesystemIterator;
use Psy\Util\Json;

use Glugox\Core\Core;


/**
 * Description of Command
 *
 * @author Ervin
 */
class Command extends LaravelCommand {

    
    
    /**
     * The filesystem instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $files;
    
    /**
     * The Composer class instance.
     *
     * @var \Illuminate\Support\Composer
     */
    protected $composer;
    
    
    /**
     *
     * @var Core
     */
    protected $core;




    /**
     * Class Constructor
    */
    public function __construct(Composer $composer, Filesystem $files) {
        
        parent::__construct();       
        $this->files = $files;
        $this->composer = $composer;
        
        $this->core = \resolve('core');
    }
    

    /**
     * Gets module name (from command arg)
     *
     * @return string
     */
    protected function getModuleName() {
        return strtolower($this->argument('name'));
    }
 
    
    
    /**
     * Get the path to the Composer.json file.
     *
     * @return string
     */
    protected function getComposerPath()
    {
        return $this->laravel->basePath().'/composer.json';
    }
    

}
