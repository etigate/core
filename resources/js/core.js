/**
 * First we will load all of this project's JavaScript dependencies which
 * includes React and other helpers. It's a great starting point while
 * building robust, powerful web applications using React + Laravel.
 */

require('./bootstrap');

import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import { App } from './App';

import { AppContainer } from 'react-hot-loader'


/**
 * Next, we will create a fresh React component instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


if (document.getElementById('etigate')) {
    ReactDOM.render(
            <AppContainer warnings={false}>
                <App />
            </AppContainer>, 
            document.getElementById('etigate')
            );
}


/**
 * Webpack Hot Module Replacement API
 */
if (module.hot) {
  module.hot.accept()
}