<?php

/*
 * This file is part of Glugox.
 *
 * (c) Glugox <glugox@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Glugox\Core\Traits;

/**
 * Handles general redirections for controller actions
 * ex: checking redirect_to input from request.
 *
 * @author Ervin
 */
trait ControllerRedirect {

    
    /**
     * 
     * @param type $request
     * @return type
     */
    protected function redirectOnUpdate($modelKey, $model, $request, $message = null) {

        $modelKey = strtolower($modelKey);
        
        if ($message) {
            \Flash::success($message);
        }

        if ($request->filled("redirect_to")) {
            return redirect()->to($request->get("redirect_to"));
        }
        if (!$model) {
            return redirect()->route($modelKey.".list.get");
        }else{
            return redirect()->route($modelKey.".edit.get", ['id' => $model->id]);
        }
        
    }
    

}
