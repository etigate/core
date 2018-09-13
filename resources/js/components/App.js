import React, { Component } from 'react';
import { Provider } from 'react-redux'
import { Route, Switch } from 'react-router-dom'
import { ConnectedRouter } from 'react-router-redux'

import { Modal } from './modals/modal'
import { Navbar } from './navbar'
import Sidebar from './sidebar'




export default class App extends Component {
    render() {
        return (
            <div className="wrapper">
                <Modal />
                <Sidebar />
                <div class="content-wrapper">

                </div>
            </div>
        );
    }
}


