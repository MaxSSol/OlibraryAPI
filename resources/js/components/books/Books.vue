<template>
    <div>
        <spin-loading v-if="loading"></spin-loading>
        <error-loading v-if="error"></error-loading>
        <section class="section-books mt-5">
            <div class="row">
                <div class="col col-6 col-sm-12 col-md-4 col-lg-3 mb-3" v-for="book in books" :key="book.id">
                    <div class="card h-100">
                        <img
                            class="img-thumbnail"
                            src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ3-cl9WJMUTZhkTkcBIrWz-9WWtc3ZlQ6Y8Q&usqp=CAU"
                            alt="book-image">
                        <div class="card-body text-center">
                            <h5 class="card-title">{{ book.title }}</h5>
                            <p class="card-text">{{ descriptionCrop(book.description, 35) }}</p>
                            <router-link :to="{name: 'book', params: {id: book.id}}" class="btn btn-primary">
                                view
                            </router-link>
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
    name: "Books",
    components: {ErrorLoading, SpinLoading},
    data() {
        return {
            books: [],
            loading: true,
            error: false,
        }
    },
    methods: {
        descriptionCrop: function (str, maxlength) {
            return (str.length > maxlength)
                ? str.slice(0, maxlength - 1) + '...'
                : str;
        }
    },

    mounted() {
        axios.get('/api/books')
            .then(response => {
                this.books = response.data.data;
            })
            .catch(error => this.error = true)
            .finally(() => this.loading = false)
    },
}
</script>

<style scoped>

</style>
