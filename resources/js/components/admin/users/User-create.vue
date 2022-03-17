<template>
    <div>
        <router-link :to="{name: 'admin/users'}" class="btn">
            <img src="https://img.icons8.com/external-line-icons-royyan-wijaya/20/000000/external-arrow-arrow-me-line-icons-royyan-wijaya-7.png"/>
            Go back
        </router-link>
        <section class="update-user">
            <div class="update-user-info text-center mb-5">
                <h1>Create a user</h1>
            </div>
            <div class="update-user-main-info d-flex flex-column">
                <div class="update-user-name  input-group mb-3 me-3">
                    <span class="input-group-text" id="user-name">Name</span>
                    <input
                        type="text"
                        class="form-control"
                        placeholder="Name"
                        aria-label="Name"
                        aria-describedby="user-name"
                        v-model:value="user.name"
                        name="name"/>
                </div>
                <div class="update-user-email input-group mb-3 me-3">
                    <span class="input-group-text" id="user-email">Email</span>
                    <input
                        type="email"
                        class="form-control"
                        placeholder="Email"
                        aria-label="Email"
                        aria-describedby="user-email"
                        v-model:value="user.email"
                        name="email"/>
                </div>
                <div class="update-user-password input-group mb-3 me-3">
                    <span class="input-group-text" id="user-password">Password</span>
                    <input
                        type="password"
                        class="form-control"
                        placeholder="Password"
                        aria-label="Password"
                        aria-describedby="user-password"
                        name="password"
                        v-model:value="user.password"
                    />
                </div>
                <div class="update-user-status">
                    <span class="input-group-text" id="user-status">User status </span>
                    <select class="form-select" aria-describedby="user-status" v-model="user.banned">
                        <option :value="true">Ban</option>
                        <option :value="false">Active</option>
                    </select>
                </div>
                <div class="d-flex justify-content-center mt-5">
                    <button type="submit" class="btn btn-primary" @click="saveForm">
                        Save
                    </button>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
import Swal from 'sweetalert2'
import ErrorLoading from "../../errors/Error-loading";
import SpinLoading from "../../spinners/Spin-loading";

export default {
    name: "User-create",
    components: {SpinLoading, ErrorLoading},
    data() {
        return {
            user: {},
            errors: {},
        }
    },
    methods: {
        saveForm() {
            axios.post('/api/users', this.user)
                .then(response => {
                    this.user = {}
                    Swal.fire({
                        title: 'Success',
                        text: response.data.status,
                        icon: 'success',
                        confirmButtonText: 'Close'
                    })
                })
                .catch(error => {
                    this.errors = error.response.data.errors
                    Swal.fire({
                        title: 'Error!',
                        text: Object.values(this.errors),
                        icon: 'error',
                        confirmButtonText: 'Close',
                    })
                })
        }
    }
}
</script>

<style scoped>

</style>
