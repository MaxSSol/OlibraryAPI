<template>
    <div>
        <admin-bar></admin-bar>
        <p class="fw-bold text-center">Books</p>
        <div class="book-create text-end mt-2">
            <router-link :to="{name: 'admin/book-create'}" class="btn btn-primary">
                Add a book
            </router-link>
            <router-link :to="{name: 'admin/trash/books'}" class="btn btn-primary">
                Trash
            </router-link>
        </div>
        <table class="table text-lg-center">
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
                    <router-link :to="{name: 'admin/book', params: {id: book.id}}" class="btn btn-primary me-2">
                        <img src="https://img.icons8.com/ios-filled/20/000000/update-left-rotation.png"/>
                    </router-link>
                    <button class="btn btn-danger book-delete" @click="deleteBook(book.id)">
                        <img src="https://img.icons8.com/material/20/000000/filled-trash.png"/>
                    </button>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import AdminBar from "../../headers/Admin-bar";
import Swal from 'sweetalert2';

export default {
    name: "Books",
    components: {AdminBar},
    data() {
        return {
            books: [],
        }
    },
    mounted() {
        axios.get('/api/books')
            .then(response => {
                this.books = response.data.data
            })
    },
    methods: {
        deleteBook(id) {
            axios.post('/api/books/' + id, {_method: "DELETE"})
                .then(response => {
                    Swal.fire({
                        title: 'Success',
                        text: response.data.status,
                        icon: 'success',
                        confirmButtonText: 'Close'
                    })
                    axios.get('/api/books')
                        .then(response => {
                            this.books = response.data.data
                        })
                })
                .catch(error => {
                    console.log(error.response)
                })
        }
    }
}
</script>

<style scoped>

</style>
