<template>
    <div
        class="
                    header
                    d-flex
                    flex-wrap
                    align-items-center
                    justify-content-center
                    justify-content-md-between
                    py-3
                    mb-4
                    border-bottom
            "
    >
        <router-link
            class="d-flex align-items-center col-md-3 mb-2 mb-md-0 me-md-auto text-dark text-decoration-none"
            :to="{name: 'home'}"
        >
            <span>Library</span>
        </router-link>
        <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
            <li class="nav-item">
                <router-link class="nav-link text-dark" :to="{name: 'home'}">
                    Home
                </router-link>
            </li>
            <li class="nav-item">
                <router-link class="nav-link text-dark" :to="{name: 'categories'}">
                    Categories
                </router-link>
            </li>
            <li class="nav-item">
                <router-link class="nav-link text-dark" :to="{name: 'books'}">
                    Books
                </router-link>
            </li>
            <li class="nav-item" v-if="!user">
                <router-link class="nav-link text-dark" :to="{name: 'login'}">
                    Login
                </router-link>
            </li>
            <li class="nav-item" v-if="user">
                <router-link class="nav-link text-dark" :to="{name: 'account'}">
                    {{ user.name }}
                </router-link>
            </li>
            <li class="nav-item" v-if="user">
                <logout></logout>
            </li>
        </ul>
    </div>
</template>

<script>
import {mapGetters} from 'vuex'

import Logout from "../auth/Logout";
export default {
    name: "header-bar",
    components: {Logout},
    computed: mapGetters({
        user: 'user'
    }),

}
</script>

<style scoped>

</style>
