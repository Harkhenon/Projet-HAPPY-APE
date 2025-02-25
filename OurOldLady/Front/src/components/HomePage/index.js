import React from 'react';
import Event from 'src/components/Event';
import Slider from 'src/utils/Carousel';
import New from 'src/components/New';
import {
  Divider,
  LinearProgress,
  Grid,
  Typography,
} from '@material-ui/core';
import PropTypes from 'prop-types';
import './homepage.scss';
import { Link } from 'react-router-dom';

class HomePage extends React.Component {
  event = {};

  componentWillMount() {
    const { setHomepageData } = this.props;
    setHomepageData();
  }

  render() {
    const { homepageData, loading } = this.props;

    if (!loading && homepageData !== undefined) {
      document.title = homepageData.title;
      if (homepageData.nextEvent !== undefined) {
        this.event = homepageData.nextEvent.map(item => (
          <div>
            <div className="homepage-nextevent">PROCHAIN EVENEMENT</div>      
            <Event
              key={item.id}
              title={item.title}
              content={item.content_short}
              date={item.date}
              media={item.medium}
              slug={item.slug}
              button
            />
          </div>
        ));
        
      }
      else {
        this.event = (
          <div className="center event whitebox">
            <p>Aucun évènement à afficher</p>
          </div>
        );
      }

      if (homepageData.news !== undefined) {
        this.news = (
          <React.Fragment>
            <Grid
              container
              direction="row"
              justify="flex-start"
              alignItems="flex-start"
            >
              {homepageData.news.map(item => (
                <Grid item xs={12} sm={12} xl={12} lg={12} key={item.id} className="whitebox">
                  <Link to={`/actualites/${item.slug}`} style={{ textDecoration: 'none', color: '#000000' }}>
                    <New
                      key={item.id}
                      id={item.id}
                      title={item.title}
                      content={item.content_short}
                      createdAt={item.createdAt}
                      author={item.author}
                      media={item.medium}
                    />
                  </Link>
                  <Divider />
                </Grid>
              ))}
            </Grid>
          </React.Fragment>
        );
      }
      else {
        this.news = (
          <div className="center event">
            <p>Aucune actualité à afficher</p>
          </div>
        );
      }
    }
    else {
      document.title = 'Chargement...';
    }
    return (
      <React.Fragment>
        <Grid
          container
          className="whitebox"
          direction="row"
          justify="center"
          alignItems="center"
          spacing={2}
        >
          <Grid item xs={12} sm={12} xl={12} lg={12}>
            <Slider />
          </Grid>
          <Grid item xs={12} sm={8} xl={8} lg={8} className="whitebox">
            <Typography variant="h2" align="center">Bienvenue !</Typography>
            <Typography variant="body1">"Bienvenue sur le site de l'association de parents d'élèves Happy APE. Nous sommes une équipe de parents d'élèves bénévoles, et nous mettons en place des actions, des événements pour financer les activités de nos enfants. 
            Vous trouverez l'ensemble de nos actions sur ce site !"</Typography> 
          </Grid>
          <Divider />
          <Grid align="center" item xs={12} sm={6} xl={6} lg={6} className="event">
            {!loading ? this.event : (
              <div className="cpcenter">
                <LinearProgress color="secondary" />
              </div>
            )
            }
          </Grid>
          <Divider />
          <Grid item xs={12} sm={12} xl={12} lg={12}>
            <Typography variant="h1">Nos dernières actualités</Typography>
            {!loading ? this.news : (
              <div className="cpcenter">
                <LinearProgress color="secondary" />
              </div>
            ) }
          </Grid>
          <Divider />
        </Grid>
      </React.Fragment>
    );
  }
}

export default HomePage;

HomePage.propTypes = {
  setHomepageData: PropTypes.func.isRequired,
  homepageData: PropTypes.object.isRequired,
  loading: PropTypes.bool.isRequired,
};
