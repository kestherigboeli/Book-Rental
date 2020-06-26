/* eslint-disable */
import axios from "axios";

export default {
  namespaced: true,

  state: {
      token: null,
      user: null,
      users: null
  },

    getters: {
        authenticated(state) {
            return state.token;
        },

        user(state) {
            return state.user
        },

        users(state) {
            return state.users
        }
    },

    // This will update the state
  mutations: {
      SET_TOKEN(state, token) {
        state.token = token
      },

      SET_USER(state, data) {
        state.user = data
      },

      SET_USERS(state, data) {
          state.users = data
      },
  },

  actions: {
      async signIn({ dispatch }, form) {

          let response = await axios.post("/auth/login", form)

          setTimeout( () =>{

              dispatch('signOut')

          }, response.data.expires_in * 1000);

          // dispatch is used to call another method
          dispatch('attempt', response.data.access_token)

    },

      // commit call mutation so that it can update the state
      async attempt ( { commit, state}, token) {
          if (token) {
              commit('SET_TOKEN', token);
          }

          if (!state.token) {
              return
          }

          try {
              let response = await axios.get("/auth/me");

              commit('SET_USER', response.data)
          } catch (e) {
              commit('SET_TOKEN', null);
              commit('SET_USER', null)
          }
      },

      signOut( {commit} ) {
          return axios.post('/auth/logout')
              .then( () => {
                  window.location.href = '/';
                  commit('SET_TOKEN', null);
                  commit('SET_USER', null)
              })
              .catch( error => {
                  console.log(error)
              })
      },

     async signUp({ dispatch, commit }, form) {
         await axios.post("/user/register", form);

         dispatch('getAllUsers')
      },

      async getAllUsers( {commit}) {

          let response = await axios.get("users")
          commit('SET_USERS', response.data.users)
      }

  }
}
