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
 * Description of MessagingByModel
 *
 * @author Ervin
 */
trait MessagingByModel {

    /**
     * Returns nicely formated and translated
     * message for a model action.
     * 
     * @param type $msg
     */
    protected function modelMsg($msg, $args=[]) {
        
        $isError = false;
        if (strpos($msg, "~") === 0) {
            $isError = substr($msg, -2) === "-e";
            $msg = $this->resolveMgs($msg, $args);
        }

        
        //$fullMsg = $this->getModelKey() . " " . $msg;
        //$fullMsg = trans("core." . $fullMsg);
        
        $fullMsg = $msg;
        
        if($isError){
            $fullMsg = "<span style=\"color:#dd4b39;\">" . $fullMsg . "</span>";
        }
        return $fullMsg;
    }

    /**
     * Returns model name that can be defined
     * in the ex. controller clas as protected property
     * 
     * ex. protected $modelKey = "User";
     * 
     * @return string
     */
    protected function getModelKey() {
        $model = !property_exists($this, "modelKey") ? "Model" : $this->modelKey;
        if (is_object($model)) {
            $model = get_class($model);
        }
        return $model;
    }

    /**
     * Resolves predefined definitions  of
     * model messages, they all start with '~' sign.
     * 
     * @param type $msg
     */
    protected function resolveMgs($msg, $args=[]) {
        
        $arr = \explode(":", $msg);
        $part1 = \count($arr) > 1 ? $arr[0] : $msg; 
        $part2 = \count($arr) > 1 ? $arr[1] : ""; 
        
        $argsMsg = !$part2 ? "" : " (" . $part2 . ")";
        if(\count($args)){
            $argsMsg .= " >> [".  \implode(",", $args)."]";
        }
        
        $pMsg = substr($msg, 1);
        
        switch ($part1) {
            case "~rm-s":
                $pMsg = \trans("core.Entity was successfully deleted.");
                break;
            case "~rm-e":
                $pMsg = \trans("core.Entity removal had same errors!");
                break;
            case "~mk":
                $pMsg = \trans("core.Entity was successfully created.");
                break;
            case "~mk-e":
                $pMsg = \trans("core.Entity creation had some errors!");
                break;
            case "~u":
                $pMsg = \trans("core.Entity was successfully updated.");
                break;
            case "~err":
                $pMsg = \trans("core.Entity processing had some errors!");
                break;
            default :
                //
        }
        
        return $pMsg . $argsMsg;
    }

}
