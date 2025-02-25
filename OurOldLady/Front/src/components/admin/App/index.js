// in src/App.js

import React, { Component } from 'react';
import { MuiThemeProvider } from '@material-ui/core/styles';
import theme from 'src/components/App/theme';
import { baseUrl, apiUrl } from 'src/utils/variables';
import './app.scss';

import { Admin, Resource } from 'react-admin';
// lien vers nos composants
import UserList from 'src/components/admin/Users/List';
import UserEdit from 'src/components/admin/Users/Edit';
import UserShow from 'src/components/admin/Users/Show';
import EventList from 'src/components/admin/Event/List';
import EventShow from 'src/components/admin/Event/Show';
import EventEdit from 'src/components/admin/Event/Edit';
import EventCreate from 'src/components/admin/Event/Create';
import NewsList from 'src/components/admin/News/List';
import NewsShow from 'src/components/admin/News/Show';
import NewsEdit from 'src/components/admin/News/Edit';
import NewsCreate from 'src/components/admin/News/Create';
import PageList from 'src/components/admin/Page/List';
import PageEdit from 'src/components/admin/Page/Edit';
import ContactList from 'src/components/admin/Contact/List';
import ContactShow from 'src/components/admin/Contact/Show';
import Dashboard from 'src/components/admin/Dashboard';
import PrivatePostList from 'src/components/admin/PrivatePost/List';
import PrivatePostShow from 'src/components/admin/PrivatePost/Show';
import PrivatePostEdit from 'src/components/admin/PrivatePost/Edit';
import PrivatePostCreate from 'src/components/admin/PrivatePost/Create';
import MediaList from 'src/components/admin/Media/List';
import MediaCreate from 'src/components/admin/Media/Create';
import MediaEdit from 'src/components/admin/Media/Edit';
import MediaShow from 'src/components/admin/Media/Show';

// Icons
import LocalPostOffice from '@material-ui/icons/LocalPostOffice';
import FormatIndentIncrease from '@material-ui/icons/FormatIndentIncrease';
import Announcement from '@material-ui/icons/Announcement';
import AddToHomeScreen from '@material-ui/icons/AddToHomeScreen';
import EventAvailable from '@material-ui/icons/EventAvailable';
import UserIcon from '@material-ui/icons/Group';
import Folder from '@material-ui/icons/Folder';

// reactadmin
import parseHydraDocumentation from '@api-platform/api-doc-parser/lib/hydra/parseHydraDocumentation';
import { hydraClient, fetchHydra as baseFetchHydra } from '@api-platform/admin';
import authProvider from 'src/components/admin/Utils/authProvider';
import { Redirect } from 'react-router-dom';
import { LinearProgress } from '@material-ui/core';
// import Layout from './Component/Layout';
// import dataProvider from 'src/components/admin/DataProvider';

const entrypoint = apiUrl;
const bearer = localStorage.getItem('userToken');
const fetchHeaders = { Authorization: `Bearer ${bearer}` };
const fetchHydra = (url, options = {}) => baseFetchHydra(url, {
  ...options,
  headers: new Headers(fetchHeaders),
});
const dataProvider = api => hydraClient(api, fetchHydra);
const apiDocumentationParser = entrypoint => parseHydraDocumentation(
  entrypoint,
  { headers: new Headers(fetchHeaders) },
)
  .then(
    ({ api }) => ({ api }),
    (result) => {
      switch (result.status) {
        case 401:
          return Promise.resolve({
            api: result.api,
            customRoutes: [{
              props: {
                path: baseUrl,
                render: () => {
                  window.location.replace('/login');
                },
              },
            }],
          });

        default:
          return Promise.reject(result);
      }
    },
  );

export default class extends Component {
    state = { api: null };

    componentDidMount() {
      apiDocumentationParser(entrypoint).then(({ api }) => {
        this.setState({ api });
      }).catch((e) => {
        console.log(e);
      });
    }

    render() {
      if (this.state.api === null) return <LinearProgress />;
      console.log(this.state.api);
      return (
        <MuiThemeProvider theme={theme}>
          <Admin api={ this.state.api }
            apiDocumentationParser={apiDocumentationParser}
            dataProvider= {dataProvider(this.state.api)}
            theme={theme} 
            dashboard={Dashboard}
            authProvider={authProvider}
          >
            <Resource name="events" options={{ label: 'Événements' }} list={EventList} edit={EventEdit} create={EventCreate} show={EventShow} icon={EventAvailable} />
            <Resource name="news" options={{ label: 'Actualités' }} list={NewsList} edit={NewsEdit} create={NewsCreate} show={NewsShow} icon={Announcement} />
            <Resource name="profile/users" options={{ label: 'Utilisateurs' }} list={UserList} edit={UserEdit} show={UserShow} icon={UserIcon} />
            <Resource name="pages" options={{ label: 'Pages' }} list={PageList} edit={PageEdit} icon={FormatIndentIncrease} />
            <Resource name="contacts" options={{ label: 'Contact' }} list={ContactList} show={ContactShow} icon={LocalPostOffice} />
            <Resource name="private_posts" options={{ label: 'Actu interne' }} list={PrivatePostList} edit={PrivatePostEdit} show={PrivatePostShow} create={PrivatePostCreate} icon={AddToHomeScreen} />
            <Resource name="media" options={{ label: 'media' }} list={MediaList} edit={MediaEdit} show={MediaShow} create={MediaCreate} icon={Folder} />
          </Admin>
        </MuiThemeProvider>
      );
    }
}
