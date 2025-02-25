import React from 'react';
import Typography from '@material-ui/core/Typography';

import './errorDisplay.scss';

const Error404 = () => {
  return (
    <article className="display whitebox">
      <div className="error">Error 404</div>
      <Typography variant="h2">Oops!</Typography>
      <Typography variant="h3">Il semble que le contenu que vous demandez n'existe pas. </Typography>
      <Typography variant="h3">Nous vous invitons à revenir sur la page d'accueil ou choisir une page ci-dessus</Typography>
    </article>
  );
};

export default Error404;
