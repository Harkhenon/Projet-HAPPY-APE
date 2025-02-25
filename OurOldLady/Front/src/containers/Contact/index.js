// == Import : npm
import { connect } from 'react-redux';

// == Import : local
import Contact from 'src/components/Contact';
import { changeContactInput, sendContactForm } from 'src/store/reducer';


/* === State (données) ===
 * - mapStateToProps retroune un objet de props pour le composant de présentation
 * - mapStateToProps met à dispo 2 params
 *  - state : le state du store (getState)
 *  - ownProps : les props passées au container
 * Pas de data à transmettre ? const mapStateToProps = null;
 */
const mapStateToProps = (state, ownProps) => ({
  contactName: state.contactName,
  contactFirstname: state.contactFirstname,
  contactEmail: state.contactEmail,
  contactMessage: state.contactMessage,
});

/* === Actions ===
 * - mapDispatchToProps retroune un objet de props pour le composant de présentation
 * - mapDispatchToProps met à dispo 2 params
 *  - dispatch : la fonction du store pour dispatcher une action
 *  - ownProps : les props passées au container
 * Pas de disptach à transmettre ? const mapDispatchToProps = {};
 */
const mapDispatchToProps = (dispatch, ownProps) => ({
  changeContactInputValue: (name, value) => {dispatch(changeContactInput(name, value))},
  getSendContactForm: (contactData) => {dispatch(sendContactForm(contactData))},
});


// const mapDispatchToProps = dispatch => ({
//   // en clé : le nom de la prop
//   // en valeur : la fonction
//   // cette fonction peut eventuellement gérer des paramètres
//   // on donner une valeur à ces paramètres en executant la fonction
//   // dans le composant et en lui transmettant des arguments
//   changeInputValue: (newInputValue) => {
//     dispatch(changeInput(newInputValue));
//   },

// Container
const ContactContainer = connect(
  mapStateToProps,
  mapDispatchToProps,
)(Contact);

// == Export
export default ContactContainer;

/* = export à la volée
export default connect(
  mapStateToProps,
  mapDispatchToProps,
)(Example);
*/
