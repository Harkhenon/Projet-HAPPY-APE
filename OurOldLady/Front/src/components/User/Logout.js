import React from 'react';
import './user.scss';
import { LinearProgress } from '@material-ui/core';

class Logout extends React.Component {
  isLoggedIn = localStorage.getItem('isLoggedIn');

  render() {

    if (localStorage.getItem('isLoggedIn') !== null) {
      localStorage.removeItem('isLoggedIn');
    }

    if (localStorage.getItem('userToken') !== null) {
      localStorage.removeItem('userToken');
    }

    if (localStorage.getItem('userId') !== null) {
      localStorage.removeItem('userId');
    }

    window.location.replace('/');

    return (
      <LinearProgress />
    );
  }
}

export default Logout;
