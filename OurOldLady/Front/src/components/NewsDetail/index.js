// == Import : npm
import React from 'react';
import { Grid, CircularProgress  } from '@material-ui/core';
import Typography from '@material-ui/core/Typography';
import PropTypes from 'prop-types';
import dateParser from 'src/utils/dateParser';
import CardMedia from '@material-ui/core/CardMedia';

// == Import : local
import './newsDetails.scss';

// == Composant
class NewsDetail extends React.Component {

  actualNews = null;

  newsLoaded = (
    <div className="cpcenter">
      <CircularProgress />
    </div>
  );

  componentWillMount() {
    const { setHomepageData } = this.props;
    setHomepageData();
  }

  render() {
    const { homepageData, slug, loading } = this.props;

    if (homepageData !== undefined) {
      this.actualNews = homepageData.news.find(actu => actu.slug === slug);
      if (this.actualNews !== null) {
        const NewsImage = (this.actualNews.medium !== null) ? this.actualNews.medium.url : null;

        this.newsLoaded = (
          <React.Fragment>
            <Grid
              container
              className="whitebox"
              direction="row"
              justify="center"
              alignItems="flex-start"
            >
              <Grid item xs={12} sm={12} xl={12} lg={12} >            
                <Typography variant="h2">{this.actualNews.title}</Typography>
                <Typography variant="h4">publié le {dateParser(this.actualNews.createdAt).day} {dateParser(this.actualNews.createdAt).dayNumber} {dateParser(this.actualNews.createdAt).month} {dateParser(this.actualNews.createdAt).itemYear}</Typography>        
                {NewsImage !== null && <img src={NewsImage} alt="" className="newsImage" />}          
                <Typography variant="body2" dangerouslySetInnerHTML={{ __html: this.actualNews.content }} />                           
              </Grid>
            </Grid>
          </React.Fragment>
        );
      }
    }
    return (!loading) ? this.newsLoaded : this.newsLoaded;
  }
}


NewsDetail.propTypes = {

  slug: PropTypes.string.isRequired,
  setHomepageData: PropTypes.func.isRequired,
  loading: PropTypes.bool.isRequired,
};


// == Export
export default NewsDetail;
