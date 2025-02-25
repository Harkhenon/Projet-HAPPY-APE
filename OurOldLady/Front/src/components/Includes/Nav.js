// == Import : npm
import React from 'react';
import PropTypes from 'prop-types';

// == Import : local
import {
  Drawer,
  MenuItem,
  Button,
  Link,
  Typography,
  Menu,
  Select,
} from '@material-ui/core';
// import { Link as RouterLink } from 'react-router-dom';
import {
  Home,
  Event,
  ContactSupport,
  Contacts,
  AccountCircle,
} from '@material-ui/icons';

import PopupState, { bindTrigger, bindMenu } from 'material-ui-popup-state';

import { Link as NavLink } from 'react-router-dom';

import './nav.scss';


// == Composant
const NavBar = ({ drawerOpen, toggleDrawerAction }) => {


  const isLoggedIn = localStorage.getItem('isLoggedIn');

  const AccueilLink = React.forwardRef((props, ref) => <NavLink to="/" innerRef={ref} {...props} />);
  const EvenementLink = React.forwardRef((props, ref) => <NavLink to="/evenements" innerRef={ref} {...props} />);
  const WhoAreWeLink = React.forwardRef((props, ref) => <NavLink to="/qui-sommes-nous" innerRef={ref} {...props} />);
  const ContactLink = React.forwardRef((props, ref) => <NavLink to="/contact" innerRef={ref} {...props} />);
  const AccountLink = React.forwardRef((props, ref) => <NavLink to="/" innerRef={ref} {...props} />);
  const AdminAppLink = React.forwardRef((props, ref) => <NavLink to="/admin/Dashboard" innerRef={ref} {...props} />);
  const UserProfileLink = React.forwardRef((props, ref) => <NavLink to="/profil" innerRef={ref} {...props} />);
  const LoginLink = React.forwardRef((props, ref) => <NavLink to="/login" innerRef={ref} {...props} />);
  const RegisterLink = React.forwardRef((props, ref) => <NavLink to="/signup" innerRef={ref} {...props} />);
  const LogoutLink = React.forwardRef((props, ref) => <NavLink to="/logout" innerRef={ref} {...props} />);

  const toggleDrawerButton = event => {
    if (event.type === 'keydown' && (event.key === 'Tab' || event.key === 'Shift')) {
      return;
    }
    toggleDrawerAction();
  };

  return (
    <div>
      <div className="mobile">
        <Button onClick={toggleDrawerButton}>
          Menu
        </Button>
      </div>
      <Typography className="navBar">
        <MenuItem component={AccueilLink} to="/">Accueil</MenuItem>
        <MenuItem component={EvenementLink} to="/evenements">Evenement</MenuItem>
        <MenuItem component={WhoAreWeLink} to="/qui-sommes-nous">Qui sommes-nous ?</MenuItem>
        <MenuItem component={ContactLink} to="/contact">Contact</MenuItem>
        {(isLoggedIn === null) ? (
          <PopupState variant="popover" popupId="demo-popup-menu">
            {popupState => (
              <React.Fragment>
                <Button color="primary" {...bindTrigger(popupState)}>
                  Compte
                </Button>
                <Menu {...bindMenu(popupState)}>
                  <MenuItem component={LoginLink} to="/login">Se connecter</MenuItem>
                  <MenuItem component={RegisterLink} to="/signup">Créer un compte</MenuItem>
                </Menu>
              </React.Fragment>
            )}
          </PopupState>
        ) : (
          <PopupState variant="popover" popupId="demo-popup-menu">
            {popupState => (
              <React.Fragment>
                <Button color="primary" {...bindTrigger(popupState)}>
                  Compte
                </Button>
                <Menu {...bindMenu(popupState)}>
                  <MenuItem component={UserProfileLink} to="/profile">Accéder à mon compte</MenuItem>
                  <MenuItem component={LogoutLink} to="/logout">Se déconnecter</MenuItem>
                </Menu>
              </React.Fragment>
            )}
          </PopupState>
        )}

        {(isLoggedIn === null) ? ("") : (<MenuItem component={AdminAppLink} to="/admin/Dashboard">Administration</MenuItem>)}

      </Typography>
      <Drawer open={drawerOpen} onClose={toggleDrawerButton}>
        <MenuItem onClick={toggleDrawerButton} component={AccueilLink} to="/"><Home />Accueil</MenuItem>
        <MenuItem onClick={toggleDrawerButton} component={EvenementLink} to="/evenements"><Event />Evenement</MenuItem>
        <MenuItem onClick={toggleDrawerButton} component={WhoAreWeLink} to="/qui-sommes-nous"><ContactSupport />Qui sommes-nous ?</MenuItem>
        <MenuItem onClick={toggleDrawerButton} component={ContactLink} to="/contact"><Contacts />Contact</MenuItem>
        <MenuItem onClick={toggleDrawerButton} component={AccountLink} to="/"><AccountCircle />Compte</MenuItem>
        <MenuItem onClick={toggleDrawerButton} component={AdminAppLink} to="/admin/Dashboard">Dashboard</MenuItem>
      </Drawer>
    </div>
  )
};

// == Export
export default NavBar;


NavBar.propTypes = {
  drawerOpen: PropTypes.bool.isRequired,
  toggleDrawerAction: PropTypes.func.isRequired,
};
