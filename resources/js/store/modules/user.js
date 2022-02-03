export default {
    actions: {
        getUser(ctx) {
            axios.get('/api/user')
                .then(user => {
                    ctx.commit('setUser', user.data)
                })
        }
    },
    mutations: {
        setUser(state, user) {
            state.user = user
        }
    },
    state: {
        user: []
    },
    getters: {
        user(state) {
            return state.user;
        }
    }
}
