import React from 'react'

const textInputClasses = 'form-control'

export const TextInput = (props) => (
    <input {...props} className={`${textInputClasses} `} type="text" />
)

export const PasswordInput = (props) => (
    <input {...props} className={`${textInputClasses} `} type="password" />
)

export const TextArea = (props) => (
    <textarea {...props} className={`${textInputClasses} `} ></textarea>
)