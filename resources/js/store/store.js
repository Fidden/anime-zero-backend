import {createStore} from "vuex";
import Notification from "./modules/Notification";

export default new createStore({
    modules: {
        notification: Notification,
    }
})
