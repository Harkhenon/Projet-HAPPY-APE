// == Import : npm
import { connect } from 'react-redux';

// == Import : local
import EventDetail from 'src/components/EventDetail';
import { getEvents } from 'src/store/reducer';



/* === State (données) ===
 * - mapStateToProps retroune un objet de props pour le composant de présentation
 * - mapStateToProps met à dispo 2 params
 *  - state : le state du store (getState)
 *  - ownProps : les props passées au container
 * Pas de data à transmettre ? const mapStateToProps = null;
 */
const mapStateToProps = (state, ownProps) => ({
  events: state.events,
  loading: state.loading,
});

/* === Actions ===
 * - mapDispatchToProps retroune un objet de props pour le composant de présentation
 * - mapDispatchToProps met à dispo 2 params
 *  - dispatch : la fonction du store pour dispatcher une action
 *  - ownProps : les props passées au container
 * Pas de disptach à transmettre ? const mapDispatchToProps = {};
 */
const mapDispatchToProps = (dispatch, ownProps) => ({
  getEventsForPage: () => (dispatch(getEvents())),
});

// Container
const EventDetailContainer = connect(
  mapStateToProps,
  mapDispatchToProps,
)(EventDetail);

// == Export
export default EventDetailContainer;

/* = export à la volée
export default connect(
  mapStateToProps,
  mapDispatchToProps,
)(Example);
*/
