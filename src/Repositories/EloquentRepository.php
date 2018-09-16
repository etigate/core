<?php

/*
 * This file is part of Glugox.
 *
 * (c) Glugox <glugox@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Glugox\Core\Repositories;

use Illuminate\Database\Eloquent\Model;

/**
 * Description of EloquentRepository
 *
 * @author User
 */
class EloquentRepository {
    
    
    protected $cachedData = null;


    /**
     * Eloquent model
     *
     * @var \Illuminate\Database\Eloquent\Model 
     */
    private $_model;

    public function getModel() {
        return $this->_model;
    }
   
    
    /**
     * Sets a model for repository
     * 
     * @param Model $model
     * @return \Glugox\Core\Repositories\EloquentRepository
     */
    public function setModel(Model $model){
        $this->_model = $model;
        return $this;
    }
    
    
    /**
     * Model class, can be used as model query builder.
     * 
     * @return type
     */
    public function getModelClass() {
        return \get_class($this->_model);
    }
    
    /**
     * Class Constructor
     */
    public function __construct(Model $model) {
        $this->setModel($model);
    }
    
    
    
    /**
     * Returns all items.
     * 
     * @return Illuminate\Database\Eloquent\Collection All roles
     */
    public function all(){

        if(!$this->cachedData){
            $this->cachedData = $this->getModelClass()::all();
        }

        return $this->cachedData;
    }
    
    
    
    
     /**
     * Creates a new model and saves in to the DB
     * 
     * @param array $attributes
     * @return Illuminate\Database\Eloquent\Model
     */
    public function create(array $attributes){
        
        $attributes = $this->prepareAttrs($attributes);
        $model = $this->getModelClass()::create($attributes);
        return $model;
    }
    
    
    /**
     * Update the model in the database.
     *
     * @param  array  $attributes
     * @return bool|int
     */
    public function update(Model $model, array $attributes = []) {

        $attributes = $this->prepareAttrs($attributes);
        return $model->fill($attributes)->save();
    }



    /**
     * Update the model in the database.
     *
     * @param  array  $attributes
     * @return bool|int
     */
    public function upsert(array $indexes, array $attributes) {
        return $this->getModelClass()::updateOrCreate($indexes, $this->prepareAttrs($attributes));  
    } 
    
    
    
    /**
     * 
     * 
     * @param string $key
     * @param mixed $val
     * @return \Glugox\Theme\Models\Eloquent\Theme
     */
    public function getByFields(array $attributes, array $indexes) {
        $modelClass = $this->getModelClass();
        
        $builder = $modelClass;
        
        foreach ($indexes as $index){
            $builder = $builder::where($index, '=', $attributes[$index]);
        }
        $model = $builder->first();
        return $model;
    }
    
    
    /**
     * Prepares fillable, casting, etc.
     * 
     * @param array $attributes
     * @return type
     */
    public function prepareAttrs(array $attributes) {
        $preppared = [];
        foreach ($attributes as $attributeKey => $attributeVal){
            $preppared[$attributeKey] = empty($attributeVal) ? '' : $attributeVal;
        }
        return $preppared;
    }
    
}
