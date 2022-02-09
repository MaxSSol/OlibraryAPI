<template>
    <section class="admin mt-5">
        <div class="admin-panel">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <admin-bar></admin-bar>
                </div>
            </nav>
        </div>
    </section>
</template>

<script>
import AdminBar from "../headers/Admin-bar";
export default {
    name: "Dashboard",
    components: {AdminBar}

}
</script>

<style scoped>

</style>
