// == Import : npm
import { connect } from 'react-redux';

// == Import : local
import WhoAreWe from 'src/components/WhoAreWe';
import { getWhoAreWeData } from 'src/store/reducer';


/* === State (données) ===
 * - mapStateToProps retroune un objet de props pour le composant de présentation
 * - mapStateToProps met à dispo 2 params
 *  - state : le state du store (getState)
 *  - ownProps : les props passées au container
 * Pas de data à transmettre ? const mapStateToProps = null;
 */
const mapStateToProps = (state, ownProps) => ({
  ...ownProps,
  whoAreWeData: state.whoAreWeData,
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
  setWhoAreWeData: () => (dispatch(getWhoAreWeData())),
});

// Container
const WhoAreWeContainer = connect(
  mapStateToProps,
  mapDispatchToProps,
)(WhoAreWe);

// == Export
export default WhoAreWeContainer;

/* = export à la volée
export default connect(
  mapStateToProps,
  mapDispatchToProps,
)(Example);
*/
