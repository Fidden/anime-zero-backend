export default {
    state: {
        open: false,
        state: 0,
        enum: {LOGIN: 0, REGISTER: 1, PASSWORD_RESET: 2, EMAIL_VERIFY: 3, PASSWORD_CHANGE: 4, LOADING: 5}
    },
    mutations: {
        SET_MODAL_STATE(state, value) {
            state.state = value;
        },
        SET_MODAL_OPEN(state, value) {
            state.open = value;
        }
    },
    actions: {
        setModalState({commit}, value) {
            commit('SET_MODAL_STATE', value);
        },
        setModalOpen({commit}, value) {
            commit('SET_MODAL_OPEN', value);
        }
    }
};
