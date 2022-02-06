<template>
    <div>
        <a @click="logoutSubmit" class="nav-link text-dark" href="#">Logout</a>
    </div>
</template>

<script>
import { mapMutations } from 'vuex'
export default {
    name: "Logout",
    methods: {
        ...mapMutations('user', [
           'clearUserData'
        ]),
        logoutSubmit() {
            axios.post('/logout').then(res => {
                this.clearUserData()
                localStorage.clear()
                window.location.href = '/'
            })
        }
    }
}
</script>

<style scoped>

</style>
