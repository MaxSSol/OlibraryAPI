<template>
    <div>
        <router-link :to="{name: 'admin/books'}" class="btn mb-2">
            <img src="https://img.icons8.com/external-line-icons-royyan-wijaya/20/000000/external-arrow-arrow-me-line-icons-royyan-wijaya-7.png"/>
            Go back
        </router-link>
        <error-loading v-if="error"/>
        <spin-loading v-if="loading"/>
        <section class="trash-info">
            <p class="fw-light">Everything in the trash will be deleted after 60 days</p>
        </section>
        <section class="trash-books">
            <table class="table text-lg-center" v-if="!loading">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                <tr class="book" v-for="(book, index) in books" :key="book.id">
                    <th scope="row">{{ index + 1 }}</th>
                    <td>{{ book.title }}</td>
                    <td>{{ book.description }}</td>
                    <td class="d-flex justify-content-center">
                        <button class="btn btn-primary me-2" @click="restoreBook(book.id)">
                            <img src="https://img.icons8.com/fluency-systems-filled/20/000000/trash-restore.png"/>
                        </button>
                        <button class="btn btn-danger book-delete" @click="deleteBook(book.id)">
                            <img src="https://img.icons8.com/material/20/000000/filled-trash.png"/>
                        </button>
                    </td>
                </tr>
                </tbody>
            </table>
        </section>
    </div>
</template>

<script>
import SpinLoading from "../../spinners/Spin-loading";
import ErrorLoading from "../../errors/Error-loading";
import Swal from 'sweetalert2';

export default {
    name: "Trash-Book",
    components: {ErrorLoading, SpinLoading},
    data() {
        return {
            books: [],
            error: false,
            loading: true,
        }
    },

    mounted() {
        axios.get('/api/trash/books')
            .then(response => this.books = response.data.data)
            .catch(() => this.error = true)
            .finally(() => this.loading = false)
    },

    methods: {
        deleteBook(id) {
            axios.delete('/api/trash/books/' + id)
                .then(response => {
                    Swal.fire({
                        title: 'Success',
                        text: response.data.status,
                        icon: 'success',
                        confirmButtonText: 'Close'
                    })

                    this.loading = true

                    axios.get('/api/trash/books')
                        .then(response => this.books = response.data.data)
                        .catch(() => this.error = true)
                        .finally(() => this.loading = false)
                })
                .catch(() => {
                    Swal.fire({
                        title: 'Error',
                        text: 'Error',
                        icon: 'error',
                        confirmButtonText: 'Close'
                    })
                })
        },

        restoreBook(id) {
            axios.put('/api/trash/books/' + id)
                .then(response => {
                    Swal.fire({
                        title: 'Success',
                        text: response.data.status,
                        icon: 'success',
                        confirmButtonText: 'Close'
                    })

                    this.loading = true

                    axios.get('/api/trash/books')
                        .then(response => this.books = response.data.data)
                        .catch(() => this.error = true)
                        .finally(() => this.loading = false)
                })
                .catch(() => {
                    Swal.fire({
                        title: 'Error',
                        text: 'Error',
                        icon: 'error',
                        confirmButtonText: 'Close'
                    })
                })
        }
    }
}
</script>

<style scoped>

</style>
