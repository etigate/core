/*
 * This file is part of Glugox.
 *
 * (c) Glugox <glugox@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

import React from 'react'
import { connect } from 'react-redux'
import { push } from 'react-router-redux'
import { SubmissionError } from 'redux-form'

import { logIn } from 'store/action-creators/session'
import LogInForm from './LogInForm'
import { flashMessage } from 'store/action-creators/flashMessages'
import { flashMessageActions } from 'store/actions'
import { Alert } from 'components'

class LogInComponent extends React.Component {


    componentDidMount(){
        document.body.classList.add('login-page')
    }

    render() {
        return (
            <div>
            <Alert message={this.props.login_response} />
            <LogInForm submitting={this.props.submitting} onSubmit={this.props.attemptLogin} />
            </div>
        )
    }
}

const parseValidationFromResponse = (response) => {
    let errors = {}
    if (response.errors === true && response.message === 'Incorrect login details') {
        errors.email = 'Incorrect login details'
    }

    return errors
}


const mapStateToProps = (state) => ({
    login_response: !state.flashMessages.login_response ? '' : state.flashMessages.login_response.message,
    //submitting: state.form.login.submitting
})

const mapDispatchToProps = (dispatch) => ({
    attemptLogin: (loginDetails) => {

        return dispatch(logIn(loginDetails))
            .then((response) => {

                if(response.data.access_token){

                    // store user details and jwt token in local storage to keep user logged in between page refreshes
                    localStorage.setItem('user', JSON.stringify(response.data));

                    //access_token
                    dispatch(push('/'))
                }else{

                    dispatch(flashMessage(flashMessageActions.SHOW_MESSAGE, 'Login failed!', 'login_response'));
                    //throw new SubmissionError(parseValidationFromResponse(error.response.data))
                }
            })
            .catch((error) => {
                console.log(error);
                //throw new SubmissionError(parseValidationFromResponse(error.response.data))
            })
    }
})

export const LogIn = connect(
    mapStateToProps,
    mapDispatchToProps
)(LogInComponent)
