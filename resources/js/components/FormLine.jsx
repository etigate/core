import React from 'react'

import { PasswordInput, TextArea, TextInput } from 'components'

export const FormLine = (props) => {
    const {placeholder, labelText, name, children, className, meta: {touched, error}} = props

    return (
        <div className={`form-group ${className || ''}`}>
            {touched && (error && <div className="text-red text-sm">{error}</div>)}
            {children}
        </div>
    )
}

export const TextFormLine = (props) => (
    <FormLine {...props}>
        <TextInput {...props.input} />
    </FormLine>
)

export const PasswordFormLine = (props) => (
    <FormLine {...props}>
        <PasswordInput {...props.input} />
    </FormLine>
)

export const TextAreaFormLine = (props) => (
    <FormLine {...props}>
        <TextArea {...props.input} />
    </FormLine>
)