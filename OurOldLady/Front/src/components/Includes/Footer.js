// == Import : npm
import React from 'react';


// == Import : local
import { Link, Grid } from '@material-ui/core';
import { Link as RouterLink } from 'react-router-dom';
import './footer.scss';


// == Composant
const Footer = () => {
  const AccueilLink = React.forwardRef((props, ref) => <RouterLink to="/" innerRef={ref} {...props} />);
  const EvenementLink = React.forwardRef((props, ref) => <RouterLink to="/evenements" innerRef={ref} {...props} />);
  const WhoAreWeLink = React.forwardRef((props, ref) => <RouterLink to="/qui-sommes-nous" innerRef={ref} {...props} />);
  const ContactLink = React.forwardRef((props, ref) => <RouterLink to="/contact" innerRef={ref} {...props} />);
  const AccountLink = React.forwardRef((props, ref) => <RouterLink to="/" innerRef={ref} {...props} />);
  const LegalsMentionsLink = React.forwardRef((props, ref) => <RouterLink to="/mentions-legales" innerRef={ref} {...props} />);
  const cguLink = React.forwardRef((props, ref) => <RouterLink to="/conditions-generales-d-utilisation" innerRef={ref} {...props} />);
  const cgvLink = React.forwardRef((props, ref) => <RouterLink to="/conditions-generales-de-vente" innerRef={ref} {...props} />);
  
  return (
    <footer>
      <Grid container justify="space-between">
        <Grid item xs={12} lg={6}>
          <ul className="footer-top-ul-left">
            <li className="footer-top-ul-left-li"><Link component={LegalsMentionsLink} color="inherit">Mentions légales</Link></li>
            <li className="footer-top-ul-left-li"><Link component={cgvLink} color="inherit">Conditions générales de vente</Link></li>
            <li className="footer-top-ul-left-li"><Link component={cguLink} color="inherit">Conditions générales d'utilisation</Link></li>
          </ul>
        </Grid>
        <Grid item xs={12} lg={4}>
          <ul className="footer-top-ul-right">
            <li className="footer-top-ul-right-li"><Link component={AccueilLink} color="inherit">Accueil</Link></li>
            <li className="footer-top-ul-right-li"><Link component={EvenementLink} color="inherit">Evenement</Link></li>
            <li className="footer-top-ul-right-li"><Link component={WhoAreWeLink} color="inherit">Qui sommes nous ?</Link></li>
            <li className="footer-top-ul-right-li"><Link component={ContactLink} color="inherit">Contact</Link></li>
            <li className="footer-top-ul-right-li"><Link component={AccountLink} color="inherit">Compte</Link></li>
          </ul>
        </Grid>
      </Grid>
      <p>Copyright &copy; 2019 HAPPY APE - Tous droits réservés</p>
    </footer>
);
  }

// == Export
export default Footer;
