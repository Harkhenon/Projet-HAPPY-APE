// == Import : npm
import { createStore, compose, applyMiddleware } from 'redux';
import axiosMiddleware from 'redux-axios-middleware';
import axios from 'axios';

// == Import : local
import reducer from 'src/store/reducer';

// == Store
const composeEnhancers = window.__REDUX_DEVTOOLS_EXTENSION_COMPOSE__ || compose;

// all axios can be used, shown in axios documentation
const client = axios.create({
  baseURL: 'https://back.isodev.ovh',
  responseType: 'json',
  headers: {
    'Content-Type': 'application/ld+json; charset=utf-8',
  },
});

const enhancers = composeEnhancers(
  applyMiddleware(
    axiosMiddleware(client),
  ),
);

const store = createStore(
  reducer,
  enhancers,
);

// == Export
export default store;
