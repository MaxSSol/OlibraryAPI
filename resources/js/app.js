require('./bootstrap');

import Vue from 'vue'
import VueRouter from "vue-router"
import store from './store';


Vue.use(VueRouter)

import App from './components/App'
import Home from './components/Home'
import Categories from './components/Categories'
import Books from './components/books/Books'
import Book from './components/books/Book'
import Login from './components/auth/Login'
import Registration from './components/auth/Registration'
import Account from './components/account/Account'

const auth = (to,from,next) => {
    store.dispatch('getUser')
    if (store.getters.user.name) {
        next();
    } else {
        next({name: 'login'});
    }
};
const guest = (to,from,next) => {
    store.dispatch('getUser')
    if (!store.getters.user.name) {
        next();
    } else {
        next({name: 'account'});
    }
};

const router = new VueRouter({
    mode: 'history',
    routes: [
        {path: '/', name: 'home', component: Home},
        {path: '/categories', name: 'categories', component: Categories},
        {path: '/books', name: 'books', component: Books},
        {path: '/book/:id', name: 'book', component: Book, props: true},
        {path: '/login', name: 'login', component: Login, beforeEnter: guest},
        {path: '/registration', name: 'registration', component: Registration, beforeEnter: guest},
        {path: '/account', name: 'account', component: Account, beforeEnter: auth}
    ]
})


const app = new Vue({
    el: '#app',
    components: {App},
    router,
    store,
})
