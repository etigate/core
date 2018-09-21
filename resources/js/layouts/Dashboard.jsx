/*
 * This file is part of Glugox.
 *
 * (c) Glugox <glugox@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
import React from 'react'
import Header from 'components/header'
import MainMenu from 'components/mainmenu'

import { PageHeader, PageFooter } from 'components'

export const DashboardLayout = (props) => (
  <div>
        <div className="wrapper">
            <Header />
            <MainMenu />
            <div className="content-wrapper">
                {props.children}
            </div>
        </div>
  </div>
)
