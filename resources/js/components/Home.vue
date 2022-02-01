<template>
    <main class="main-content py-5 d-flex text-center align-items-center container square-box">
        <div class="col-lg-6 col-md-8 mx-auto">
            <h1 class="fw-light">Library</h1>
            <p class="lead text-muted pt-3">
                A champion of America’s great writers and timeless works, Library of America guides readers in finding
                and exploring the exceptional writing that reflects the nation’s history and culture.
            </p>
            <div class="access pt-4">
                <router-link class="btn btn-primary me-3" :to="{name: 'books'}">View books</router-link>
            </div>
        </div>
    </main>
</template>

<script>
export default {
    name: "Home"
}
</script>

<style scoped>
.main-content {
    margin: 100px 0;
}
</style>
