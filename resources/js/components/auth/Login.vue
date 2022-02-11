<template>
    <div class="form m-auto text-center">
        <p class="fw-bold fs-3">Please sign in</p>
        <div class="alert-box" v-if="errorStatus">
            <div class="alert alert-danger text-center" role="alert">
                <div class="error">
                    <p>{{ error }}</p>
                </div>
            </div>
        </div>
        <div class="form-floating">
            <p class="fw-light">Email address</p>
            <input class="form-control" id="emailInput" type="text" placeholder="email" v-model="form.email">
        </div>
        <div class="form-floating mb-2">
            <p class="fw-light">Password</p>
            <input class="form-control" id="passwordInput" type="password" placeholder="Password"
                   v-model="form.password">
        </div>
        <div class="form-button text-center">
            <button @click="submitForm" id="sign-up" class="btn btn-outline-primary" type="submit">Sign in</button>
        </div>
        <div>
            <router-link :to="{name: 'registration'}">Don`t have account? Sign up</router-link>
        </div>
    </div>
</template>

<script>
import {mapActions} from "vuex";

export default {
    name: "Login",
    data() {
        return {
            form: {
                email: '',
                password: '',
            },
            error: 'These credentials do not match our records.',
            errorStatus: false,
        }
    },

    methods: {
        submitForm() {
            axios.get('/sanctum/csrf-cookie')
                .then(response => {
                    axios.post('/login', this.form)
                        .then(response => {
                            axios.get('/api/user')
                                .then(user => {
                                    this.$store.commit('setUser', user.data)
                                    this.$store.commit('setAuthStatus', true)
                                    this.$router.push({name: 'account'})
                                })
                        })
                        .catch(error => {
                            console.log(this.form)
                            this.errorStatus = true;
                        })
                })
        }
    },
}
</script>

<style scoped>
.form {
    padding: 150px 0;
    max-width: 500px;
}
</style>
