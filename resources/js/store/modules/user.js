export default {
    mutations: {
        setUser(state, user) {
            state.user = user
        },
        setAuthStatus(state, status) {
            state.isAuth = status
        },
        clearUserData(state) {
            state.user = null
            state.isAuth = false
        }
    },
    state: {
        user: null,
        isAuth: false,
    },
    getters: {
        user(state) {
            return state.user;
        },
        authStatus(state) {
            return state.isAuth
        }
    }
}
