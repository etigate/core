/*
 * This file is part of Glugox.
 *
 * (c) Glugox <glugox@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
import { createContext } from 'react'

export const { Provider: ModalProvider, Consumer: ModalConsumer } = createContext({
  component: () => <div>No modal component supplied</div>,
  modalProps: {},
  showModal: () => undefined,
  hideModal: () => undefined
})