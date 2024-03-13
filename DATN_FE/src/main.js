import { createApp } from 'vue'
import App from './App.vue'
import store from './store';
import axios from 'axios'
import Toaster from "@meforma/vue-toaster";
import router from './router'
import Default from './layout/wrapper/MasterAnime.vue'
import PageAnime from './layout/wrapper/MasterRocker.vue'
import Login from './layout/wrapper/MasterRockerLogin.vue'
import LoginAnime from './layout/wrapper/MasterAnimeLogin.vue'
const app = createApp(App)

app.use(store);
app.use(router, axios,Toaster)
app.component("default-layout", Default);
app.component("new-layout", PageAnime);
app.component("login-layout", Login);
app.component("loginanime-layout", LoginAnime);

app.mount("#app")
