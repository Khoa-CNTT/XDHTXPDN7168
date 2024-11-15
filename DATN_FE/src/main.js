import { createApp } from "vue";
import App from "./App.vue";
import store from "./store";
import axios from "axios";
import Toaster from "@meforma/vue-toaster";
import router from "./router";
import $ from "jquery";
import "ant-design-vue/dist/reset.css";
import { Tree, notification } from "ant-design-vue";
notification.config({
  placement: "topRight", // Default placement
  duration: 1.5, // Default duration
});

const app = createApp(App);
app.config.globalProperties.$notification = notification;

app.use(store);
app.use(router, axios, Toaster, $);
app.use(Tree);
app.mount("#app");
