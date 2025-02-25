import React from 'react';
import { Container, LinearProgress } from '@material-ui/core';
import PropTypes from 'prop-types';
import Typography from '@material-ui/core/Typography';
import './cgu.scss';
import ReactMarkdown from 'react-markdown';

class CGU extends React.Component {
  CGUData = null;

  componentWillMount() {
    const { setCGUData } = this.props;
    setCGUData();
  }

  render() {
    const { CGUData, loading } = this.props;

    if (!loading || CGUData !== undefined) {
      this.CGUData = (
        <Container className="whitebox">
          {CGUData.map(item => (
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
      this.CGUData = <LinearProgress />;
    }

    return this.CGUData;
  }
}

export default CGU;

CGU.propTypes = {
  CGUData: PropTypes.array.isRequired,
  loading: PropTypes.bool.isRequired,
  setCGUData: PropTypes.func.isRequired,
};
