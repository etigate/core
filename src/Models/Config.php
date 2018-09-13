<?php

/*
 * This file is part of Glugox.
 *
 * (c) Glugox <glugox@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Glugox\Core\Models;

/**
 * Description of Config
 *
 * @author Ervin
 */
class Config extends \SimpleXMLElement{



    /**
     * Enter description here...
     *
     * @return boolean
     */
    public function hasChildren()
    {
        if (!$this->children()) {
            return false;
        }

        // simplexml bug: @attributes is in children() but invisible in foreach
        foreach ($this->children() as $k=>$child) {
            return true;
        }
        return false;
    }

     /**
     * Returns the node and children as an array
     *
     * @return array|string
     */
    public function asArray()
    {
        return $this->_asArray();
    }

    /**
     * asArray() analog, but without attributes
     * @return array|string
     */
    public function asCanonicalArray()
    {
        return $this->_asArray(true);
    }

    /**
     * Returns the node and children as an array
     *
     * @param bool $isCanonical - whether to ignore attributes
     * @return array|string
     */
    protected function _asArray($isCanonical = false)
    {
        $result = [];
        if (!$isCanonical) {
            // add attributes
            foreach ($this->attributes() as $attributeName => $attribute) {
                if ($attribute) {
                    $result['@'][$attributeName] = (string)$attribute;
                }
            }
        }
        // add children values
        if ($this->hasChildren()) {
            foreach ($this->children() as $childName => $child) {
                $childArrItem = $child->_asArray($isCanonical);
                if(!empty($childArrItem)){
                    $result[$childName][] = $childArrItem;
                }

            }
        } else {
            if (empty($result)) {
                // return as string, if nothing was found
                $result = (string) $this;
            } else {
                // value has zero key element
                $result[0] = (string) $this;
            }
        }
        return $result;
    }

}
