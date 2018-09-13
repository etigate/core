<?php

namespace Glugox\Core\Models\Eloquent;

use Illuminate\Database\Eloquent\Model;


class Setting extends Model
{


    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'settings';

    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ["config_key", "label", "description", "config_val", "data_type", "allow_null", "roles", "resource_class"];


    /**
     * The attributes that should be visible in arrays.
     *
     * @var array
     */
    protected $visible = ["config_key", "label", "config_val", "description", "data_type", "allow_null"];
    
    
    
    /**
     * 
     * @return Boolean
     */
    public function getBoolean(){
        return \in_array($this->getValue(), \config('core.true_synonyms')); 
    }
    
    
    
    /**
     * 
     * @return String
     */
    public function getString(){
        return (String) $this->getValue();
    }


    
    /**
     * 
     * @return type
     */
    public function getValue(){
        return $this->config_val;
    }
    
    
    /**
     * 
     * @return integer
     */
    public function getInteger(){
        return (int) $this->getValue();
    }
    
    
    /**
     * 
     * @return type
     */
    public function getInt(){
        return $this->getInteger();
    }


}
