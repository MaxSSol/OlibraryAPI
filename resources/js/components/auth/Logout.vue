<template>
    <div>
        <a @click="logoutSubmit" class="nav-link text-dark" href="#">Logout</a>
    </div>
</template>

<script>
export default {
    name: "Logout",
    methods: {
        logoutSubmit() {
            axios.post('/logout').then(res => {
                localStorage.removeItem('olib-user');
                window.location.href = '/'
            })
        }
    }
}
</script>

<style scoped>

</style>
