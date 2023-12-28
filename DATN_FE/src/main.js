import { createApp } from 'vue'
import App from './App.vue'
import axios from 'axios'
import Toaster from "@meforma/vue-toaster";
import router from './router'
import Default from './Layout/Wrapper/MasterAnime.vue'
import PageAnime from './Layout/Wrapper/MasterRocker.vue'
import Login from './Layout/Wrapper/MasterRockerLogin.vue'
import LoginAnime from './Layout/Wrapper/MasterAnimeLogin.vue'
const app = createApp(App)

app.use(router, axios,Toaster)
app.component("default-layout", Default);
app.component("new-layout", PageAnime);
app.component("login-layout", Login);
app.component("loginanime-layout", LoginAnime);

app.mount("#app")