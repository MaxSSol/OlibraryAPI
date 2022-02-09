<template>
    <div class="d-flex">
        <router-link :to="{name: 'admin/books'}" class="nav-link">Books</router-link>
        <router-link :to="{name: 'admin/authors'}" class="nav-link">Authors</router-link>
        <router-link :to="{name: 'admin/users'}" class="nav-link">Users</router-link>
    </div>
</template>

<script>
export default {
    name: "Admin-bar"
}
</script>

<style scoped>

</style>
