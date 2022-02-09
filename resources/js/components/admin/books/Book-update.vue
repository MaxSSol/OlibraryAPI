<template>
    <section class="update-book">
        <div class="update-book-info text-center mb-5">
            <h1>Update book: {{ book.title }}</h1>
        </div>
        <div class="row d-flex flex-column">
            <div class="col">
                <div class="update-book-title input-group mb-3">
                    <span class="input-group-text" id="book-title">Title</span>
                    <input
                        type="text"
                        class="form-control"
                        aria-label="Title"
                        aria-describedby="book-title"
                        name="title"
                        v-model:value="book.title"
                    />
                </div>
                <div class="my-3">
                    <p class="fw-bold">File: {{ book.file_name }}</p>
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
                    <p class="fw-bold">Image: {{ book.image_name }}</p>
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
                <div class="update-book-author">
                    <multiselect
                        v-model="book.authors"
                        :options="authors"
                        :multiple="true"
                        label="last_name"
                        track-by="id"
                    >
                        <p>Selected</p>
                    </multiselect>
                </div>
            </div>
            <div class="col mt-2">
                <div class="form-floating update-book-description">
                    <p class="fw-bold">Description</p>
                    <textarea
                        class="form-control"
                        placeholder="Description"
                        name="description"
                        aria-label="Title"
                        aria-describedby="book-description"
                        style="height: 100px"
                        v-model="book.description"
                    >
                            {{book.description}}
                        </textarea>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center mt-5">
            <button type="submit" class="btn btn-primary" @click="submitBookUpdateForm">
                Save
            </button>
        </div>
    </section>
</template>

<script>
import Multiselect from 'vue-multiselect'
import Swal from 'sweetalert2'
import 'sweetalert2/dist/sweetalert2.min.css'

export default {
    props: [
        'id',
    ],
    name: "Book",
    components: {Multiselect},
    data() {
        return {
            book: [],
            authors: [],
            bookImage: '',
            bookFile: '',
        }
    },
    methods: {
        handleImageUpload() {
            this.bookImage = this.$refs.imageFiles.files[0]
        },
        handleBookFileUpload() {
            this.bookFile = this.$refs.bookFiles.files[0]
        },
        submitBookUpdateForm() {
            let formData = new FormData();
            formData.append('book', JSON.stringify(this.book))
            formData.append('file_name', this.bookFile)
            formData.append('image_name', this.bookImage)
            formData.append('_method', "PUT")
            axios.post('/api/books/' + this.id, formData)
                .then(response => {
                    this.book = response.data.book
                    Swal.fire({
                        title: 'Success',
                        text: response.data.status,
                        icon: 'success',
                        confirmButtonText: 'Close'
                    })
                })
        }

    },
    mounted() {
        axios.get('/api/books/' + this.id)
            .then(response => {
                this.book = response.data.data
            })
        //TODO catching errors
        axios.get('/api/authors')
            .then(response => {
                this.authors = response.data.data
            })
    },
}
</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css">

</style>
