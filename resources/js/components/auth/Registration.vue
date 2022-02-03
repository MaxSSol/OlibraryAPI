<template>
    <div class="form m-auto text-center">
        <p class="fw-bold fs-3">Please sign up</p>
        <div class="alert-box" v-if="errorStatus">
            <div class="alert alert-danger text-center" role="alert">
                <div class="email-errors" v-for="emailError in errors.email">
                    <p>{{ emailError }}</p>
                </div>
                <div class="name-errors" v-for="nameError in errors.name">
                    <p>{{ nameError }}</p>
                </div>
                <div class="password-errors" v-for="passError in errors.password">
                    <p>{{ passError }}</p>
                </div>
            </div>
        </div>
        <div class="form-floating">
            <p class="fw-light">Email address</p>
            <input class="form-control" id="emailInput" type="email" placeholder="email" v-model="form.email">
        </div>
        <div class="form-floating my-2">
            <p class="fw-light">Name</p>
            <input class="form-control" id="nameInput" type="text" placeholder="Name" v-model="form.name">
        </div>
        <div class="form-floating mb-2">
            <p class="fw-light">Password</p>
            <input class="form-control" id="passwordInput" type="password" placeholder="Password"
                   v-model="form.password">
        </div>
        <div class="form-floating mb-2">
            <p class="fw-light">Password confirmation</p>
            <input class="form-control" id="passwordInputConfirmation" type="password" placeholder="Password"
                   v-model="form.password_confirmation">
        </div>
        <div class="form-button text-center">
            <button @click="submitForm" id="sign-up" class="btn btn-outline-primary" type="submit">Sign up</button>
        </div>
        <div>
            <router-link :to="{name: 'login'}">Do you have account? Sign in</router-link>
        </div>
    </div>
</template>

<script>
export default {
    name: "Registration",
    data() {
        return {
            form: {
                email: '',
                username: '',
                name: '',
                password: '',
                password_confirmation: '',
            },
            errors: [],
            errorStatus: false,
        }
    },

    methods: {
        submitForm() {
            axios.get('/sanctum/csrf-cookie')
                .then(response => {
                    axios.post('/register', this.form)
                        .then(response => {
                            axios.get('/api/user')
                                .then(response => {
                                    this.$store.dispatch('getUser');
                                    window.location.href = '/account'
                                })
                        })
                        .catch(error => {
                            console.log(error.response)
                            this.errors = error.response.data.errors;
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
