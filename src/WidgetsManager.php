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


/**
 * Description of WidgetsManager
 *
 * @author Ervin
 */
class WidgetsManager {
    
   
    
    /**
     * Loads a html string from filesystem for a given module and widget alias.
     * 
     * @param type $moduleSlug
     * @param type $widgetSlug
     * 
     * @return string
     */
    public function loadWidgetHtml( $moduleSlug, $widgetSlug ){
        return '';
    }
    
    
    /**
     * Returns array of widgets that should be presented on given path for currently
     * logged in user.
     * 
     * @param string $path
     * @return array
     */
    public function getWidgetsForPath( $path ){
        
        $user = \Auth::user();
        $elements = [];
        
        // Load the eloquent models from relation
        $widgets = $user->widgets()->get();
        
        if(count($widgets)){
            foreach ($widgets as $widget){
                $view = $widget->view;
                $alias = $widget->alias;

                $instance = app($alias);
                $instance->setModel($widget);

                $elements[] = $instance;
            }
        }
        
        return $elements;
    }
    
}
