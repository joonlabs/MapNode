import { createWebHistory, createRouter } from "vue-router"
import Login from "@/views/Login";
import ClientOverview from "@/views/ClientOverview";
import ClientDetail from "@/views/ClientDetail";

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
        }
        ]
})
export default router
