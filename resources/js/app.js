require('./bootstrap');

import Vue from 'vue'
import store from './store';
import router from './router'
import App from "./components/App";



const app = new Vue({
    el: '#app',
    components: {App},
    router,
    store,
})
