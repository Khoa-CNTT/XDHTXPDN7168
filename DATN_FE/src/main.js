import { createApp } from 'vue'
import App from './App.vue'
import store from './store';
import axios from 'axios'
import Toaster from "@meforma/vue-toaster";
import router from './router'
import $ from "jquery";

const app = createApp(App)

app.use(store);
app.use(router, axios,Toaster)
app.mount("#app")
