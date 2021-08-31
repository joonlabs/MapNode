import { createApp } from 'vue'
import App from './App.vue'
import VueAxios from "vue-axios";
import axios from "axios";
import router from "./router"
import {jStore} from "./js/jStore.js";

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
    url: "", // use same url as JS files
    api : {
        endpoint : "/api",
        apiVersion: "1.0",
        lang : "de"
    },
    addressomat : {
        key: jStore.load({key: "adressomat_token"})
    }
}

fetch("/api", {
    method: 'POST',
    mode: 'cors',
    headers: {
        'Content-Type': 'application/json',
    },
    body: JSON.stringify({
        query: "{config{adressomat_token}}",
        variables: {},
    }),
}).then(async function(result){
    let token = (await result.json()).data.config.adressomat_token
    window.config.addressomat.key = token
    jStore.store({key: "adressomat_token", value: token})
})