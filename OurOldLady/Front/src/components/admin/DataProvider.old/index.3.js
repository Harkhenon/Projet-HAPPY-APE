import { stringify } from 'query-string';
import {
  GET_LIST,
  GET_ONE,
  CREATE,
  UPDATE,
  DELETE,
  GET_MANY,
  GET_MANY_REFERENCE,
} from 'react-admin';

const apiUrl = 'https://back.isodev.ovh';

/**
 * Maps react-admin queries to my REST API
 *
 * @param {string} type Request type, e.g GET_LIST
 * @param {string} resource Resource name, e.g. "posts"
 * @param {Object} payload Request parameters. Depends on the request type
 * @returns {Promise} the Promise for a data response
 */
export default (type, resource, params) => {
  let url = '';
  const options = {
    headers: new Headers({
      Accept: 'application/json',
    }),
  };
  switch (type) {
    case GET_LIST: {
      url = `${apiUrl}/${resource}`;
      break;
    }
    default:
      throw new Error(`Unsupported Data Provider request type ${type}`);
  }

  let headers;
  return fetch(url, options)
    .then((res) => {
      headers = res.headers;
      return res.json();
    })
    .then((json) => {
      switch (type) {
        case GET_LIST:
          if (!headers.has('content-range')) {
            throw new Error(
              'The Content-Range header is missing in the HTTP Response. The simple REST data provider expects responses for lists of resources to contain this header with the total number of results to build the pagination. If you are using CORS, did you declare Content-Range in the Access-Control-Expose-Headers header?',
            );
          }
          return {
            data: json,
            total: parseInt(
              headers
                .get('content-range')
                .split('/')
                .pop(),
              10,
            ),
          };
        default:
          return { data: json };
      }
    });
};
