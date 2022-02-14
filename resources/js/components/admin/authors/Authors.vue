<template>
    <div>
        <admin-bar></admin-bar>
        <error-loading v-if="error"/>
        <p class="fw-bold text-center">Authors</p>
        <div class="book-create text-end mt-2">
            <router-link :to="{name: 'admin/author-create'}" class="btn btn-primary">
                Add an author
            </router-link>
        </div>
        <table class="table text-center">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">First name</th>
                <th scope="col">Last name</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(author, index) in authors" :key="author.id">
                <th scope="row">{{ index + 1 }}</th>
                <td>{{ author.first_name }}</td>
                <td>{{ author.last_name }}</td>
                <td>
                    <router-link :to="{name: 'admin/author-update', params: {id: author.id}}" class="btn btn-primary">
                        <img src="https://img.icons8.com/ios-filled/20/000000/update-left-rotation.png"/>
                    </router-link>
                    <a class="btn btn-danger" @click="deleteAuthor(author.id)">
                        <img src="https://img.icons8.com/material/20/000000/filled-trash.png"/>
                    </a>
                </td>
            </tr>
            </tbody>
        </table>
        <spin-loading v-if="loading"/>
    </div>
</template>

<script>
import AdminBar from "../../headers/Admin-bar";
import SpinLoading from "../../spinners/Spin-loading";
import ErrorLoading from "../../errors/Error-loading";
import Swal from "sweetalert2";

export default {
    name: "Authors",
    components: {ErrorLoading, SpinLoading, AdminBar, Swal},
    data() {
        return {
            authors: [],
            error: false,
            loading: true,
        }
    },
    mounted() {
        axios.get('/api/authors')
            .then(response => (
                this.authors = response.data.data
            ))
            .catch(() => this.error = true)
            .finally(() => this.loading = false)

    },
    methods: {
        deleteAuthor(id) {
            axios.delete('/api/authors/' + id)
                .then(response => {
                    Swal.fire({
                        title: 'Success',
                        text: response.data.status,
                        icon: 'success',
                        confirmButtonText: 'Close'
                    })
                    this.loading = true
                    axios.get('/api/authors').then(response => {
                        this.authors = response.data.data
                    })
                        .catch(() => this.error = true)
                        .finally(() => this.loading = false)

                })
                .catch(() => {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Oops, something went wrong',
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
