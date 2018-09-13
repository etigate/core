<?php

/*
 * This file is part of Glugox.
 *
 * (c) Glugox <glugox@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Glugox\Core\Http\Controllers;

/**
 * Description of DashboardController
 *
 * @author Ervin
 */
class DashboardController extends Controller {
    
    
    /**
     * Class Constructor
     */
    public function __construct() {
        $this->middleware(\config('core.middleware'));
    }
    
    
    /**
     * Show the login form.
     *
     * @return Response
     */
    public function getIndex()
    {  
        
        $widgets = \resolve('widgets')->getWidgetsForPath('dashboard.index.get'); 
        return view("dashboard::dashboard", ['widgets' => $widgets]);
    }
    
    
}
