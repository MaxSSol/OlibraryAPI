<template>
    <div>
        <error-loading v-if="error"></error-loading>
        <section class="book-detail">
            <div class="row">
                <div class="col col-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="book-info mt-3">
                        <p class="book-title h1">{{ book.title }}</p>
                        <p class="book-description-title pt-2 fw-bold">Description:</p>
                        <p class="book-description fs-5">
                            {{ book.description }}
                        </p>
                    </div>
                    <div  v-for="author in authors" :key="author.id">
                            <span class="badge bg-primary me-2">
                                {{ author.first_name + ' ' + author.last_name }}
                            </span>
                    </div>
                </div>
                <div class="col col-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="book-info-download mt-3 d-flex flex-column justify-content-center align-items-center">
                        <div class="book-image">
                            <img class="book-image" :src="`/storage/books/images/${book.image_name}`" alt="book-image"/>
                        </div>
                        <div class="book-download-link">
                            <a type="button" class="mt-3 btn btn-outline-success">
                                <span class="fw-bold">Download</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
import SpinLoading from "../spinners/Spin-loading";
import ErrorLoading from "../errors/Error-loading";

export default {
    props: [
        'id'
    ],
    components: {ErrorLoading, SpinLoading},
    name: "Book",
    data() {
        return {
            book: [],
            authors: [],
            loading: true,
            error: false,
        }
    },
    mounted() {
        axios.get('/api/books/' + this.id)
            .then(response => {
                this.book = response.data.data;
                this.authors = response.data.data.authors;
            })
            .catch(error => this.error = true)
            .finally(() => this.loading = false)
    }
}
</script>

<style scoped>
.book-description {
    text-align: justify;
}

.book-image {
    height: 323px;
    width: 203px;
}
</style>
