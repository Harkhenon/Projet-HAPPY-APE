// == Import : npm
import { connect } from 'react-redux';

// == Import : local
import LegalMentions from 'src/components/legalMentions';
import { getLegalMentionsData } from 'src/store/reducer';

/* === State (données) ===
 * - mapStateToProps retroune un objet de props pour le composant de présentation
 * - mapStateToProps met à dispo 2 params
 *  - state : le state du store (getState)
 *  - ownProps : les props passées au container
 * Pas de data à transmettre ? const mapStateToProps = null;
 */
const mapStateToProps = state => ({
  legalMentionsData: state.legalMentionsData,
  loading: state.loading,
});

/* === Actions ===
 * - mapDispatchToProps retroune un objet de props pour le composant de présentation
 * - mapDispatchToProps met à dispo 2 params
 *  - dispatch : la fonction du store pour dispatcher une action
 *  - ownProps : les props passées au container
 * Pas de disptach à transmettre ? const mapDispatchToProps = {};
 */
const mapDispatchToProps = dispatch => ({
  setLegalMentionsData: () => (dispatch(getLegalMentionsData())),
});

// Container
const LegalMentionsContainer = connect(
  mapStateToProps,
  mapDispatchToProps,
)(LegalMentions);

// == Export
export default LegalMentionsContainer;

/* = export à la volée
export default connect(
  mapStateToProps,
  mapDispatchToProps,
)(Example);
*/
