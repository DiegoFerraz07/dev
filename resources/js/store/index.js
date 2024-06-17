import axios from 'axios';
import { createStore } from 'vuex';

const store = new createStore({
    state: {
        userToken: null,
        user: null,
    },
    mutations: {
        setUserToken(state, token) {
            state.userToken = token;
        },
        getUserToken(state) {
            return state.userToken;
        },
        clearAllState(state) {
            state.userToken = null,
            state.user = null,
            localStorage.removeItem('token', 'post', 'idPost')
        },
        getUser(state){
            let url = route('auth.me')
            let token = state.userToken || localStorage.getItem('token')
            if(!token){
                alert('Faça o login novamente')
                this.$router.replace({ name: "login" })
                return
            }
            axios
             .post(
                url,
                {},
                {headers: { Authorization : 'Bearer ' + token}}
            ).then(response =>{
                const apiresponse = response.data
                state.user = apiresponse
                state.userToken = token
            })
        },
    },
    actions: {
        getUser({commit}){
            commit('getUser')
        },
        clearAllState({commit}){
           commit('clearAllState')
        }
    }
})

export default store;