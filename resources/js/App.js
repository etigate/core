import React, { Fragment  } from 'react';
import { Provider } from 'react-redux'
import { Route, Switch } from 'react-router-dom'
import { ConnectedRouter } from 'react-router-redux'
import { AuthGuard, PrivateRoute  } from './components'
import { store, browserHistory } from 'store/create-store'
import { DashboardLayout, FormPageLayout } from 'layouts'

import {
    Overview,
    LogIn
} from 'pages'

const withDashboard = (ContentComponent) => {
  return (props) => (
      <DashboardLayout>
        <ContentComponent {...props} />
      </DashboardLayout>
  )
}

const withLogin = () => {
    return () => (
        <FormPageLayout title="Sign in to start your session"><LogIn /></FormPageLayout>
    );
}


/**
 * 
 * @param {type} props
 * @returns {String}
 */
export const App = (props) => (
        <Provider store={store}>
            <ConnectedRouter history={browserHistory}>
                <Fragment>
                    <Switch>
                        <Route exact path='/login' component={withLogin()} />
                        <PrivateRoute exact path='/' component={withDashboard(Overview)} />
                    </Switch>
                </Fragment>
            </ConnectedRouter>
        </Provider>
)


