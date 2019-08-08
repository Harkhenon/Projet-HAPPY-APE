// == Import : npm
import React from 'react';
import {
  CardActions,
  CardContent,
  CardMedia,
  Typography,
  Card,
  Button,
  Grid,
} from '@material-ui/core';
import { Link } from 'react-router-dom';

// == Import : local

import './event.scss';

// import PropTypes from 'prop-types';


// == Composant
class Event extends React.Component {
  returnedValue = <h1 className="cpcenter">Aucun évènement à venir</h1>;

  componentWillMount() {
    const { item } = this.props;
    console.log(item);
    const itemDay = new Date(item[0].date).getDay();
    const week = ['dimanche', 'lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi']
    const day = week[itemDay];

    const itemMonth = new Date(item[0].date).getMonth();
    const year = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre']
    const month = year[itemMonth];

    const dayNumber = new Date(item[0].date).getUTCDate();
    const itemYear = new Date(item[0].date).getFullYear();
    const eventSlug = item[0].slug;


    if (item !== undefined) {
      this.returnedValue = (
        <article className="event whitebox">
          <Card >
            <CardMedia
              component="img"
              height='250'
              alt="soirée théatre avec les Ah!"    
              image="https://www.theatresparisiensassocies.com/user/img/1/710x0x1207-or.jpg"
              title="soirée théatre"
            />
            <CardContent>  
              <Grid container
                direction="row"
                justify="center"
                alignItems="flex-start">               
                
                <Grid item xs={12} sm={9} xl={10} lg={10}>
                  <Typography variant="h2">{item[0].name}</Typography>              
                </Grid>                          
                
                <Grid item xs={8} sm={3} xl={2} lg={2} className="event-calendar">        
                  <div className="newContentDay">{day}</div>
                  <div className="newContentNumber">{dayNumber}</div>
                  <div className="newContentMonth">{month}</div>
                  <div className="newContentYear">{itemYear}</div>                          
                </Grid>

                <Grid item xs={4} sm={4} xl={4} lg={4}>
                  <Link to={`/evenement/${eventSlug}`} style={{ textDecoration: 'none'}}>
                    <Button variant="contained" color="primary" >
                    Voir l'événement
                    </Button>
                  </Link>
                </Grid> 
              
              </Grid>              
            </CardContent>
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



