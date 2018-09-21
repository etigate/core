/*
 * This file is part of Glugox.
 *
 * (c) Glugox <glugox@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
import React from 'react'

export const Card = (props) => {
    const { title, children, className } = props

    return (
        <div className={`card ${className || ''}`}>
            {title && (<div className="text-lg font-bold py-3 px-4 border-b border-grey-light">{title}</div>)}
            {children}
        </div>
    )
}

export const CardContent = ({className, children}) => (
    <div className={`card-body ${className || ''}`}>
        {children}
    </div>
)

export const CardListItem = ({children}) => (
    <div className="p-4 border-b border-grey-light">
        {children}
    </div>
)
