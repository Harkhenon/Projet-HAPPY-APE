
import { createMuiTheme } from '@material-ui/core/styles';

const generalTheme = createMuiTheme({
  palette: {
    primary: { main: '#2ab7ca' },
    secondary: { main: '#ffc43d' },
  },
  overrides: {
    MuiMenuItem: {
      root: {
        // color: 'white',
        // backgroundColor: '#000000',
      },
    },
    MuiButton: {
      root: {
        margin: '1em',
        fontSize: '1em',
        fontFamily: 'Raleway',
        fontWeight: 'bold',
      },
    },
    MuiInputBase: {
      focus: {
        backgroundColor: 'none',
      },
    },
  },  
  typography: {
    underline: 'none',
    h1: {
      fontFamily: 'Raleway',
      color: '#FF732D',
      fontSize: '1.8rem',
      paddingTop: 20,
      marginBottom: 20,
      fontWeight: 'bold',
      textAlign: 'left',
      borderBottom: '1px solid #FF732D'
    },

    h2: {
      fontFamily: 'Raleway',
      fontSize: '1.5em',
      fontWeight: 'bolder',
      paddingTop: 5,
      marginBottom: 0,
      textTransform: 'upperCase',
    },
    h3: {
      fontFamily: 'Raleway',
      fontSize: '0.9rem',
      fontWeight: 'bold',
      paddingBottom: '1em',
    },

    h4: {
      fontSize: 13,
      paddingBottom: '1em',
    },
    body1: {
      fontFamily: 'Raleway',
      fontSize: '1em',
      lineHeight: 1.5,
    },
    body2: {
      fontFamily: 'Raleway',
      fontSize: 18,
    },
  },
});

export default generalTheme;
