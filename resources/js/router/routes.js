import Home from "../components/Home";
import Categories from "../components/Categories";
import Books from "../components/books/Books";
import Book from "../components/books/Book";
import Login from "../components/auth/Login";
import Registration from "../components/auth/Registration";
import Account from "../components/account/Account";
import store from "../store";
import AdminDashboard from "../components/admin/Dashboard";
import AdminBooks from "../components/admin/books/Books"
import AdminAuthors from "../components/admin/authors/Authors"
import AdminUsers from "../components/admin/users/Users"
import AdminBookUpdate from "../components/admin/books/Book-update"
import AdminBookCreate from "../components/admin/books/Book-create"
import AdminAuthorCreate from "../components/admin/authors/Author-create"
import AdminAuthorUpdate from "../components/admin/authors/Author-update"

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
    {path: '/account', name: 'account', component: Account, beforeEnter: auth},
    {path: '/olib/admin/dashboard', name: 'admin/dashboard', component: AdminDashboard},
    {path: '/olib/admin/books', name: 'admin/books', component: AdminBooks},
    {path: '/olib/admin/authors', name: 'admin/authors', component: AdminAuthors},
    {path: '/olib/admin/users', name: 'admin/users', component: AdminUsers},
    {path: '/olib/admin/book/update/:id', name: 'admin/book', component: AdminBookUpdate, props: true},
    {path: '/olib/admin/book/create', name: 'admin/book-create', component: AdminBookCreate},
    {path: '/olib/admin/author/create', name: 'admin/author-create', component: AdminAuthorCreate},
    {path: '/olib/admin/author/update/:id', name: 'admin/author-update', component: AdminAuthorUpdate, props: true},
]
