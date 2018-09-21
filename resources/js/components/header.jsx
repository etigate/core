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

export default  class Header extends React.Component {

    constructor(props) {
        super(props);

        this.handleLogoutClick = this.handleLogoutClick.bind(this);

        this.state = {
            allowSearch: false,
            notificationsPrms: '{"url":"http:\\/\\/safeozone.com\\/user\\/notifications"}',
            logoutUrl: '/logout',
            csrfToken: ''
        }
    }


    handleLogoutClick(){
        console.log("Logout");
        // remove user from local storage to log user out
        localStorage.removeItem('user');
    }


    render(){
        return(
            <nav className="main-header navbar navbar-expand bg-white navbar-light border-bottom">
                <ul className="navbar-nav">
                    <li className="nav-item">
                        <a className="nav-link" data-widget="pushmenu" href="#"><i className="fa fa-bars"></i></a>
                    </li>
                    <li className="nav-item d-none d-sm-inline-block">
                        <a href="{{ route('dashboard.index.get') }}" className="nav-link">Home</a>
                    </li>
                    <li className="nav-item d-none d-sm-inline-block">
                        <a href="#" onClick={ this.handleLogoutClick } className="nav-link">Logout</a>
                    </li>
                </ul>

                <form className="form-inline ml-3" style={{display: "none"}}>
                    <div className="input-group input-group-sm">
                        <input className="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search" />
                            <div className="input-group-append">
                                <button className="btn btn-navbar" type="submit">
                                    <i className="fa fa-search"></i>
                                </button>
                            </div>

                    </div>
                </form>

                <ul className="navbar-nav ml-auto">
                    <li id="notifications-wrapper" g-auto-updater="{{ $gAutoUpdaterPrms }}" className="g-element g-el-notifications nav-item dropdown notifications-preview">

                    </li>
                    <li className="nav-item">
                        <a className="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i
                            className="fa fa-th-large"></i></a>
                    </li>
                </ul>
            </nav>
        );
    }
 };


const mapStateToProps = (state) => {
  return {

  }
}

/*export const Header = connect(
  mapStateToProps,
  null
)(HeaderComponent)*/
