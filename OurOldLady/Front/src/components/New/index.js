import React from 'react';
import Grid from '@material-ui/core/Grid';
import Typography from '@material-ui/core/Typography';
import './new.scss';
import dateParser from 'src/utils/dateParser';
import PropTypes from 'prop-types';

class New extends React.Component {
  render() {
    const { title, content, createdAt } = this.props;
    const date = dateParser(createdAt);

    this.returnedValue = (
      <React.Fragment>
        <Grid
          container
          direction="row"
          justify="center"
          alignItems="flex-start"
          className="news-content"
        >
          <Grid item xs={12} sm={12} xl={12} lg={12} className="newContent">
            <Typography variant="h2">{title}</Typography>
            <Typography variant="body2" dangerouslySetInnerHTML={{ __html: content }} />
            <Typography variant="h4">publié le {date.dayNumber} {date.day} {date.month} {date.itemYear}</Typography>
          </Grid>
        </Grid>
      </React.Fragment>
    );

    return this.returnedValue;
  }
}

// == Export
export default New;

New.propTypes = {
  title: PropTypes.string.isRequired,
  content: PropTypes.string.isRequired,
  createdAt: PropTypes.string.isRequired,
};
