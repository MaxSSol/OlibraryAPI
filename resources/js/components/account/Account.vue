<template>
    <main>
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
    </main>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
    name: "Account",
    computed: mapGetters({
        user: 'user'
    })
}
</script>

<style scoped>
.profile {
    margin: 500px 0;
}
</style>
