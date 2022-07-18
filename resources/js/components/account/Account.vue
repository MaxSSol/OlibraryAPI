<template>
    <div>
        <section class="profile mt-5 d-flex align-items-center justify-content-between">
            <div class="profile-information mt-2">
                <p class="fw-bold"><img src="https://img.icons8.com/material-sharp/20/000000/user.png" alt="User"/>
                    {{user.name}}
                </p>
                <div class="profile-email">
                    <p class="fw-normal">
                        <img
                            src="https://img.icons8.com/external-kiranshastry-solid-kiranshastry/25/000000/external-email-business-kiranshastry-solid-kiranshastry.png"
                            alt="Email"/>
                        Email: {{user.email}}
                        </p>
                </div>
            </div>
        </section>
        <section class="profile-favorites">
            <div class="text-center mt-2">
                <p class="fw-bold">Favorites</p>
            </div>
            <error-loading v-if="error"/>
            <spin-loading v-if="loading"/>
            <div class="profile-favourites-book text-center" v-if="!loading">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Title</th>
                        <th scope="col">Description</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody class="table">
                    <tr v-for="book in favorites" :key="book.id">
                        <td>{{book.title}}</td>
                        <td>{{book.description}}</td>
                        <td>
                            <router-link :to="{name: 'book', params: {id: book.id}}" class="btn btn-primary">
                                <img src="https://img.icons8.com/material-rounded/20/000000/visible.png"/>
                            </router-link>
                            <a class="btn btn-primary" @click="removeFromFavorite(book.id)">
                                <img src="https://img.icons8.com/material-rounded/20/000000/dislike.png"/>
                            </a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</template>

<script>
import { mapGetters } from 'vuex'
import ErrorLoading from "../errors/Error-loading";
import SpinLoading from "../spinners/Spin-loading";

export default {
    components: {SpinLoading, ErrorLoading},
    data() {
        return {
            favorites: [],
            loading: true,
            error: false,
        }
    },
    name: "Account",
    computed: mapGetters({
        user: 'user'
    }),
    mounted() {
        axios.get('/api/favorites')
            .then(response => {
                this.favorites = response.data.data
            })
            .catch(() => this.error = true)
            .finally(() => this.loading = false)
    },
    methods: {
        removeFromFavorite(id) {
            axios.delete('/api/favorites/' + id)
                .then(() => {
                    this.loading = true
                    axios.get('/api/favorites')
                        .then(response => {
                            this.favorites = response.data.data
                        })
                        .catch(() => this.error = true)
                        .finally(() => this.loading = false)
                })
                .catch(() => this.$router.push({name: 'login'}))
        }

    }
}
</script>

<style scoped>

</style>
