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

class NavbarComponent extends React.Component {
    render(){
        return(
            <nav className="main-header navbar navbar-expand bg-white navbar-light border-bottom">
                {props.children}    
            </nav>
        );
    }
 };


const mapStateToProps = (state) => {
  return {
    
  }
}

export const Navbar = connect(
  mapStateToProps,
  null
)(NavbarComponent)
