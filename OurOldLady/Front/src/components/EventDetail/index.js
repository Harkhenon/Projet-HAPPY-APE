// == Import : npm
import React from 'react';
import { LinearProgress } from '@material-ui/core';
import PropTypes from 'prop-types';
import Event from 'src/components/Event';

// == Import : local

import './eventDetail.scss';


// == Composant
class EventDetail extends React.Component {
  actualEvent = null;

  eventLoaded = (
    <div className="cpcenter">
      <LinearProgress color="secondary" />
    </div>
  );

  componentWillMount() {
    const { getEventsForPage } = this.props;
    getEventsForPage();
  }

  render() {
    const { events, slug, loading } = this.props;

    if (events !== undefined && events['hydra:member'].length !== 0) {
      this.actualEvent = events['hydra:member'].find(item => item.slug === slug);
      if (this.actualEvent !== null) {
        this.eventLoaded = (
          <Event
            title={this.actualEvent.title}
            content={this.actualEvent.content}
            date={this.actualEvent.date}
            media={this.actualEvent.medium}
            slug={this.actualEvent.slug}
            button={false}
          />
        );
      }
      else {
        this.eventLoaded = <LinearProgress />;
      }
    }


    return (!loading) ? this.eventLoaded : this.eventLoaded;
  }
}

EventDetail.propTypes = {
  getEventsForPage: PropTypes.func.isRequired,
  loading: PropTypes.bool.isRequired,
  events: PropTypes.object,
  slug: PropTypes.string.isRequired,
};
// == Export
export default EventDetail;
