require('./bootstrap');

import Vue from 'vue'
import VueRouter from "vue-router"

Vue.use(VueRouter)

import App from './components/App'
import Home from './components/Home'
import Categories from './components/Categories'
import Books from './components/books/Books'
import Book from './components/books/Book'

const router = new VueRouter({
    mode: 'history',
    routes: [
        {path: '/', name: 'home', component: Home},
        {path: '/categories', name: 'categories', component: Categories},
        {path: '/books', name: 'books', component: Books},
        {path: '/book/:id', name: 'book', component: Book, props: true},
    ]
})

const app = new Vue({
    el: '#app',
    components: {App},
    router
})
