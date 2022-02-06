import Home from "../components/Home";
import Categories from "../components/Categories";
import Books from "../components/books/Books";
import Book from "../components/books/Book";
import Login from "../components/auth/Login";
import Registration from "../components/auth/Registration";
import Account from "../components/account/Account";
import store from "../store";
const guest = (to, from, next) => {
    if (!store.getters.authStatus) {
        next()
        return;
    }
    next({name: 'account'})
}

const auth = (to, from, next) => {
    if (store.getters.authStatus) {
        next()
        return;
    }
    next({name: 'login'})
}


export default [
    {path: '/', name: 'home', component: Home},
    {path: '/categories', name: 'categories', component: Categories},
    {path: '/books', name: 'books', component: Books},
    {path: '/book/:id', name: 'book', component: Book, props: true},
    {path: '/login', name: 'login', component: Login, beforeEnter: guest},
    {path: '/registration', name: 'registration', component: Registration, beforeEnter: guest},
    {path: '/account', name: 'account', component: Account, beforeEnter: auth}
]
