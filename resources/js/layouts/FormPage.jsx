/*
 * This file is part of Glugox.
 *
 * (c) Glugox <glugox@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
import React from 'react'

import { Card, CardContent, Alert } from 'components'

export const FormPageLayout = (props) => (
    <div className="login-box">
        <div className="login-logo">
            <a href="#"><b>Safe Ozone</b></a>
        </div>
        <Card className="">
            <CardContent>
                <p className="login-box-msg">{props.title}</p>
                {props.children}
            </CardContent>
        </Card>
    </div>
)
