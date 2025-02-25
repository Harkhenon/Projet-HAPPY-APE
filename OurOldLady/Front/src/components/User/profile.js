import React from 'react';
import ReactMarkdown from 'react-markdown/with-html';
import PropTypes from 'prop-types';
import AppBar from '@material-ui/core/AppBar';
import Tabs from '@material-ui/core/Tabs';
import Tab from '@material-ui/core/Tab';
import Typography from '@material-ui/core/Typography';
import Box from '@material-ui/core/Box';
import ListItem from '@material-ui/core/ListItem';
import ListItemText from '@material-ui/core/ListItemText';
import Divider from '@material-ui/core/Divider';
import PhotoGallery from 'src/components/User/PhotoGallery';
import dateParser from 'src/utils/dateParser';
import Button from '@material-ui/core/Button';



import './profile.scss';
import { TextField } from '@material-ui/core';

function TabPanel(props) {
  const {
    children, value, index, ...other
  } = props;

  return (
    <Typography
      component="div"
      role="tabpanel"
      hidden={value !== index}
      id={`scrollable-auto-tabpanel-${index}`}
      aria-labelledby={`scrollable-auto-tab-${index}`}
      {...other}
    >
      <Box p={3}>{children}</Box>
    </Typography>
  );
}

TabPanel.propTypes = {
  children: PropTypes.node,
  index: PropTypes.any.isRequired,
  value: PropTypes.any.isRequired,
};

function a11yProps(index) {
  return {
    id: `scrollable-auto-tab-${index}`,
    'aria-controls': `scrollable-auto-tabpanel-${index}`,
  };
}


class Profile extends React.Component {
  state = { value: 0 }

  privatePostProfile = null;

  componentWillMount() {
    const { setPrivatePosts, setUserLoaded } = this.props;
    setPrivatePosts();
    setUserLoaded(localStorage.getItem('userId'));
  }
  
  handleChange = (event, newValue) => {
    this.setState({ value: newValue });
  }

  render() {


    const { loading, privatePost, userLoaded } = this.props;
    const privatePostLoaded = privatePost;
    console.log (userLoaded);


    if (!loading && privatePostLoaded !== undefined) {
      if (privatePostLoaded.length !== 0) {

        this.privatePostProfile = (
          <div>
            {privatePostLoaded.map(item => (
              <ListItem alignItems="flex-start" key={item.id}>
                <ListItemText
                  primary={(
                    <React.Fragment>
                      <Typography variant="h2">{item.title}
                      </Typography>
                    </React.Fragment>
                  )}
                  secondary={(
                    <React.Fragment>
                      <Typography variant="h4">publié le {dateParser(item.createdAt).dayNumber} {dateParser(item.createdAt).day} {dateParser(item.createdAt).month} {dateParser(item.createdAt).itemYear}</Typography>
                      <Typography component="span" variant="body2" color="textPrimary">
                        <ReactMarkdown source={item.content} escapeHtml={false} />
                      </Typography>
                    </React.Fragment>
                  )}
                />
                <Divider variant="inset" />
              </ListItem>
            ))}
          </div>
        );
        if (!loading && userLoaded !== undefined) {
          this.userBlock = (
            <form noValidate autoComplete="off">
              <ul>
                <li>
                  <TextField
                    id="user.lastname"
                    label="Mon Nom"
                    value={userLoaded.lastname}
                  />
                </li>
                <li>
                  <TextField
                    id="user.firstname"
                    label="Mon Prénom"
                    value={userLoaded.firstname}
                  />
                </li>
                <li>
                  <TextField
                    id="user.email"
                    label="Mon E-mail"
                    value={userLoaded.email}
                  />
                </li>
                <li>
                  <TextField
                    id="user.addressNumber"
                    label="Mon numéro de rue"
                    value={userLoaded.addressNumber}
                  />
                </li>
                <li>
                  <TextField
                    id="user.addressStreet"
                    label="Ma rue"
                    value={userLoaded.addressStreet}
                  />
                </li>
                <li>
                  <TextField
                    id="user.addressZipcode"
                    label="Mon code postal"
                    value={userLoaded.addressZipcode}
                  />
                </li>
                <li>
                  <TextField
                    id="user.addressCity"
                    label="Mon village"
                    value={userLoaded.addressCity}
                  />
                </li>
                <li>Je suis parent d'élève: {userLoaded.isParent ? 'Oui' : 'Non'}</li>              
              </ul>
              <Button variant="contained" color="primary" type="submit">
                    Envoyer les données
                </Button>
            </form>
          );
        }
      }
      else {
        this.privatePostProfile = <p>Aucune actualité interne</p>;
      }
    }


    return (
      <div className="profile">
        <AppBar position="static">
          <Tabs value={this.state.value} variant="scrollable" onChange={this.handleChange} aria-label="scrollable auto tabs example">
            <Tab label="Mes informations" {...a11yProps(0)} />
            <Tab label="Mes messages" {...a11yProps(1)} />
            <Tab label="Mes fichiers" {...a11yProps(2)} />
            <Tab label="Mes photos" {...a11yProps(3)} />
            <Tab label="Organisation" {...a11yProps(4)} />
            <Tab label="Agenda" {...a11yProps(5)} />
          </Tabs>
        </AppBar>
        <TabPanel value={this.state.value} index={0}>

          <Typography variant="h1">Mes informations personnelles</Typography>
          <Typography  variant="h3">Pour faciliter nos échanges merci de bien vouloir compléter et/ou mettre à jour vos informations</Typography> 
            {this.userBlock}
        </TabPanel>
        <TabPanel value={this.state.value} index={1}> 
          <Typography variant="h1">Messages de l'association</Typography>  
          <Typography  variant="h3">Ci-dessous les actualités de l'association </Typography>        
          {this.privatePostProfile}                
        </TabPanel>

        <TabPanel value={this.state.value} index={2}>
          <Typography variant="h1">Fichiers disponibles</Typography>
          <Typography  variant="h3">Vous trouverez ci-après l'ensemble des documents de l'association</Typography> 
          <div className="profile_pdf">                
            <a href="https://static.isodev.ovh/file/cotisation.pdf"><img className="profile_pdf_image" src="https://www.obesity.org/wp-content/uploads/2019/02/pdf-png.png" alt="pdf"/></a>
            <Typography variant="h4">Le document d'inscription à nous rendre début octobre</Typography>   
          </div>         
          <Divider /> 
          <div className="profile_pdf">                
            <a href="https://static.isodev.ovh/file/commande.pdf"><img className="profile_pdf_image" src="https://www.obesity.org/wp-content/uploads/2019/02/pdf-png.png" alt="pdf"/></a>
            <Typography variant="h4">le bon de commande pour les pizzas !</Typography>   
          </div>         
          <Divider />  
          <div className="profile_pdf">                
            <a href="https://static.isodev.ovh/file/compte_rendu.pdf"><img className="profile_pdf_image" src="https://www.obesity.org/wp-content/uploads/2019/02/pdf-png.png" alt="pdf"/></a>
            <Typography variant="h4">le compte rendu de la réunion de préparation pour la fête de la bière</Typography>   
          </div>         
          <Divider />          
        </TabPanel>
        <TabPanel value={this.state.value} index={3}>
          <Typography variant="h1">Les photos de l'association</Typography>    
          <Typography  variant="h3">Nous tâcherons de mettre en ligne les photos de nos événements et des activités des enfants</Typography> 
          <PhotoGallery />
        </TabPanel>
        <TabPanel value={this.state.value} index={4}> 
          <Typography variant="h1">Organisation</Typography>  
          <img className="profile_image" src="https://zapier.cachefly.net/storage/photos/7721e27283c9407abefd7e26e1d62e4e.png" alt="pdf"/>              
        </TabPanel>
        <TabPanel value={this.state.value} index={5}> 
          <Typography variant="h1">Agenda</Typography>  
          <img className="profile_image" src="https://i.kinja-img.com/gawker-media/image/upload/s--QRR82X5p--/c_fit,f_auto,fl_progressive,q_80,w_636/intmvaiybdkuzjo1dros.png" alt="pdf"/>              
        </TabPanel>
      </div>
    );
  }
}

export default Profile;
