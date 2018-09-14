import React, { Component } from 'react';
import { Provider } from 'react-redux'
import { Route, Switch } from 'react-router-dom'
import { ConnectedRouter } from 'react-router-redux'
import { Modal } from './components/modals/modal'
import Header from './components/header'
import MainMenu from './components/mainmenu'
import { AuthGuard, ModalProviderWrapper, ModalRoot  } from './components'
import { store, browserHistory } from 'store/create-store'



export const App = (props) => (
        
        <ModalProviderWrapper>
        <Provider store={store}>
            <div className="wrapper">
                <Modal />
                <Header />
                <MainMenu />
                <div className="content-wrapper">
                   
                </div>
            </div>
        </Provider>
        </ModalProviderWrapper>
        
)


