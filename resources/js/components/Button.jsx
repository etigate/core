/*
 * This file is part of Glugox.
 *
 * (c) Glugox <glugox@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
import React from 'react'

const baseButtonStyles = 'btn btn-block btn-flat'

export const NeutralButton = (props) => (
  <button
    {...props}
    className={`${baseButtonStyles} btn-primary  ${props.className || ''}`}>
    {props.children}
  </button>
)

export const NegativeButton = (props) => (
  <button
    {...props}
    className={`${baseButtonStyles} btn-danger ${props.className || ''}`}>
    {props.children}
  </button>
)

export const PositiveButton = (props) => (
  <button
    {...props}
    className={`${baseButtonStyles} btn-success ${props.className || ''}`}>
    {props.children}
  </button>
)
