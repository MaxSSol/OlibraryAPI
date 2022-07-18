<template>
    <div>
        <admin-bar></admin-bar>
        <p class="fw-bold text-center">Users</p>
        <div class="create-user text-end">
            <router-link :to="{name: 'admin/users/create'}" class="btn btn-primary">
                Create a user
            </router-link>
        </div>
        <table class="table text-center">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Status</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(user, index) in users" :key="user.id">
                <th scope="row">{{index + 1}}</th>
                <td>{{user.name}}</td>
                <td>{{user.email}}</td>
                <td>{{user.status}}</td>
                <td>
                    <router-link :to="{name: 'admin/users/update', params: {id: user.id} }" class="btn btn-primary">
                        <img src="https://img.icons8.com/fluency-systems-filled/20/000000/life-cycle-female.png"/>
                    </router-link>
                    <button class="btn btn-danger" @click="deleteUser(user.id)">
                        <img src="https://img.icons8.com/fluency-systems-filled/20/000000/remove-user-male.png"/>
                    </button>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import AdminBar from "../../headers/Admin-bar";
import Swal from "sweetalert2";
export default {
    name: "Users",
    components: {AdminBar},

    data() {
        return {
            users: [],
            error: false,
            loading: true,
        }
    },

    mounted() {
        axios.get('/api/users')
            .then(response => this.users = response.data.data)
            .catch(() => this.error = true)
            .finally(() => this.loading = false)
    },

    methods: {
        deleteUser(id) {
            axios.delete('/api/users/' + id)
                .then(response => {
                    Swal.fire({
                        title: 'Success',
                        text: response.data.username,
                        icon: 'success',
                        confirmButtonText: 'Close'
                    })
                    this.loading = true
                    axios.get('/api/users')
                        .then(response => this.users = response.data.data)
                        .catch(() => this.error = true)
                        .finally(() => this.loading = false)
                })
                .catch(() => {
                    Swal.fire({
                        title: 'Error!',
                        text:  'Error',
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
