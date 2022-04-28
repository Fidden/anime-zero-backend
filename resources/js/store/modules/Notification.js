export default {
    state: [
        {id: 0, title: 'Title', body: 'some body text'},
    ],
    mutations: {
        ADD_NOTIFICATION(state, value) {
            state.push(value);
        },
        POP_NOTIFICATION(state) {
            state.pop();
        },
        REMOVE_NOTIFICATION(state, id) {
            state.splice(state.findIndex(item => item.id === id));
        },
        REMOVE_NOTIFICATION_BY_INDEX(state, index) {
            state.splice(index);
        }
    },
    actions: {
        addNotification({commit}, value) {
            commit('ADD_NOTIFICATION', value);
            setTimeout(() => commit('POP_NOTIFICATION'), 5000);
        },
        popNotification({commit}) {
            commit('POP_NOTIFICATION');
        },
        removeNotification({commit}, id) {
            commit('REMOVE_NOTIFICATION', id);
        },
        removeNotificationByIndex({commit}, index) {
            commit('REMOVE_NOTIFICATION_BY_INDEX', index);
        }
    }
};
