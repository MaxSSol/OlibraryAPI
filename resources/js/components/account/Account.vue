<template>
    <main>
        <section class="profile mt-5 d-flex align-items-center justify-content-between">
            <div class="profile-information mt-2">
                <p class="fw-bold"><img src="https://img.icons8.com/material-sharp/20/000000/user.png" alt="User"/>
                    {{getUser.name}}
                </p>
                <div class="profile-email">
                    <p class="fw-normal">
                        <img
                            src="https://img.icons8.com/external-kiranshastry-solid-kiranshastry/25/000000/external-email-business-kiranshastry-solid-kiranshastry.png"
                            alt="Email"/>
                        Email: {{getUser.email}}
                        </p>
                </div>
            </div>
        </section>
    </main>
</template>

<script>
export default {
    name: "Account",
    mounted() {
        this.$store.dispatch('getUser')
    },
    computed: {
        getUser() {
            return this.$store.getters.user;
        }
    }
}
</script>

<style scoped>
.profile {
    margin: 500px 0;
}
</style>
