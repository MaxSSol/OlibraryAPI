<template>
    <section class="update-author">
        <router-link :to="{name: 'admin/authors'}" class="btn">
            <img src="https://img.icons8.com/external-line-icons-royyan-wijaya/20/000000/external-arrow-arrow-me-line-icons-royyan-wijaya-7.png"/>
            Go back
        </router-link>
        <error-loading v-if="error"/>
        <spin-loading v-if="loading"/>
        <div class="author" v-if="!loading">
            <div class="update-author-info text-center mb-5">
                <h1>Update the author: {{ author.first_name + ' ' + author.last_name }}</h1>
            </div>
            <div class="update-author-main-info d-flex flex-column">
                <div class="update-author-first-name input-group mb-3 me-3">
                    <span class="input-group-text" id="book-title">First name</span>
                    <input
                        type="text"
                        class="form-control"
                        placeholder="First name"
                        aria-label="First name"
                        aria-describedby="author-first-name"
                        v-model:value="author.first_name"
                    />
                </div>
                <div class="update-author-last-name input-group mb-3 me-3">
                    <span class="input-group-text" id="last-name">Last name</span>
                    <input
                        type="text"
                        class="form-control"
                        placeholder="Last name"
                        aria-label="Last name"
                        aria-describedby="author-last-name"
                        v-model:value="author.last_name"
                    />
                </div>
                <div class="update-author-book my-2">
                    <span class="input-group-text" id="book-author">Books</span>
                    <multiselect
                        v-model="author.books"
                        :options="books"
                        :multiple="true"
                        label="title"
                        track-by="id"
                    />
                </div>
                <div class="form-floating update-book-description">
                    <span class="input-group-text">Biography</span>
                    <textarea
                        class="form-control"
                        placeholder="Biography"
                        name="biography"
                        aria-label="Biography"
                        aria-describedby="biography"
                        style="height: 100px"
                        v-model="author.biography"
                    >
                    {{author.biography}}
                </textarea>
                </div>
            </div>
            <div class="d-flex justify-content-center mt-5">
                <button type="submit" class="btn btn-primary" @click="submitAuthorUpdate">
                    Save
                </button>
            </div>
        </div>
    </section>
</template>

<script>
import SpinLoading from "../../spinners/Spin-loading";
import ErrorLoading from "../../errors/Error-loading";
import Multiselect from "vue-multiselect"
import Swal from 'sweetalert2'

export default {
    name: "Author-update",
    components: {SpinLoading, ErrorLoading, Multiselect},
    props: [
        'id'
    ],
    data() {
        return {
            author: [],
            loading: true,
            error: false,
            books: [],
            errors: [],
        }
    },
    mounted() {
        axios.get('/api/authors/' + this.id)
            .then(response => {
                this.author = response.data.data
            })
            .catch(() => this.error = true)
            .finally(() => this.loading = false)
        axios.get('/api/books/')
            .then(response => {
                this.books = response.data.data
            })
    },
    methods: {
        submitAuthorUpdate: function () {
            axios.put('/api/authors/' + this.id, this.author)
                .then(response => {
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
