import { createWebHistory, createRouter } from "vue-router"
import Login from "@/views/Login";
import ClientOverview from "@/views/ClientOverview";
import ClientDetail from "@/views/ClientDetail";
import LoggedOut from "@/views/LoggedOut";
import CreateClient from "@/views/CreateClient";

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/login',
            component: Login
        },
        {
            path: '/clients',
            component: ClientOverview
        },
        {
            path: '/clients/:id',
            component: ClientDetail
        },
        {
            path: '/logout',
            component: LoggedOut
        },
        {
            path: '/createClient',
            component: CreateClient
        }
        ]
})
export default router
