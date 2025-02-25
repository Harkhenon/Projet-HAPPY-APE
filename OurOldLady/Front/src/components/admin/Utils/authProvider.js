import {
  AUTH_LOGIN,
  AUTH_LOGOUT,
  AUTH_ERROR,
  AUTH_CHECK,
} from 'react-admin';

export default (type, params) => {
  // called when the user attempts to log in
  if (type === AUTH_LOGIN) {
    const { username, password } = params;
    const request = new Request('https://back.isodev.ovh/api/login_check', {
      method: 'POST',
      body: JSON.stringify({ email: username, password }),
      headers: new Headers({ 'Content-Type': 'application/json' }),
    });

    return fetch(request)
      .then(response => {
        if (response.status < 200 || response.status >= 300) throw new Error(response.statusText);

        return response.json();
      })
      .then(({ token }) => {
        localStorage.setItem('userToken', token); // The JWT token is stored in the browser's local storage
        window.location.replace('/');
      });
  }
  // called when the user clicks on the logout button
  if (type === AUTH_LOGOUT) {
    localStorage.removeItem('username');
    return Promise.resolve();
  }
  // called when the API returns an error
  if (type === AUTH_ERROR) {
    const { status } = params;
    if (status === 401 || status === 403) {
      localStorage.removeItem('username');
      return Promise.reject();
    }
    return Promise.resolve();
  }
  // called when the user navigates to a new location
  if (type === AUTH_CHECK) {
    return localStorage.getItem('userToken')
      ? Promise.resolve()
      : Promise.reject();
  }
  return Promise.reject('Unknown method');
};
