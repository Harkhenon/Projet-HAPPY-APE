import React from 'react';
import { Container } from '@material-ui/core';
import Typography from '@material-ui/core/Typography';
import PropTypes from 'prop-types';
import ReactMarkdown from 'react-markdown';


import './legalMentions.scss';


class LegalMentions extends React.Component {
  componentWillMount() {
    const { setLegalMentionsData } = this.props;
    setLegalMentionsData();
  }

  render() {
    const { legalMentionsData } = this.props;

    return (
      <Container className="mentions whitebox">
        {legalMentionsData.map(item => (
          <div className="mentions-content" key={item.id}>
            <Typography variant="h1">{item.title}</Typography>
            <Typography variant="body1"><ReactMarkdown source={item.content} /></Typography>
          </div>
        ))
          }
      </Container>
    );
  }
}

export default LegalMentions;

LegalMentions.propTypes = {
  legalMentionsData: PropTypes.array.isRequired,
  setLegalMentionsData: PropTypes.func.isRequired,
};
