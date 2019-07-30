// == Import : npm
import React from 'react';
import {
  CardActions,
  CardContent,
  CardMedia,
  Typography,
  Card,
  Button,
} from '@material-ui/core';

// == Import : local

import './event.scss';

// import PropTypes from 'prop-types';


// == Composant
class Event extends React.Component {
  returnedValue = <h1>Aucun évènement à venir</h1>;

  componentWillMount() {
    const { item } = this.props;

    if (item.id !== undefined) {
      this.returnedValue = (
        <article className="event">
          <Card>
            <CardMedia
              component="img"
              alt="soirée théatre avec les Ah!"
              height="140"
              image="https://www.theatresparisiensassocies.com/user/img/1/710x0x1207-or.jpg"
              title="soirée théatre"
            />
            <CardContent>
              <Typography gutterBottom variant="h4" component="h1">
                {item.name}
              </Typography>
              <Typography gutterBottom variant="body2" component="p">
                {item.date}
              </Typography>
              <Typography variant="body3" color="textSecondary" component="p">
                {item.content}
              </Typography>
            </CardContent>

            <CardActions className="event-cardAction">
              <Button className="event-button" variant="contained" color="primary">
              Voir l'événement
              </Button>
            </CardActions>
          </Card>
        </article>
      );
    }
  }

  render() {
    return this.returnedValue;
  }
}

// == Export
export default Event;

// Event.propTypes = {
//   item: PropTypes.array.isRequired,
// };



