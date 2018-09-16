/*
 * This file is part of Glugox.
 *
 * (c) Glugox <glugox@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
import React from 'react'

export const Modal = (props) => (
  <div className="modal fade" id="kama-modal" role="dialog">
    <div className="modal-dialog">
        <div className="modal-content">
            <div className="modal-header">
                <h4 className="modal-title">ETI Gate</h4>
                <button type="button" className="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                
            </div>
            <div className="modal-body">
                
            </div>
            <div className="modal-footer">
                <button type="button" className="btn btn-default pull-left" data-dismiss="modal">{props.close_label}</button>
                <button type="button" className="btn btn-primary" data-dismiss="modal">{props.ok_label}</button>
            </div>
        </div>
    </div>
</div> 
)
