// == Import : npm
import React from 'react';
import {
  CardMedia,
  Typography,
  Button,
  Grid,
} from '@material-ui/core';
import { Link } from 'react-router-dom';
import PropTypes from 'prop-types';
import dateParser from 'src/utils/dateParser';

// == Import : local

import './event.scss';

// == Composant
class Event extends React.Component {
  returnedValue = <h1 className="cpcenter">Aucun évènement à venir</h1>;

  render() {
    const {
      title,
      content,
      date,
      media,
      slug,
      button,
    } = this.props;

    const image = (media !== null && media !== undefined) ? media.url : 'https://static.isodev.ovh/img/lecture.jpg';

    const dateParsed = dateParser(date);

    this.returnedValue = (
      <Grid
        container
        className="whitebox"
        direction="row"
        justify="space-around"
      >
        <Grid item xs={12} sm={12} xl={4} lg={4}>
          <CardMedia
            component="img"
            alt="event-image"
            justify="space-between"
            image={image}
            title={title}
          />
        </Grid>
        <Grid align="center" item xs={12} sm={12} xl={6} lg={6}>
          <Typography variant="h2">{title}</Typography>
          {button !== true && (
            <div className="resaEvent">
              <Typography align="left" variant="body2" dangerouslySetInnerHTML={{ __html: content }} />            
              <Button a href="https://static.isodev.ovh/file/commande.pdf" variant="contained" color="primary">
              Je souhaite réserver !
              </Button>              
            </div> 
          )}
          <div className="event-calendar">
            <div className="newContentDay">{dateParsed.day}</div>
            <div className="newContentNumber">{dateParsed.dayNumber}</div>
            <div className="newContentMonth">{dateParsed.month}</div>
            <div className="newContentYear">{dateParsed.itemYear}</div>
          </div>              
        </Grid>
        {button === true && (
          <Grid align="center" item xs={12} sm={12} xl={6} lg={6} >
            <Link to={`/evenement/${slug}`} style={{ textDecoration: 'none' }}>
              <Button variant="contained" color="primary">
              Voir l'événement
              </Button>
              
            </Link>
          </Grid>
        )}
      </Grid>
    );

    return this.returnedValue;
  }
}

// == Export
export default Event;

Event.propTypes = {
  title: PropTypes.string.isRequired,
  content: PropTypes.string,
  date: PropTypes.string.isRequired,
  slug: PropTypes.string.isRequired,
  button: PropTypes.bool.isRequired,
};
