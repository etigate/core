/*
 * This file is part of Glugox.
 *
 * (c) Glugox <glugox@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
import React from 'react'

import './Modal.scss'

export const ModalBackdrop = ({ children, onClick }) => (
  <div onClick={onClick} className="fixed pin z-40 bg-black opacity-25 cursor-pointer">{ children }</div>
)

export const ModalWrapper = ({ children, className }) => (
  <div
    styleName="modal-wrapper"
    className={`fixed z-50 bg-white p-16 rounded-md opacity-100 ${className || ''}`}
  >
    { children }
  </div>
)
