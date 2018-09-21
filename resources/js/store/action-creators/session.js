import axios from 'axios'

import { userActions } from 'store/actions'

let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
console.log("token: " + token);

axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest',
    'X-CSRF-TOKEN' : token
}

export const getCurrentUserInfo = () => (dispatch) => {
  return axios.get('/api/me')
    .then((response) => {
      dispatch({type: userActions.SET_CURRENT_USER_INFO, user: response.data})
      return response
    })
}

export const logIn = (loginDetails) => async (dispatch) => {
  const response = await axios.post('/api/login', loginDetails)
  dispatch({type: userActions.SET_CURRENT_USER_INFO, user: response.data})

  return response
}
