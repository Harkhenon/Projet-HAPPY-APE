import React from 'react';
import { Container, LinearProgress } from '@material-ui/core';
import Typography from '@material-ui/core/Typography';
import PropTypes from 'prop-types';
import ReactMarkdown from 'react-markdown';

class CGV extends React.Component {
  CGVData = null;

  componentWillMount() {
    const { setCGVData } = this.props;
    setCGVData();
  }

  render() {
    const { CGVData, loading } = this.props;

    if (!loading || CGVData !== undefined) {
      this.CGVData = (
        <Container className="mentions whitebox">
          {CGVData.map(item => (
            <div className="mentions-content" key={item.id}>
              <Typography variant="h1">{item.title}</Typography>
              <Typography variant="body1"><ReactMarkdown source={item.content} /></Typography>
            </div>
          ))
            }
        </Container>
      );
    }
    else {
      this.CGVData = <LinearProgress />;
    }

    return this.CGVData;
  }
}

export default CGV;

CGV.propTypes = {
  CGVData: PropTypes.array.isRequired,
  loading: PropTypes.bool.isRequired,
  setCGVData: PropTypes.func.isRequired,
};
