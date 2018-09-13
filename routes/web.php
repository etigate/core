<?php

/*
 * This file is part of Glugox.
 *
 * (c) Glugox <glugox@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

$spa = function(){
    return view(\resolve('core')->getView());
};


/**
 * Catchall route for the single page application
 */
Route::get('/{view?}', $spa)->where('view', '(.*)')->name('catchall');
