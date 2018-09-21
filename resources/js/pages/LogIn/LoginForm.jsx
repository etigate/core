/*
 * This file is part of Glugox.
 *
 * (c) Glugox <glugox@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
import React from 'react'
import { Link } from 'react-router-dom'
import { reduxForm, Field } from 'redux-form'

import { PasswordFormLine, TextFormLine, NeutralButton } from 'components'
import { email as emailRegex } from 'constants/regexes'
import { linkStyle } from 'constants/styles'

const validateLogin = (values) => {
    let errors = {}

    if (!values.email) {
        errors.email = 'This field is required'
    } else if (!emailRegex.test(values.email)) {
        errors.email = 'Invalid email address'
    }

    if (!values.password) {
        errors.password = 'This field is required'
    }

    return errors
}

const LoginForm = (props) => {
    const { handleSubmit, submitting } = props

    return (
        <form onSubmit={handleSubmit}>
            <Field component={TextFormLine} type="text" name="email" placeholder="Email" />
            <Field component={PasswordFormLine} type="password" name="password" placeholder="Password" />
            <div className="row">

                <div className="col-8">
                    <Link className={linkStyle} to="/signup"><small>Or Signup</small></Link>
                    <span className="inline-block px-2"><small>|</small></span>
                    <Link className={linkStyle} to="/forgot-password"><small>Forgot Password?</small></Link>
                </div>

                <div className="col-4">
                    <NeutralButton disabled={submitting} type="submit">Log In</NeutralButton>
                </div>

            </div>
        </form>
    )
}

export default reduxForm({
    form: 'login',
    validate: validateLogin
})(LoginForm)
