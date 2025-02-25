// == Import : npm
import React from 'react';
import PropTypes from 'prop-types';
import { LinearProgress, Grid } from '@material-ui/core';

// == Import : local


import Event from 'src/components/Event';


// == Composant
class Events extends React.Component {
  events = null;
  
  wait = null;

  componentDidMount() {
    const { getEventsForPage } = this.props;
    getEventsForPage();
  }

  render() {
    const { loading, events } = this.props;

    const eventsLoaded = events['hydra:member'];
    // console.log(eventsLoaded);


    if (!loading && eventsLoaded !== undefined) {
      if (eventsLoaded.length !== 0) {
        this.events = (
          <Grid container spacing={2} className="whitebox">
            {eventsLoaded.map(item => (
              <Grid item xs={12} sm={6} xl={6} lg={6} key={item.id}>
                <Event
                  title={item.title}
                  content={item.content_short}
                  date={item.date}
                  media={item.medium}
                  slug={item.slug}
                  button
                />
              </Grid>
            ))}
          </Grid>
        );
      }
      else {
        this.events = <p>Aucun évènement à afficher</p>;
      }
    }
    else {
      this.wait = (
        <div className="cpcenter">
          <LinearProgress color="secondary" />
        </div>
      );
    }

    return (!loading) ? this.events : this.wait;
  }
}

Events.propTypes = {
  getEventsForPage: PropTypes.func.isRequired,
  // events: PropTypes.array.isRequired,
  loading: PropTypes.bool.isRequired,
};

// == Export
export default Events;
