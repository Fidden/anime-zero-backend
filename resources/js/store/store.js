import {createStore} from 'vuex';
import Notification from './modules/Notification';
import AuthModal from './modules/AuthModal';

export default new createStore({
    modules: {
        notification: Notification,
        authModal: AuthModal,
    }
});
