<template>
    <section class="create-book">
        <div class="create-book-info text-center mb-5">
            <h1>Create a book</h1>
        </div>
        <div class="row d-flex flex-column">
            <div class="col mb-2">
                <div class="create-book-title input-group mb-3 me-3">
                    <span class="input-group-text" id="book-title">Title</span>
                    <input
                        type="text"
                        class="form-control"
                        placeholder="Title"
                        aria-label="Title"
                        aria-describedby="book-title"
                        name="title"
                        v-model:value="formBook.title"
                    />
                </div>
                <div class="my-3">
                    <label for="bookFile" class="form-label">Update file</label>
                    <input
                        class="form-control"
                        type="file"
                        id="bookFile"
                        ref="bookFiles"
                        name="bookFile"
                        @change="handleBookFileUpload"
                    >
                </div>
                <div class="my-3">
                    <label for="imageFile" class="form-label">Image file</label>
                    <input
                        class="form-control"
                        type="file"
                        id="imageFile"
                        ref="imageFiles"
                        name="bookImage"
                        @change="handleImageUpload"
                    >
                </div>
                <div class="select-authors">
                    <multiselect
                        v-model="formBook.authors"
                        :options="authors"
                        :multiple="true"
                        label="last_name"
                        track-by="id"
                    >
                        <p>Selected</p>
                    </multiselect>
                </div>
            </div>
            <div class="col">
                <div class="form-floating update-book-description">
                    <span class="input-group-text" id="book-description">Description</span>
                    <textarea
                        class="form-control"
                        placeholder="Description"
                        name="description"
                        aria-label="Title"
                        aria-describedby="book-description"
                        style="height: 100px"
                        v-model="formBook.description"
                    >
                    </textarea>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center mt-5">
            <button type="submit" class="btn btn-primary" @click="submitFormBookCreate">
                Save
            </button>
        </div>
    </section>
</template>

<script>
import Swal from 'sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
import Multiselect from "vue-multiselect";

export default {
    name: "Book-create",
    components: {Multiselect},
    data() {
        return {
            formBook: {
                title: '',
                description: '',
                authors: [],
            },
            authors: [],
            bookFile: '',
            bookImage: '',
            errors: '',
        }
    },
    methods: {
        handleImageUpload() {
            this.bookImage = this.$refs.imageFiles.files[0]
        },
        handleBookFileUpload() {
            this.bookFile = this.$refs.bookFiles.files[0]
        },
        submitFormBookCreate() {
            let formData = new FormData()
            formData.append('book', JSON.stringify(this.formBook))
            formData.append('image', this.bookImage)
            formData.append('file', this.bookFile)
            axios.post('/api/books', formData)
                .then(response => {
                    this.formBook = {
                        title: '',
                        description: '',
                        authors: [],
                    }
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
        },
    },
    mounted() {
        axios.get('/api/authors')
            .then(response => {
                this.authors = response.data.data
            })
    }
}
</script>

<style src="../../../../../node_modules/vue-multiselect/dist/vue-multiselect.min.css">

</style>
