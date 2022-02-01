<template>
    <div class="container d-flex flex-column">
        <header-bar></header-bar>
        <div>
            <router-view></router-view>
        </div>
        <footer-bar></footer-bar>
    </div>
</template>

<script>
import HeaderBar from "./Header-bar";
import FooterBar from "./Footer-bar";
export default {
    name: 'app',
    components: {
        HeaderBar,
        FooterBar
    }
}
</script>

<style scoped>

</style>
