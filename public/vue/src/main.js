import { createApp } from 'vue'
import App from './App.vue'
import VueAxios from "vue-axios";
import axios from "axios";
import router from "./router"

const app = createApp(App)
app.use(VueAxios, axios)
app.use(router)
app.mount('#app')

// custom variables
window.topbar = {
    title : ""
}
// global project config
window.config = {
    url: "http://localhost:8080",
    api : {
        endpoint : "/api",
        apiVersion: "1.0",
        lang : "de"
    },
    addressomat : {
        key: "79cbb4baced42383636f2d2bd3d9deadfda63334"
    }
}
