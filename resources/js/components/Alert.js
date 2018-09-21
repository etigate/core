/*
 * This file is part of Glugox.
 *
 * (c) Glugox <glugox@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

import React, { Component } from 'react';
import { connect } from 'react-redux'

export class Alert extends Component {


    render() {

        if(!this.props.message){
            return '';
        }

        return (
            <div className="alert alert-danger alert-dismissible">
                { this.props.message }
            </div>
        )
    }
}

