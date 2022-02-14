<template>
    <section class="create-author">
        <div class="d-flex justify-content-start">
            <router-link :to="{name: 'admin/authors'}" class="btn">
                <img src="https://img.icons8.com/external-line-icons-royyan-wijaya/20/000000/external-arrow-arrow-me-line-icons-royyan-wijaya-7.png"/>
                Go back
            </router-link>
        </div>
        <div class="create-author-info text-center mb-5">
            <h1>Create an Author</h1>
        </div>
        <error-loading v-if="error"/>
        <spin-loading v-if="loading"/>
        <div class="create-author-main-info" v-if="!loading">
            <div class="create-author-first-name  input-group mb-3 me-3">
                <span class="input-group-text" id="author-first-name">First name</span>
                <input type="hidden" value="" name="id">
                <input
                    type="text"
                    class="form-control"
                    placeholder="Name"
                    aria-label="Name"
                    aria-describedby="author-last-name"
                    v-model:value="authorForm.first_name"
                    name="first_name"/>
            </div>
            <div class="create-author-last-name input-group mb-3 me-3">
                <span class="input-group-text" id="author-last-name">Last name</span>
                <input
                    type="text"
                    class="form-control"
                    placeholder="Last name"
                    aria-label="Last name"
                    aria-describedby="author-last-name"
                    v-model:value="authorForm.last_name"
                    name="last_name"/>
            </div>
            <div class="update-book-author">
                <span class="input-group-text" id="book-author">Books</span>
                <multiselect
                    v-model="authorForm.books"
                    :options="books"
                    :multiple="true"
                    label="title"
                    track-by="id"
                />
            </div>
            <div class="form-floating create-author-biography">
                <span class="input-group-text" id="book-description">Biography</span>
                <textarea
                    class="form-control"
                    placeholder="Biography"
                    name="biography"
                    aria-label="biography"
                    aria-describedby="author-biography"
                    style="height: 100px"
                    v-model="authorForm.biography"
                >
                    {{authorForm.biography}}
                </textarea>
            </div>
            <div class="d-flex justify-content-center mt-5">
                <button type="submit" class="btn btn-primary" @click="submitCreateAuthor">
                    Save
                </button>
            </div>
        </div>
    </section>
</template>

<script>
import SpinLoading from "../../spinners/Spin-loading";
import ErrorLoading from "../../errors/Error-loading";
import Multiselect from "vue-multiselect";
import Swal from 'sweetalert2'

export default {
    name: "Author-create",
    components: {ErrorLoading, SpinLoading, Multiselect},
    data() {
        return {
            authorForm: {
                first_name: '',
                last_name: '',
                biography: '',
                books: [],
            },
            error: false,
            loading: true,
            books: [],
        }
    },
    mounted() {
        axios.get('/api/books')
            .then(response => {
                this.books = response.data.data
            })
            .catch(() => this.error = true)
            .finally(() => this.loading = false)
    },
    methods: {
        submitCreateAuthor() {
            axios.post('/api/authors', this.authorForm)
                .then(response => {
                    Swal.fire({
                        title: 'Success',
                        text: response.data.status,
                        icon: 'success',
                        confirmButtonText: 'Close'
                    })
                    this.authorForm = {
                        first_name: '',
                        last_name: '',
                        biography: '',
                        books: [],
                    }
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
