import { createStore } from 'vuex';

const store = new createStore({
    state: {
        userToken: null,
    },
    mutations: {
        setUserToken(state, token) {
            state.userToken = token;
        },
        getUserToken(state) {
            return state.userToken;
        }
    },
    actions: {}
})

export default store;