// store.js
import { createStore } from 'vuex';

const store = createStore({
    state: {
        isLoading: false,
    },
    mutations: {
        setLoading(state, loading) {
            state.isLoading = loading;
        },
    },
    actions: {
        showLoader({ commit }) {
            commit('setLoading', true);
        },
        hideLoader({ commit }) {
            commit('setLoading', false);
        },
    },
});

export default store;
