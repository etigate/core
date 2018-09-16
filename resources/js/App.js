import React, { Fragment  } from 'react';
import { Provider } from 'react-redux'
import { Route, Switch } from 'react-router-dom'
import { ConnectedRouter } from 'react-router-redux'
import { AuthGuard, ModalProviderWrapper, ModalRoot  } from './components'
import { store, browserHistory } from 'store/create-store'
import { DashboardLayout, FormPageLayout } from 'layouts'

import {
    Overview
} from 'pages'

const withDashboard = (ContentComponent) => {
  return (props) => (
    <AuthGuard>
      <DashboardLayout>
        <ContentComponent {...props} />
      </DashboardLayout>
    </AuthGuard>
  )
}


/**
 * 
 * @param {type} props
 * @returns {String}
 */
export const App = (props) => (
    <ModalProviderWrapper>
        <Provider store={store}>
            <ConnectedRouter history={browserHistory}>
                <Fragment>
                    <Switch>
                        <Route exact path='/' component={withDashboard(Overview)} />
                    </Switch>
                </Fragment>
            </ConnectedRouter>
        </Provider>
    </ModalProviderWrapper>
)


