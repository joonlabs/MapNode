import { createApp } from 'vue'
import App from './App.vue'
import VueAxios from "vue-axios";
import axios from "axios";
import router from "./router"

const app = createApp(App)
app.use(VueAxios, axios)
app.use(router)
app.mount('#app')