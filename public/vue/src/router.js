import { createWebHistory, createRouter } from "vue-router"
import Login from "@/views/Login";
import ClientOverview from "@/views/ClientOverview";
import ClientDetail from "@/views/ClientDetail";
import LoggedOut from "@/views/LoggedOut";
import CreateClient from "@/views/CreateClient";
import {jUser} from "./js/jUser";

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/login',
            component: Login
        },
        {
            path: '/clients',
            component: ClientOverview,
            meta: {
                requiresAuthUser: true
            }
        },
        {
            path: '/',
            redirect: '/clients'
        },
        {
            path: '/clients/:id',
            component: ClientDetail,
            meta: {
                requiresAuthUser: true
            }
        },
        {
            path: '/logout',
            component: LoggedOut
        },
        {
            path: '/createClient',
            component: CreateClient,
            meta: {
                requiresAuthUser: true
            }
        },
        ]
})

router.beforeEach((to, from, next) => {
    if(to.matched.some(record => record.meta.requiresAuthUser)) {
        if (jUser.isLoggedIn()) {
            next()
            return
        }
        window.tmpLoginRedirect = window.location.href
        next('/login/')
    } else {
        next()
    }
})
export default router
