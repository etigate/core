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

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Input;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Glugox\Core\Traits\ControllerRedirect;
use Glugox\Core\Traits\MessagingByModel;
use Glugox\Core\Http\Requests\Request;




/**
 * Description of Controller
 *
 * @author Ervin
 */
abstract class Controller extends BaseController {

    use DispatchesJobs,
        ValidatesRequests,
        ControllerRedirect,
        MessagingByModel,
        AuthorizesRequests;

    /**
     * Eloquent repository
     *
     * @var \Glugox\Core\Contracts\IEloquentRepository
     */
    protected $_repository;

    /**
     * Generic method for post adding an eloquent
     * when we have repository that extends 
     * \Glugox\Core\Repositories\EloquentRepository
     * 
     * Handles the form adds a new user.
     *
     * @return Response
     */
    public function eloquentAdd(Request $request, $addMsg = NULL, $doRedirect=true) {

        $model = $this->_repository->createFromRequest($request);
        
        if(!$addMsg){
            $addMsg = [];
        }
        if(!$model){
            $msg = $this->modelMsg("~err");
        }else{
            $addMsg['model_id'] = $model->id;
            $msg = $this->modelMsg("~mk");
        }
        
        // response
        if ($request->ajax()) {
            $ajaxResult = is_array($addMsg) ? array_merge(['msg' => $msg], $addMsg) : ['msg' => $msg];
            return response()->json($ajaxResult);
        } else {
            if($doRedirect){
                return $this->redirectOnUpdate($this->getModelKey(), $model, $request, $msg);
            }else{
                \Flash::success($msg);
                return $model;
            }
            
        }
        
    }

    /**
     * Generic method for post editing an eloquent
     * when we have repository that extends 
     * \Glugox\Core\Repositories\EloquentRepository
     * 
     * @return type
     */
    protected function eloquentEdit(Request $request, $addMsg = NULL, $doRedirect=true) {

        // update
        $ids = (array) $request->get("id");
        $result = $this->_repository->updateMultiple($ids, $request->all()); 
        if ($result) {
            $msg = $this->modelMsg("~u");
        } else {
            $msg = $this->modelMsg("~err");
        }
        
        // response
        if ($request->ajax()) {
            $ajaxResult = is_array($addMsg) ? array_merge(['msg' => $msg], $addMsg) : ['msg' => $msg];
            return response()->json($ajaxResult);
        } else {
            
            if($doRedirect){
                return $this->redirectOnUpdate($this->getModelKey(), null, $request, $msg);
            }else{
                \Flash::success($msg);
                return $result;
            }
        }
    }

}
