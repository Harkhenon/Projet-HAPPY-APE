import React from 'react';
import './header.scss';

const Header = children => (
  <header className="header-top">
    <img src="https://static.isodev.ovh/img/HAPPY_APE3.png" alt="img-logo-asso" center="true"/>
    {children.children}
  </header>
);

export default Header;
